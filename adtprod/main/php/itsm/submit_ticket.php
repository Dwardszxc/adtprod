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
	$is_active = '1';
	$tix_num = $_POST['tix_num'];
	$itsm_app_list = $_POST['itsm_app_list'];
	$itsm_issue_list = $_POST['itsm_issue_list'];
	$itsm_inc_date = $_POST['itsm_inc_date'];
	$itsm_sev_list = $_POST['itsm_sev_list'];
	$itsm_prio_list = $_POST['itsm_prio_list'];
	$itsm_status_list = $_POST['itsm_status_list'];
	$s = $conn2->prepare("SELECT prod_ticket_id FROM tbl_prod_ticket WHERE app_id = ? AND issue_id = ? AND prod_ticket_by = ? AND prod_ticket_number = ? AND prod_ticket_is_active = ?");
	$s->bind_param("iiisi", $itsm_app_list, $itsm_issue_list, $id, $tix_num, $is_active);
	$s->execute();
	$s->store_result();
	if ($s->num_rows == 0)
	{
		$x = $conn2->prepare("INSERT INTO tbl_prod_ticket (prod_ticket_by, prod_ticket_number, app_id, issue_id, prod_ticket_date, prod_ticket_sev, prod_ticket_prio, status_id, prod_ticket_is_active) VALUES (?,?,?,?,?,?,?,?,?)");
		$x->bind_param("isiisiiii", $id, $tix_num, $itsm_app_list, $itsm_issue_list, $itsm_inc_date, $itsm_sev_list, $itsm_prio_list, $itsm_status_list, $is_active);
		$x->execute();
		$x->store_result();
		if ($x->affected_rows == 1)
		{
			echo "ITSM Ticket successfully submitted!";
			$x->close();
			$s->close();
			$conn->close();
			$conn2->close();
		}
		else
		{
			echo "Unable to submit ticket, please try again.";
			$x->close();
			$s->close();
			$conn->close();
			$conn2->close(); 
		}
	}
	else
	{
		echo "Ticket number: ".$tix_num." already existing on your account";
		$s->close();
		$conn2->close();
		$conn->close();
	}
}
?>