<?php
date_default_timezone_set('Asia/Manila');
 if (!defined('SERVERNAME')) define('SERVERNAME', '');
    if (!defined('USERNAME')) define('USERNAME', '');
    if (!defined('PASSWORD')) define('PASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', 'dbattendancehrm');
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
?>