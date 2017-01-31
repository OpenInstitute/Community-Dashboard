<?php include 'inc/conn.inc';
	session_unset();
	session_destroy();
	header("location: login.php");
	
?>