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
	$edit_wl_start = $_POST['edit_wl_start'];
	$edit_wl_end = $_POST['edit_wl_end'];
	$edit_wl_app_list = $_POST['edit_wl_app_list'];
	$edit_wl_det = $_POST['edit_wl_det'];
	$edit_wl_status = $_POST['edit_wl_status'];
	$s = $conn2->prepare("UPDATE tbl_wl_tix SET wl_tix_start = ?, wl_tix_end = ?, workload_id = ?, status_id = ?, wl_tix_details = ? WHERE wl_tix_id = ?");
	$s->bind_param("ssiisi", $edit_wl_start, $edit_wl_end, $edit_wl_app_list, $edit_wl_status, $edit_wl_det, $id);
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