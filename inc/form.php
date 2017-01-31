<?php include 'conn.inc';
$name = $org = $email = "";
$name = $_POST['name'];
$org = $_POST['organization'];
$email = $_POST['email'];

$formname = $_POST['update'];


if($formname == "update"){
	$q = "SELECT * FROM `public_login` where organization='$org' AND email ='$email'";
	$r = mysqli_query($conn, $q);
	$num = mysqli_num_rows($r);

	if($num == 1){
		header("location: ../account.php");
	}else{
     $upq ="UPDATE `public_login` SET `organization` = '$org' WHERE `public_login`.`name` = '$name'";
     $upr = mysqli_query($conn, $upq);
     if($upr == true){
     	$_SESSION['upstatus'] = "Account updated successfully";
     	header("location: ../account.php");
     }else{
     	$_SESSION['upfail'] = "Update not successful, please try again later or contact hello@openinstitute.com for assistance";
     	header("location: ../account.php");
     }
	}
}
?>