<?php include 'conn.inc';
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$organization = $_POST['organization'];
$formname = $_POST['formname'];
$register = $_POST['register'];

if($formname=="login") {
 $success = "";
 $error = "";
     if(empty($_POST['email']) || empty($_POST['password'])){
       $error = "<p style=\"color:red; border: 2px solid red; padding:2px; margin:5px 0;\"> Invalid input. Either email or password field is blank</p>";
       header("location: ../login.php");
       }
       
     else {
      $email = stripslashes($email);
      $password = stripslashes($password);
     // $email = mysqli_real_escape_string($email);
      $password = md5(sha1(($password)));
      $qry = "SELECT roles.RoleUrl, roles.RoleId, public_login.name FROM public_login INNER JOIN roles ON public_login.RoleId = roles.RoleId WHERE public_login.email='$email' AND public_login.password='$password' LIMIT 1";
      //echo $qry; exit;
      $chk = mysqli_query($conn, $qry);
      $row = mysqli_num_rows($chk);
        if($row>=1){
      	$session = mysqli_fetch_assoc($chk);
        $_SESSION['user_session'] = $session['name'];
        $_SESSION['RoleId'] = $session['RoleId'];
        $k = substr($session['RoleUrl'],0,-1);
          //~ if($_SESSION['RoleId'] == 1){
            //~ header("location: ../index.php");
          //~ }elseif($_SESSION['RoleId'] == 2){
            //~ header("location: ../public/index.php");
          //~ }
          //~ else{
            header("location: ../$k");
          //}
   		} else {

          $error = "<p style=\"color:red; border: 2px solid red; padding:2px; margin:5px 0;\"> username and password do not match! Try again</p>";
          $_SESSION['error'] = $error;
          header("location: ../login.php");
        }

      	
     
    } 
}

if($register == "register") {

      $success = "";
      $err = "";
      $password = $_POST['password'];
      $passwordCheck = $_POST['passwordCheck'];

      $name = stripslashes($name);
      $email = stripslashes($email);
      $password = stripslashes($password);
      $passwordCheck = stripslashes($passwordCheck);
      $organization = stripslashes($organization);
      $password = md5(sha1($password));
      $passwordCheck = md5(sha1($passwordCheck));

      if($password !== $passwordCheck){
        $error = '<p style="border:solid 2px red; color: red; padding:2px;">Passwords do not match, Try again</p><br/>';
        $_SESSION['err'] = $error;
        header("location: ../register.php");
      }
      elseif(empty($name)){
          $error .= '<p style="border:solid 2px red; color: red; padding:2px;">Name is required</p> <br/>';
        $_SESSION['err'] = $error;
        header("location: ../register.php");}
      elseif(empty($email)){
          $error .= '<p style="border:solid 2px red; color: red; padding:2px;">Email address is required</p><br/>';
        $_SESSION['err'] = $error;
        header("location: ../register.php");}
      elseif(empty($organization)){
          $error .= '<p style="border:solid 2px red; color: red; padding:2px;">Organization is required</p><br/>';
        $_SESSION['err'] = $error;
        header("location: ../register.php");}
      else{
          $q = "INSERT INTO `public_login`( `name`, `organization`, `email`, `password`, `avatar`,`RoleId`,`signedInFrom`) VALUES ('$name', '$organization', '$email', '$password', '','2','Web')";                            
            if(mysqli_query($conn, $q)){
              $success = '<p style="border:solid 2px green; color: green; padding:2px;">Registration successful! click <a href="login.php">here</a> to sign in.</p>';
              $_SESSION['success'] = $success;
              header("location: ../register.php"); }
              else{
              $error = '<p style="border:solid 2px red; color:red; padding:2px;">Failed to register, please try again later.</p>';
              $_SESSION['err'] = $error;
              header("location: ../register.php");

            }
        }
  }


?>
