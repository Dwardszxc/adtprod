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
	$data = array();
	$is_active = '1';
	if ($_SESSION['USER_ROLE'] == 'TC')
	{
		$s = $conn2->prepare("SELECT adt.tix_by, adt.tix_id, adt.tix_num, app.application_name, task.task_name, stat.status_name, adt.tix_date FROM tbl_adt_tix AS adt INNER JOIN tbl_application AS app ON adt.application_id = app.application_id INNER JOIN tbl_task AS task ON adt.task_id = task.task_id INNER JOIN tbl_status AS stat ON adt.status_id = stat.status_id WHERE MONTH(adt.tix_date) = MONTH(CURDATE()) AND adt.is_active = '1' ORDER BY adt.tix_date DESC");
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$adt_owner = $row['tix_by'];
			$x = $conn->prepare("SELECT emp_name FROM tbl_employee WHERE emp_id = ?");
			$x->bind_param("i", $adt_owner);
			$x->execute();
			$x->store_result();
			$x->bind_result($adt_owner);
			$x->fetch();
			$data[] = array("name" => $adt_owner, "id" => $row['tix_id'], "tix_num" => $row['tix_num'], "app_name" => $row['application_name'], "task_name" => $row['task_name'], "status" => $row['status_name'], "date" => $row['tix_date']);
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
	else
	{
		$s = $conn2->prepare("SELECT adt.tix_by, adt.tix_id, adt.tix_num, app.application_name, task.task_name, adt.tix_date, status.status_name FROM tbl_adt_tix AS adt INNER JOIN tbl_application AS app ON adt.application_id = app.application_id INNER JOIN tbl_status AS status ON adt.status_id = status.status_id INNER JOIN tbl_task AS task ON adt.task_id = task.task_id WHERE adt.tix_by = ? AND MONTH(adt.tix_date) = MONTH(CURDATE()) AND adt.is_active = '1' ORDER BY adt.tix_date DESC;");
		$s->bind_param("i", $id);
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$itsm_owner = $row['tix_by'];
			$x = $conn->prepare("SELECT emp_name FROM tbl_employee WHERE emp_id = ?");
			$x->bind_param("i", $itsm_owner);
			$x->execute();
			$x->store_result();
			$x->bind_result($itsm_owner);
			$x->fetch();
			$data[] = array("name" => $itsm_owner, "id" => $row['tix_id'], "tix_num" => $row['tix_num'], "app_name" => $row['application_name'], "task_name" => $row['task_name'], "status" => $row['status_name'], "date" => $row['tix_date']);
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
}
?>