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
	if ($_SESSION['USER_ROLE'] == "TC" || $_SESSION == "USER");
	{
		$s = $conn2->prepare("SELECT workload_name AS wl_name, workload_id AS wl_id FROM tbl_workload WHERE workload_is_active = ? ORDER BY workload_name");
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