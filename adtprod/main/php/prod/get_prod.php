<?php
include('../../connection/conn.php');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX)
{
	die('<h1>404 Not Found</h1>');
}
else
{
	session_start();
	$data = array();
	$month = $_GET['month'];
	$year = $_GET['year'];
	$member = $_GET['member'];
	$total_mins = 0;
	if ($_SESSION['USER_ROLE'] == "TC")
	{
		if ($member == "All")
		{
			////for team total entries
			$team_total_entries = 0;
			$s = $conn->prepare("SELECT emp_name, emp_id FROM tbl_employee WHERE emp_subteam_id = '99' AND emp_status_id = '1' ORDER BY emp_name ASC");
			$s->execute();
			$res = $s->get_result();
			while ($row = $res->fetch_assoc())
			{
				$emp_id = $row['emp_id'];
				$emp_name = $row['emp_name'];
				$x = $conn2->prepare("SELECT SUM(task.mins), COUNT(tix.tix_id) FROM tbl_task AS task INNER JOIN tbl_adt_tix AS tix ON task.task_id = tix.task_id WHERE tix.tix_by = ? AND MONTH(tix.tix_date) = ? AND YEAR(tix.tix_date) = ?");
				$x->bind_param("iss", $emp_id, $month, $year);
				$x->execute();
				$x->store_result();
				$x->bind_result($tix_mins, $tix_count);
				$x->fetch();
				$d = $conn2->prepare("SELECT wl_tix_start, wl_tix_end FROM tbl_wl_tix WHERE wl_tix_by = ? AND MONTH(wl_tix_start) = ? AND MONTH(wl_tix_end) = ? AND YEAR(wl_tix_start) = ? AND YEAR(wl_tix_end) = ? and wl_tix_is_active = '1'");
				$d->bind_param("issss", $emp_id, $month, $month, $year, $year);
				$d->execute();
				$resd = $d->get_result();
				$workload_count = $resd->num_rows;
				$mte = $tix_count + $workload_count;
				$team_total_entries = $team_total_entries + $mte;
			}

			//////
			$s = $conn->prepare("SELECT emp_name, emp_id FROM tbl_employee WHERE emp_subteam_id = '99' AND emp_status_id = '1' ORDER BY emp_name ASC");
			$s->execute();
			$res = $s->get_result();
			while ($row = $res->fetch_assoc())
			{
				$emp_id = $row['emp_id'];
				$emp_name = $row['emp_name'];
				$t = $conn->prepare("SELECT DISTINCT (emp_name), COUNT(sum_date) FROM tbl_summary WHERE etime NOT REGEXP '^[A-z]+$' AND emp_id = ? AND MONTH(sum_date) = ? AND YEAR(sum_date) = ? AND summary_is_active = '1'");
				$t->bind_param("iss", $emp_id, $month, $year);
				$t->execute();
				$t->store_result();
				$t->bind_result($name, $days);
				$t->fetch();
				$e = $conn->prepare("SELECT SUM(ot_hours) FROM tbl_filed_ot WHERE MONTH(ot_date) = ? AND YEAR(ot_date) = ? AND ot_emp_id = ?");
				$e->bind_param("ssi", $month, $year, $emp_id);
				$e->execute();
				$e->store_result();
				$e->bind_result($ot);
				$e->fetch();
				$ot = $ot * 3600; ///ot in seconds
				$x = $conn2->prepare("SELECT SUM(task.mins), COUNT(tix.tix_id) FROM tbl_task AS task INNER JOIN tbl_adt_tix AS tix ON task.task_id = tix.task_id WHERE tix.tix_by = ? AND MONTH(tix.tix_date) = ? AND YEAR(tix.tix_date) = ?");
				$x->bind_param("iss", $emp_id, $month, $year);
				$x->execute();
				$x->store_result();
				$x->bind_result($tix_mins, $tix_count);
				$x->fetch();
				$tix_seconds = $tix_mins * 60; /// minutes into seconds
				$tyu = $days * 28800; /// days of work in seconds for the month
				$tyu = $tyu + $ot; 
				$tix_output = sprintf('%02d:%02d:%02d', ($tix_seconds/ 3600), ($tix_seconds/ 60 % 60), $tix_seconds% 60);
				$d = $conn2->prepare("SELECT wl_tix_start, wl_tix_end FROM tbl_wl_tix WHERE wl_tix_by = ? AND MONTH(wl_tix_start) = ? AND MONTH(wl_tix_end) = ? AND YEAR(wl_tix_start) = ? AND YEAR(wl_tix_end) = ? and wl_tix_is_active = '1'");
				$d->bind_param("issss", $emp_id, $month, $month, $year, $year);
				$d->execute();
				$resd = $d->get_result();
				$rowd_count = $resd->num_rows;
				$wl_count = 0;
				if ($rowd_count > 0)
				{
					$wl_prod = 0;
					while($rowd = $resd->fetch_assoc())
					{
						$start = strtotime($rowd['wl_tix_start']);
						$end = strtotime($rowd['wl_tix_end']);
						$wl_prod = $wl_prod + round(abs($start - $end) / (60*60), 2);
					}
				}
				else
				{
					$wl_prod = 0;
				}
				$wl_seconds = $wl_prod * 3600; /// hours into seconds
				$wl_output = sprintf('%02d:%02d:%02d', ($wl_seconds/ 3600), ($wl_seconds/ 60 % 60), $wl_seconds% 60);
				$total_time = $tix_seconds + $wl_seconds;
				$total_time_output = sprintf('%02d:%02d:%02d', ($total_time/ 3600), ($total_time/ 60 % 60), $total_time% 60);
				$total_prod = $total_time / $tyu;
				$total_prod = round($total_prod * 100);
				if ($total_prod >= 125)
				{
					$prod_qos = 4;
				}
				elseif ($total_prod >= 115 && $total_prod <= 124)
				{
					$prod_qos = 3;
				}
				elseif ($total_prod >= 100 && $total_prod <= 114)
				{
					$prod_qos = 2;
				}
				elseif ($total_prod <= 99)
				{
					$prod_qos = 1;
				}
				$member_total_entries = $tix_count + $rowd_count;
				$entries_prod = $member_total_entries/$team_total_entries;
				$entries_prod = round($entries_prod * 100);
				if ($entries_prod > 50)
				{
					$entries_qos = 4;
				}
				elseif ($entries_prod >= 40 && $entries_prod <= 49)
				{
					$entries_qos = 3;
				}
				elseif ($entries_prod >= 20 && $entries_prod <= 39)
				{
					$entries_qos = 2;
				}
				elseif ($entries_prod <= 19)
				{
					$entries_qos = 1;
				}
				$dummy_entries_qos = $entries_qos * .5;
				$dummy_prod_qos = $prod_qos * .5;
				$qos_grade = $dummy_entries_qos + $dummy_prod_qos;
				if ($qos_grade == "4")
				{
					$qos = "Excelling";
				}
				elseif ($qos_grade >= 3 && $qos_grade <= 3.99)
				{
					$qos = "Achieving";
				}
				elseif ($qos_grade >= 2 && $qos_grade <= 2.99)
				{
					$qos = "Developing";
				}
				elseif ($qos_grade <= 1.99)
				{
					$qos = "Improvement Required";
				}
				$total_prod_time = $tix_seconds + $wl_seconds;
				$total_prod_time = sprintf('%02d:%02d:%02d', ($total_prod_time/ 3600), ($total_prod_time/ 60 % 60), $total_prod_time% 60);
				$monthly_prod_actual = sprintf('%02d:%02d:%02d', ($tyu/ 3600), ($tyu/ 60 % 60), $tyu% 60);
				$data[] = array(
					"id" => $emp_id, 
					"name" => $name, 
					"total_tix" => $tix_count, 
					"total_tix_mins" => $tix_output, 
					"total_workload" => $rowd_count, 
					"total_workload_mins" => $wl_output, 
					"overall_tix" => $member_total_entries,
					"entries_prod" => $entries_prod."%",
					"entries_qos" => $entries_qos,
					"total_prod_time" => $total_prod_time,
					"total_team_entries" => $team_total_entries, 
					"total_prod" => $total_prod."%",
					"prod_qos" => $prod_qos,
					"qos_grade" => $qos_grade,
					"qos" => $qos,
					"monthly_prod_actual" => $monthly_prod_actual
				);
			}
		}
		echo json_encode($data);
		$d->close();
		$x->close();
		$t->close();
		$s->close();
		$conn->close();
		$conn2->close();
	}


}
?>