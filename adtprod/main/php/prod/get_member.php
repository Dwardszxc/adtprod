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
		$s = $conn->prepare("SELECT emp_id, emp_name FROM tbl_employee WHERE emp_subteam_id = '59' and emp_status_id = ? ORDER BY emp_name ASC");
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