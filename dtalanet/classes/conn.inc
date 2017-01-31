<?php session_start();
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//echo 'http://'.$_SERVER['HTTP_HOST']; exit;
/*
if ('http://'.$_SERVER['HTTP_HOST'] == 'http://localhost'){
$base_url = 'http://localhost/lanetumoja/';
$hostname_conn = "localhost";
$database_conn = "lanetlocation_db";
$username_conn = "root";
$password_conn = "";

}else{
$base_url = $_SERVER['SERVER_NAME'];
$hostname_conn = "mysql.lanet.opencounty.org";
$database_conn = "lanetlocation_db";
$username_conn = "lanetcountyuser";
$password_conn = "lanetdbpassword";
} */

$base_url = 'http://localhost:8080/web2/oi_lanetnew/';
$hostname_conn = "localhost";
$database_conn = "db_oi_lanetlocation";
$username_conn = "root";
$password_conn = "mysqladmin";
//echo $database_conn; exit;
$conn = new mysqli($hostname_conn, $username_conn, $password_conn, $database_conn); 
$conn->select_db($database_conn);

require_once('cls.constants.php');
/* require_once('cls.config.php');
require_once('cls.formats.php');
require_once('cls.displays.php');
require_once('cls.select.php'); */
?>