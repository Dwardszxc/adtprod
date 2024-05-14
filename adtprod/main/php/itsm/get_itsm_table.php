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
		$s = $conn2->prepare("SELECT itsm.prod_ticket_by, itsm.prod_ticket_id, itsm.prod_ticket_number, app.application_name, issue.issue_name, itsm.prod_ticket_date FROM tbl_prod_ticket AS itsm INNER JOIN tbl_application AS app ON itsm.app_id = app.application_id INNER JOIN tbl_issue AS issue ON itsm.issue_id = issue.issue_id WHERE MONTH(itsm.prod_ticket_date) = MONTH(CURDATE()) AND itsm.prod_ticket_is_active = '1' ORDER BY itsm.prod_ticket_date DESC;");
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$itsm_owner = $row['prod_ticket_by'];
			$x = $conn->prepare("SELECT emp_name FROM tbl_employee WHERE emp_id = ?");
			$x->bind_param("i", $itsm_owner);
			$x->execute();
			$x->store_result();
			$x->bind_result($itsm_owner);
			$x->fetch();
			$data[] = array("name" => $itsm_owner, "id" => $row['prod_ticket_id'], "number" => $row['prod_ticket_number'], "app_name" => $row['application_name'], "issue_name" => $row['issue_name'], "date" => $row['prod_ticket_date']);
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
	else
	{
		$s = $conn2->prepare("SELECT itsm.prod_ticket_by, itsm.prod_ticket_id, itsm.prod_ticket_number, app.application_name, issue.issue_name, itsm.prod_ticket_date FROM tbl_prod_ticket AS itsm INNER JOIN tbl_application AS app ON itsm.app_id = app.application_id INNER JOIN tbl_issue AS issue ON itsm.issue_id = issue.issue_id WHERE itsm.prod_ticket_by = ? AND MONTH(itsm.prod_ticket_date) = MONTH(CURDATE()) AND itsm.prod_ticket_is_active = '1' ORDER BY itsm.prod_ticket_date DESC;");
		$s->bind_param("i", $id);
		$s->execute();
		$res = $s->get_result();
		while ($row = mysqli_fetch_assoc($res))
		{
			$itsm_owner = $row['prod_ticket_by'];
			$x = $conn->prepare("SELECT emp_name FROM tbl_employee WHERE emp_id = ?");
			$x->bind_param("i", $itsm_owner);
			$x->execute();
			$x->store_result();
			$x->bind_result($itsm_owner);
			$x->fetch();
			$data[] = array("name" => $itsm_owner, "id" => $row['prod_ticket_id'], "number" => $row['prod_ticket_number'], "app_name" => $row['application_name'], "issue_name" => $row['issue_name'], "date" => $row['prod_ticket_date']);
		}
		echo json_encode($data);
		$s->close();
		$conn2->close();
	}
}
?>