<?php session_start();
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//echo 'http://'.$_SERVER['HTTP_HOST']; exit;
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
}
//echo $database_conn; exit;
$conn = new mysqli($hostname_conn, $username_conn, $password_conn, $database_conn); 
$conn->select_db($database_conn);

require_once('cls.config.php');
include_once('cls.formats.php');
?>