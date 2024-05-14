<?php
include('../connection/conn.php');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if(!IS_AJAX)
{
	die('<h1>404 Not Found</h1>');
}
else
{
	$user = strtoupper($_POST['username']);
	$pass = $_POST['password'];
	if (isset($user) && isset($pass))
	{
		if ($user == "X121603")
		{
			$s = $conn->prepare("SELECT emp.emp_id, emp.emp_xid, emp.emp_tid, emp.emp_name, emp.emp_team_id, emp.emp_subteam_id, emp.emp_email_add, role.role_name FROM tbl_employee AS emp INNER JOIN tbl_role AS role ON emp.emp_role_id = role.role_id WHERE emp.emp_xid = ? AND emp.emp_status_id = '1' AND emp.emp_subteam_id = '97' AND emp.emp_team_id = '35'");
		}
		else
		{
			$s = $conn->prepare("SELECT emp.emp_id, emp.emp_xid, emp.emp_tid, emp.emp_name, emp.emp_team_id, emp.emp_subteam_id, emp.emp_email_add, role.role_name FROM tbl_employee AS emp INNER JOIN tbl_role AS role ON emp.emp_role_id = role.role_id WHERE emp.emp_xid = ? AND emp.emp_status_id = '1' AND emp.emp_subteam_id = '99' AND emp.emp_team_id = '36'");
		}
		$s->bind_param("s", $user);
		$s->execute();
		$s->store_result();
		$num = $s->num_rows;
		$s->bind_result($id, $xid, $tid, $name, $teamid, $subteamid, $email, $role);
		$s->fetch();
		if ($num == "1")
		{
			$salt = $xid.$tid;
			$hashedpassword = hash('sha256', $pass.$salt);
			$x = $conn->prepare("SELECT emp_id FROM tbl_password WHERE emp_id = ? AND emp_password = ? AND emp_password_is_active = '1'");
			$x->bind_param("ss", $id, $hashedpassword);
			$x->execute();
			$x->store_result();
			$nump = $x->num_rows;
			if ($nump == "1")
			{
				session_start();
				$_SESSION['USER_LAST_ACTIVITY'] = time();
				$_SESSION['USER_ID'] = $id;
				$_SESSION['USER_NAME'] = $name;
				$_SESSION['USER_XID'] = $xid;
				$_SESSION['USER_TID'] = $tid;
				$_SESSION['USER_TEAM'] = $teamid;
				$_SESSION['USER_SUBTEAM'] = $subteamid;
				$_SESSION['USER_EMAIL'] = $email;
				$_SESSION['USER_ROLE'] = $role;
				echo "1";
				$s->close();
				$x->close();
				$conn->close();
			}
			else
			{
				echo "Incorrect XID/Password. Please try again.";
				$s->close();
				$x->close();
				$conn->close();
			}
		}
		else
		{
			echo "Incorrect XID/Password. Please try again.";
			$s->close();
			$conn->close();
		}
	}
	else
	{
		echo "Unknown error. Please try again";
	}
}
?>