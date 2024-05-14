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
	$tix_num = $_POST['tix_num'];
	$adt_app_list = $_POST['adt_app_list'];
	$adt_task_list = $_POST['adt_task_list'];
	$tix_date = $_POST['tix_date'];
	$adt_status_list = $_POST['adt_status_list'];
	$s = $conn2->prepare("SELECT tix_id FROM tbl_adt_tix WHERE application_id = ? AND task_id = ? AND status_id = ? AND tix_by = ? AND tix_num = ? AND is_active = ?");
	$s->bind_param("iiiisi", $adt_app_list, $adt_task_list, $adt_status_list, $id, $tix_num, $is_active);
	$s->execute();
	$s->store_result();
	if ($s->num_rows == 0)
	{
		$x = $conn2->prepare("INSERT INTO tbl_adt_tix (tix_by, tix_num, application_id, task_id, tix_date, status_id, is_active) VALUES (?,?,?,?,?,?,?)");
		$x->bind_param("isiisis", $id, $tix_num, $adt_app_list, $adt_task_list, $tix_date, $adt_status_list, $is_active);
		$x->execute();
		$x->store_result();
		if ($x->affected_rows == 1)
		{
			echo "Ticket successfully submitted!";
			$x->close();
			$s->close();
			$conn->close();
			$conn2->close();
		}
		else
		{
			echo "Unable to submit ticket, please try again.";
			$x->close();
			$s->close();
			$conn->close();
			$conn2->close(); 
		}
	}
	else
	{
		echo "Ticket number: ".$tix_num." already existing on your account";
		$s->close();
		$conn2->close();
		$conn->close();
	}
}
?>