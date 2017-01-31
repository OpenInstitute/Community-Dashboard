<?php
include './inc/conn.inc'; 
if(count($_POST)>0) {
$currentEmail = $_POST["currentEmail"];
$result = mysqli_query($conn,"SELECT * from public_login WHERE email='" . $currentEmail . "' LIMIT 1");
$row=mysqli_fetch_assoc($result);
$name = $row["name"];
$password = substr(hash('sha512',rand()),0,12);
	if($row["id"]>=1) {
		$to      = $currentEmail;//'nobody@example.com';
		$subject = '[Lanet Umoja Dashboard] Password Reset - ';
		$Mmessage = 'Someone requested that the password be reset for the following account:

		http://lanet.opencounty.org/

		Username: '.$name.'

		The administrator has set your new password.

		p: '.$password.'

		Please change the password as soon as you login.

		Thank you.';
		//echo $Mmessage; exit;
		$headers = 'From: hello@openinstitute.com' . "\r\n" .
			'Reply-To: hello@openinstitute.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $Mmessage, $headers);

		$password = stripslashes($password);
		$password = md5(sha1($password));

	mysqli_query($conn,"UPDATE public_login set password='" . $password . "' WHERE id='" . $row["id"] . "'");
	$message = "Password changed and sent to your Email address!";
	} else $message = "The Email submited does not exist. Try again!";
}

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Admin Analytics Main Page">
  <meta name="author" content="Open Institute">

  <title>
<?php

    echo "Lanet Umoja Dashboard | Password Reset";;

?>
  </title>
  <link rel="apple-touch-icon" href="./assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="./assets/images/favicon.ico">
<style>

/*input {
font-family:Arial;
font-size:14px;
}
label{
font-family:Arial;
font-size:14px;
color:#999999;
}
.tblSaveForm {
border-top:2px #999999 solid;
background-color: #f8f8f8;
}
.tableheader {
background-color: #fedc4d;
}
.btnSubmit {
background-color:#fd9512;
padding:5px;
border-color:#FF6600;
border-radius:4px;
color:white;
}
.message {
color: #FF0000;
text-align: center;
width: 100%;
}
.txtField {
padding: 5px;
border:#fedc4d 1px solid;
border-radius:4px;
}
.required {
color: #FF0000;
font-size:11px;
font-weight:italic;
padding-left:10px;
}*/
</style>
  <!-- Stylesheets -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="./assets/css/site.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">

  <!-- Plugins -->
  <link rel="stylesheet" href="./assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="./assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="./assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="./assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="./assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="./assets/vendor/flag-icon-css/flag-icon.css">

  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="./assets/vendor/chartist-js/chartist.css">
  <link rel="stylesheet" href="./assets/vendor/aspieprogress/asPieProgress.css">

  <!-- Page -->
  <link rel="stylesheet" href="./assets/css/datatable.css">
  <link rel="stylesheet" href="./assets/css/site.min.css">
  <link rel="stylesheet" href="./assets/css/site.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="./assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="./assets/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <!--[if lt IE 9]>
    <script src="./assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="./assets/vendor/media-match/media.match.min.js"></script>
    <script src="./assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="./assets/vendor/modernizr/modernizr.js"></script>
  <script src="./assets/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>

<script>
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validate() {
  var output = true;
  var email = $(".currentEmail").val();
  
  if (!validateEmail(email)) {        
	document.getElementById("message").innerHTML = "Error: Sorry the Email is not well Structured";
	output = false;
  }
  return output;
}


