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
	$id = $_POST['task_id'];
	$name = $_POST['task_name'];
	$s = $conn2->prepare("UPDATE tbl_task SET task_is_active = '0' WHERE task_id = ?");
	$s->bind_param("i", $id);
	$s->execute();
	echo $name." Successfully deleted!";
}
?>