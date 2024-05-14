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
	$is_active = '1';
	$wl_start = date('Y-m-d H:i:s', strtotime($_POST['wl_start']));
	$wl_end = date('Y-m-d H:i:s', strtotime($_POST['wl_end']));
	$a = strtotime($_POST['wl_start']);
	$b = strtotime($_POST['wl_end']);
	$wl_app_list = $_POST['wl_app_list'];
	$wl_status = $_POST['wl_status'];
	$wl_det = $_POST['wl_det'];
	$seconds_diff = $b - $a;
	$seconds_diff = ($seconds_diff/3600); /// by hours
	if ($seconds_diff > 0 && $seconds_diff <= 8)
	{
		$s = $conn2->prepare("SELECT wl_tix_id FROM tbl_wl_tix WHERE wl_tix_by = ? AND wl_tix_start = ? AND wl_tix_end = ? AND workload_id = ? AND status_id = ? AND wl_tix_details = ? AND wl_tix_is_active = ?");
		$s->bind_param("issiisi", $id, $wl_start, $wl_end, $wl_app_list, $wl_status, $wl_det, $is_active);
		$s->execute();
		$s->store_result();
		if ($s->num_rows == 0)
		{
			$x = $conn2->prepare("INSERT INTO tbl_wl_tix (wl_tix_by, wl_tix_start, wl_tix_end, workload_id, status_id, wl_tix_details, wl_tix_is_active) VALUES (?,?,?,?,?,?,?)");
			$x->bind_param("issiisi", $id, $wl_start, $wl_end, $wl_app_list, $wl_status, $wl_det, $is_active);
			$x->execute();
			$x->store_result();
			if ($x->affected_rows == 1)
			{
				echo "Workload successfully submitted!";
				$x->close();
				$s->close();
				$conn->close();
				$conn2->close();
			}
			else
			{
				echo "Unable to submit workload, please try again.";
				$x->close();
				$s->close();
				$conn->close();
				$conn2->close(); 
			}
		}
		else
		{
			echo "Workload: ".$wl_det." already existing on your account";
			$s->close();
			$conn2->close();
			$conn->close();
		}
	}
	else
	{
		echo "Invalid time";
	}
	
}
