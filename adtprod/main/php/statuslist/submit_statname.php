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
	$name = $_SESSION['USER_NAME'];
	$stat_name = $_POST['stat_name'];
	$is_active = '1';
	$s = $conn2->prepare("SELECT status_name FROM tbl_status WHERE status_name = ? AND status_is_active = '1'");
	$s->bind_param("s", $stat_name);
	$s->execute();
	$s->store_result();
	if ($s->num_rows > 0)
	{
		echo "Status name already existing";
		$s->close();
		$conn2->close();
	}
	else
	{
		$x = $conn2->prepare("INSERT INTO tbl_status (status_name, status_is_active) VALUES (?,?) ");
		$x->bind_param("si", $stat_name, $is_active);
		$x->execute();
		$x->store_result();
		if ($x->affected_rows == 1)
		{
			$last_id = $conn2->insert_id;
			echo "Status name was successfully submitted!".$last_id;
			$x->close();
			$s->close();
			$conn2->close();
		}
	}
}
?>