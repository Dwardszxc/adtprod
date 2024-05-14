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
	$is_active = '1';
	if ($_SESSION['USER_ROLE'] == "TC");
	{
		$s = $conn2->prepare("SELECT task_name AS task_name, task_id AS task_id FROM tbl_task WHERE task_is_active = ? ORDER BY task_name");
		$s->bind_param("s", $is_active);
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$data[] = $row;
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
}
?>