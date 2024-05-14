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
	$id = $_POST['id'];
	$tix_num = $_POST['tix_num'];
	$adt_app_list = $_POST['adt_app_list'];
	$adt_task_list = $_POST['adt_task_list'];
	$tix_date = $_POST['tix_date'];
	$adt_status_list = $_POST['adt_status_list'];
	$s = $conn2->prepare("UPDATE tbl_adt_tix SET tix_num = ?, application_id = ?, task_id = ?, tix_date = ?, status_id = ? WHERE tix_id = ?");
	$s->bind_param("siisii", $tix_num, $adt_app_list, $adt_task_list, $tix_date, $adt_status_list, $id);
	if ($s->execute())
	{
		echo "Data successfully updated";
	}
	else
	{
		echo "Something went wrong. Please try again.";
	}
}
?>