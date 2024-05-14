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
    $id = $_GET['id'];
	if ($_SESSION['USER_ROLE'] == "TC" || $_SESSION == "USER");
	{
		$s = $conn2->prepare("SELECT tix_num, application_id, task_id, tix_date, status_id FROM tbl_adt_tix WHERE tix_id = ?");
		$s->bind_param("i", $id);
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