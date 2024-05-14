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
	$id = $_POST['tix_id'];
	$user_id = $_SESSION['USER_ID'];
	$s = $conn2->prepare("UPDATE tbl_adt_tix SET is_active = '0', last_update_by = ?, last_update_ipaddr = ? WHERE tix_id = ?");
	$s->bind_param("isi", $user_id, $ip, $id);
	if ($s->execute())
	{
		echo "Data successfully deleted";
	}
	else
	{
		echo "Something went wrong. Please try again.";
	}
}
?>