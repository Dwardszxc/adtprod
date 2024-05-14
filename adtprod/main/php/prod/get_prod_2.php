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
	$team_total_perc = 0;
	$team_cap_prod = 0;
	$team_itsm_prod = 0;
	///FOR GRAND TOTAL
	$s = $conn->prepare("SELECT emp_name, emp_id FROM tbl_employee WHERE emp_subteam_id = '59' AND emp_status_id = '1' ORDER BY emp_name ASC");
	$s->execute();
	$res = $s->get_result();
	while ($row = $res->fetch_assoc())
	{
		$emp_id = $row['emp_id'];
		$emp_name = $row['emp_name'];
		$x = $conn2->prepare("SELECT prod_cap_start, prod_cap_end FROM tbl_prod_cap WHERE prod_cap_by = ? AND MONTH(prod_cap_start) = ? AND MONTH(prod_cap_end) = ? AND YEAR(prod_cap_start) = ? AND YEAR(prod_cap_end) = ? AND prod_cap_is_active = '1'");
		$x->bind_param("issss", $emp_id, $month, $month, $year, $year);
		$x->execute();
		$resx = $x->get_result();
		$rowx_count = $resx->num_rows;
		if ($rowx_count > 0)
		{
			$cap_prod = 0;
			while($rowx = $resx->fetch_assoc())
			{
				$start = strtotime($rowx['prod_cap_start']);
				$end = strtotime($rowx['prod_cap_end']);
				$cap_prod = $cap_prod + round(abs($start - $end) / (60*60) ,2);
			}
		}
		else
		{
			$cap_prod = 0;
		}
		$cap_seconds = $cap_prod * 3600; /// hours into seconds
		$y = $conn2->prepare("SELECT app.application_mins FROM tbl_prod_ticket AS prod INNER JOIN tbl_application AS app ON prod.app_id = app.application_id WHERE prod.prod_ticket_by = ? AND prod.prod_ticket_is_active = '1' AND MONTH(prod.prod_ticket_date) = ? AND YEAR(prod.prod_ticket_date) = ?");
		$y->bind_param("iss", $emp_id, $month, $year);
		$y->execute();
		$resy = $y->get_result();
		$rowy_count = $resy->num_rows;
		if ($rowy_count > 0)
		{
			$itsm_prod = 0;
			while($rowy = $resy->fetch_assoc())
			{
				$itsm_prod = $itsm_prod + $rowy['application_mins'];
			}
		}
		else
		{
			$itsm_prod = 0;
		}
		$itsm_seconds = $itsm_prod * 60; ///minutes into seconds
		$total_time_seconds = $cap_seconds + $itsm_seconds;
		$team_total_perc = $team_total_perc + $total_time_seconds;
	}
	if ($member == "All")
	{
		$s = $conn->prepare("SELECT emp_name, emp_id FROM tbl_employee WHERE emp_subteam_id = '59' AND emp_status_id = '1' ORDER BY emp_name ASC");
		$s->execute();
		$res = $s->get_result();
		while ($row = $res->fetch_assoc())
		{
			$emp_id = $row['emp_id'];
			$emp_name = $row['emp_name'];
			$t = $conn->prepare("SELECT DISTINCT (emp_name), COUNT(sum_date) FROM tbl_summary WHERE etime NOT REGEXP '^[A-z]+$' AND emp_id = ? AND MONTH(sum_date) = ? AND YEAR(sum_date) = ? AND summary_is_active = '1'");
			$t->bind_param("sss", $emp_id, $month, $year);
			$t->execute();
			$t->store_result();
			$t->bind_result($name, $days);
			$t->fetch();
			$x = $conn2->prepare("SELECT prod_cap_start, prod_cap_end FROM tbl_prod_cap WHERE prod_cap_by = ? AND MONTH(prod_cap_start) = ? AND MONTH(prod_cap_end) = ? AND YEAR(prod_cap_start) = ? AND YEAR(prod_cap_end) = ? AND prod_cap_is_active = '1'");
			$x->bind_param("issss", $emp_id, $month, $month, $year, $year);
			$x->execute();
			$resx = $x->get_result();
			$rowx_count = $resx->num_rows;
			if ($rowx_count > 0)
			{
				$cap_prod = 0;
				while($rowx = $resx->fetch_assoc())
				{
					$start = strtotime($rowx['prod_cap_start']);
					$end = strtotime($rowx['prod_cap_end']);
					$cap_prod = $cap_prod + round(abs($start - $end) / (60*60) ,2);
				}
			}
			else
			{
				$cap_prod = 0;
			}
			$cap_seconds = $cap_prod * 3600; /// hours into seconds
			$team_cap_prod = $team_cap_prod + $cap_seconds;
			$cap_output = sprintf('%02d:%02d:%02d', ($cap_seconds/ 3600),($cap_seconds/ 60 % 60), $cap_seconds% 60);
			$y = $conn2->prepare("SELECT app.application_mins FROM tbl_prod_ticket AS prod INNER JOIN tbl_application AS app ON prod.app_id = app.application_id WHERE prod.prod_ticket_by = ? AND prod.prod_ticket_is_active = '1' AND MONTH(prod.prod_ticket_date) = ? AND YEAR(prod.prod_ticket_date) = ?");
			$y->bind_param("iss", $emp_id, $month, $year);
			$y->execute();
			$resy = $y->get_result();
			$rowy_count = $resy->num_rows;
			if ($rowy_count > 0)
			{
				$itsm_prod = 0;
				while($rowy = $resy->fetch_assoc())
				{
					$itsm_prod = $itsm_prod + $rowy['application_mins'];
				}
			}
			else
			{
				$itsm_prod = 0;
			}
			$itsm_seconds = $itsm_prod * 60; ///minutes into seconds
			$team_itsm_prod = $team_itsm_prod + $itsm_seconds;
			$itsm_output = sprintf('%02d:%02d:%02d', ($itsm_seconds/ 3600),($itsm_seconds/ 60 % 60), $itsm_seconds% 60);
			$total_time_seconds = $cap_seconds + $itsm_seconds;
			$total_time_output = sprintf('%02d:%02d:%02d', ($total_time_seconds/ 3600),($total_time_seconds/ 60 % 60), $total_time_seconds% 60);
			$team_perc = $total_time_seconds / $team_total_perc;
			$team_perc = round($team_perc * 100);
			if (is_nan($team_perc))
			{
				$team_perc = 0;
			}
			$tyu = $days * 28800; /// days of work in seconds for the month
			$total_prod = $total_time_seconds / $tyu;
			$total_prod = round($total_prod * 100);
			if (is_nan($total_prod))
			{
				$total_prod = 0;
			}
			if ($total_prod >= 93 && $total_prod <= 150)
			{
				$prod_rating = "4";
			}
			elseif ($total_prod >= 80 && $total_prod <= 92)
			{
				$prod_rating = "3";
			}
			elseif ($total_prod >= 50 && $total_prod <= 79)
			{
				$prod_rating = "2";
			}
			elseif ($total_prod >= 0 &&$total_prod <= 49)
			{
				$prod_rating = "1";
			}
			$data[] = array("id" => $emp_id, "name" => $name, "svc_mgt_tot_time" => $cap_output, "wln_tot_time" => $itsm_output, "tot_time" => $total_time_output, "team_perc" => $team_perc."%", "tot_prod_perc" => $total_prod."%", "prod_rate" => $prod_rating);
			
		}
		$s->close();
		echo json_encode($data);
	}
	else
	{
		$s = $conn->prepare("SELECT emp_name, emp_id FROM tbl_employee WHERE emp_id = ? ORDER BY emp_name ASC");
		$s->bind_param("i", $member);
		$s->execute();
		$res = $s->get_result();
		while ($row = $res->fetch_assoc())
		{
			$emp_id = $row['emp_id'];
			$emp_name = $row['emp_name'];
			$t = $conn->prepare("SELECT DISTINCT (emp_name), COUNT(sum_date) FROM tbl_summary WHERE etime NOT REGEXP '^[A-z]+$' AND emp_id = ? AND MONTH(sum_date) = ? AND YEAR(sum_date) = ? AND summary_is_active = '1'");
			$t->bind_param("sss", $emp_id, $month, $year);
			$t->execute();
			$t->store_result();
			$t->bind_result($name, $days);
			$t->fetch();
			$x = $conn2->prepare("SELECT prod_cap_start, prod_cap_end FROM tbl_prod_cap WHERE prod_cap_by = ? AND MONTH(prod_cap_start) = ? AND MONTH(prod_cap_end) = ? AND YEAR(prod_cap_start) = ? AND YEAR(prod_cap_end) = ? AND prod_cap_is_active = '1'");
			$x->bind_param("issss", $emp_id, $month, $month, $year, $year);
			$x->execute();
			$resx = $x->get_result();
			$row_count = $resx->num_rows;
			if ($row_count > 0)
			{
				$cap_prod = 0;
				while($rowx = $resx->fetch_assoc())
				{
					$start = strtotime($rowx['prod_cap_start']);
					$end = strtotime($rowx['prod_cap_end']);
					$cap_prod = $cap_prod + round(abs($start - $end) / (60*60) ,2);
				}
			}
			else
			{
				$cap_prod = 0;
			}
			$seconds = $cap_prod * 3600;
			$output = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
			$data[] = array("id" => $emp_id, "name" => $name, "svc_mgt_tot_time" => $cap_prod, "wln_tot_time" => $days, "tot_time" => $days, "team_perc" => $days, "tot_prod_perc" => $days, "tot_prod_perc" => $days);
			
		}
		$s->close();
		echo json_encode($data);
	}

}
?>