</script>
</head>
<body class="dashboard">
<?php include_once("./inc/analyticstracking.php") ?>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
 <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <a href="index.php" style="text-decoration:none; color: #fff;">
          <img class="navbar-brand-logo" src="./assets/images/logo.svg" title="Kenya Coat of Arms">
          <span class="navbar-brand-text"> Lanet Umoja</span>
        </a>
      </div>
      
    </div>
    
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
          <li class="hidden-xs" id="toggleFullscreen">
            <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>
         
          
        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Title Bar Right -->
        <ul class="nav navbar-toolbar">
      <li >
            <?php
              $hseQuery = mysqli_query($conn, "SELECT * FROM households ");
              $totHse = mysqli_num_rows($hseQuery);
            ?>
              <span class="panel-title example-title center"><strong><?php echo $title;?> Data From <strong><?php echo $totHse; ?> Households</strong></strong></span>
          </li>
         </ul>
        <!-- End Title Bar Right -->

        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
           <li class="dropdown">
            <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
            <strong><?php echo $_SESSION['user_session']; ?></strong> &nbsp;
              <span class="avatar avatar-online">
                <img src="./assets/portraits/chief.jpg" alt="...">
                <i></i>
              </span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a href="javascript:void(0)" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
              </li>
              <li class="divider" role="presentation"></li>
              <li role="presentation">
                <a href="./logout.php" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
              </li>
            </ul>
          </li>
          
          
         
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->

      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="site-search" placeholder="Search...">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->
    </div>
  </nav>

	<div class="page animsition">
	<!--	<div class="container text-center">
			<h1>Forgot Password</h1>
			<form name="frmChange" method="post" action="" onSubmit="return validate()"  class="form-horizontal">
			<div style="width:500px;" >
			<div id="message" class="message"><?php //if(isset($message)) { echo $message; } ?></div>
			<table  class="tblSaveForm table table-striped">
			
			<tr>
			<td width="40%"><label>Your Email</label></td>
			<td width="60%"><input type="text" name="currentEmail" class="currentEmail"/><span id="currentEmail"  class="required"></span></td>
			</tr>
			<tr>
			<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
			</tr>
			
			</table>
			<h5>Please submit your email. We will receive a notification soon!</h5>
			</div>
			</form>
		</div>-->

    <div class="panel col-md-offset-2 col-md-8 col-md-offset-2" style="margin-top:10px;">
      <center><h1>Forgot Password</h1></center>
      <center><h5><em>Please submit your email. You will receive a notification soon!</em></h5></center>
      <center>
        <p style="color: green; padding:2px;"><?php if(isset($message)) { echo $message; } ?></p>
      </center>
      <form name="frmChange" method="post" action="" onSubmit="return validate()"  class="form-horizontal">
          <div style="width:85%; margin:auto;">
             <div class="form-group">
                <label for="currentEmail" class="col-sm-2 control-label"><strong>Email</strong></label>
                <div class="col-sm-10">
                   <input type="text" name="currentEmail" class="form-control currentEmail"/>
                </div>
                <div class="col-md-12">
                  <span id="currentEmail"  class="required"></span></td>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-9">
              <input type="submit" name="submit" value="Submit" class="btnSubmit btn btn-primary form-control">
            </div>
          </div>
          <div class="clearfix" style="margin-bottom:10px;">&nbsp;<br/></div>
      </form>
    </div>
	  <!-- End Page -->
	</div>


 <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <!-- Footer -->
  <?php include './inc/footer.php'; ?>

  <!-- Core  -->
  <script src="./assets/vendor/jquery/jquery.js"></script>
  <script src="./assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="./assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="./assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="./assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="./assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="./assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="./assets/vendor/switchery/switchery.min.js"></script>
  <script src="./assets/vendor/intro-js/intro.js"></script>
  <script src="./assets/vendor/screenfull/screenfull.js"></script>
  <script src="./assets/vendor/slidepanel/jquery-slidePanel.js"></script>

  <!-- Plugins For This Page -->
  <script src="./assets/vendor/chartist-js/chartist.min.js"></script>
  <script src="./assets/vendor/gmaps/gmaps.js"></script>
  <script src="./assets/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <script src="./assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="./assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="./assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="./assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="./assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="./assets/vendor/asrange/jquery-asRange.min.js"></script>
  <script src="./assets/vendor/bootbox/bootbox.js"></script>

  <!-- Scripts -->
  <script src="./assets/js/core.js"></script>
  <script src="./assets/js/site.js"></script>

  <script src="./assets/js/sections/menu.js"></script>
  <script src="./assets/js/sections/menubar.js"></script>
  <script src="./assets/js/sections/gridmenu.js"></script>
  <script src="./assets/js/sections/sidebar.js"></script>

  <script src="./assets/js/configs/config-colors.js"></script>
  <script src="./assets/js/configs/config-tour.js"></script>

  <script src="./assets/js/components/asscrollable.js"></script>
  <script src="./assets/js/components/animsition.js"></script>
  <script src="./assets/js/components/slidepanel.js"></script>
  <script src="./assets/js/components/switchery.js"></script>

  <!-- Scripts For This Page -->
  <script src="./assets/js/components/gmaps.js"></script>
  <script src="./assets/js/components/matchheight.js"></script>
  <script src="./assets/js/chartjs.js"></script>

  <script src="./assets/vendor/raphael/raphael-min.js"></script>
  <script src="./assets/vendor/morris-js/morris.min.js"></script>



</body>

</html>

