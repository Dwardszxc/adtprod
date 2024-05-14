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
	$id = $_SESSION['USER_ID'];
	$data = array();
	$is_active = '1';
	if ($_SESSION['USER_ROLE'] == 'TC')
	{
		$s = $conn2->prepare("SELECT wl.wl_tix_by, wl.wl_tix_id, wl.wl_tix_details, wrk.workload_name, stat.status_name, wl.wl_tix_start, wl.wl_tix_end FROM tbl_wl_tix AS wl INNER JOIN tbl_workload AS wrk ON wl.workload_id = wrk.workload_id INNER JOIN tbl_status AS stat ON wl.status_id = stat.status_id WHERE MONTH(wl.wl_tix_start) = MONTH(CURDATE()) AND wl.wl_tix_is_active = '1' ORDER BY wl.wl_tix_start DESC");
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$wl_owner = $row['wl_tix_by'];
			$x = $conn->prepare("SELECT emp_name FROM tbl_employee WHERE emp_id = ?");
			$x->bind_param("i", $wl_owner);
			$x->execute();
			$x->store_result();
			$x->bind_result($wl_owner);
			$x->fetch();
			$data[] = array("name" => $wl_owner, "tix_id" => $row['wl_tix_id'], "details" => $row['wl_tix_details'], "workload_name" => $row['workload_name'], "stat_name" => $row['status_name'], "start" => $row['wl_tix_start'], "end" => $row['wl_tix_end']);
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
	else
	{
		$s = $conn2->prepare("SELECT wl.wl_tix_by, wl.wl_tix_id, wl.wl_tix_details, wrk.workload_name, stat.status_name, wl.wl_tix_start, wl.wl_tix_end FROM tbl_wl_tix AS wl INNER JOIN tbl_workload AS wrk ON wl.workload_id = wrk.workload_id INNER JOIN tbl_status AS stat ON wl.status_id = stat.status_id WHERE wl.wl_tix_by = ? AND MONTH(wl.wl_tix_start) = MONTH(CURDATE()) AND wl.wl_tix_is_active = '1' ORDER BY wl.wl_tix_start DESC");
		$s->bind_param("i", $id);
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$wl_owner = $row['wl_tix_by'];
			$x = $conn->prepare("SELECT emp_name FROM tbl_employee WHERE emp_id = ?");
			$x->bind_param("i", $wl_owner);
			$x->execute();
			$x->store_result();
			$x->bind_result($wl_owner);
			$x->fetch();
			$data[] = array("name" => $wl_owner, "tix_id" => $row['wl_tix_id'], "details" => $row['wl_tix_details'], "workload_name" => $row['workload_name'], "stat_name" => $row['status_name'], "start" => $row['wl_tix_start'], "end" => $row['wl_tix_end']);
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
}
?>