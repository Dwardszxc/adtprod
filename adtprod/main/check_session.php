<?php
session_start();
if (isset($_SESSION['USER_LAST_ACTIVITY']) && (time() - $_SESSION['USER_LAST_ACTIVITY'] > 6000))
{
    header("Location: logout.php");
}
elseif (!isset($_SESSION['USER_ID']) || !isset($_SESSION['USER_NAME']) || !isset($_SESSION['USER_XID']) || !isset($_SESSION['USER_TID']) || !isset($_SESSION['USER_TEAM']) || !isset($_SESSION['USER_SUBTEAM']) || !isset($_SESSION['USER_ROLE']))
{
    header("Location: logout.php");
}
$_SESSION['USER_LAST_ACTIVITY'] = time();
?>