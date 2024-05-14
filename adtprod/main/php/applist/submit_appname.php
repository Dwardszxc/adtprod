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
	$app_name = $_POST['app_name'];
	$is_active = '1';
	$s = $conn2->prepare("SELECT application_name FROM tbl_application WHERE application_name = ? AND application_is_active = '1'");
	$s->bind_param("s", $app_name);
	$s->execute();
	$s->store_result();
	if ($s->num_rows > 0)
	{
		echo "Application Name already existing";
		$s->close();
		$conn2->close();
	}
	else
	{
		$x = $conn2->prepare("INSERT INTO tbl_application (application_name, application_is_active) VALUES (?,?) ");
		$x->bind_param("si", $app_name, $is_active);
		$x->execute();
		$x->store_result();
		if ($x->affected_rows == 1)
		{
			$last_id = $conn2->insert_id;
			echo "Application name was successfully submitted!".$last_id;
			$x->close();
			$s->close();
			$conn2->close();
		}
	}
}
?>