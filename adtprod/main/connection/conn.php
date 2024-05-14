<?php
date_default_timezone_set('Asia/Manila');
 if (!defined('SERVERNAME')) define('SERVERNAME', '');
    if (!defined('USERNAME')) define('USERNAME', '');
    if (!defined('PASSWORD')) define('PASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', '');
	$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!defined('SERVERNAME2')) define('SERVERNAME2', '');
    if (!defined('USERNAME2')) define('USERNAME2', '');
    if (!defined('PASSWORD2')) define('PASSWORD2', '');
    if (!defined('DBNAME2')) define('DBNAME2', '');
    $conn2 = new mysqli(SERVERNAME2, USERNAME2, PASSWORD2, DBNAME2);
    mysqli_set_charset($conn2, "utf8");
    if ($conn2->connect_error) 
    {
        die("Connection failed: " . $conn2->connect_error);
    }
	
	$x = $conn2->prepare("SELECT cache_version FROM js_version WHERE version_id = '1'");
	$x->execute();
	$x->store_result();
	$x->bind_result($cache_version);
	$x->fetch();
	 function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
    $ip = get_client_ip();
?>