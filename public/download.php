<?php
include '../inc/conn.inc';
include '../inc/sessions.php'; 
$title = "Lanet Umoja | Public Downloads";
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>
<?php
if(isset($title)){
    echo $title;
} else{
  echo "Lanet Umoja Dashboard";
}
?>

  </title>
 

 
  <script src="../assets/vendor/chart-js/Chart.js"></script>
  <script>$.noConflict();</script>

  <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../assets/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="../assets/css/site.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">

  <!-- Plugins -->
  <link rel="stylesheet" href="../assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="../assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="../assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="../assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="../assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="../assets/vendor/flag-icon-css/flag-icon.css">

  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="../assets/vendor/chartist-js/chartist.css">
  <link rel="stylesheet" href="../assets/vendor/aspieprogress/asPieProgress.css">

  <!-- Page -->
  <link rel="stylesheet" href="../assets/css/datatable.css">
  <link rel="stylesheet" href="../assets/css/site.min.css">

  <!-- Fonts -->
  <link rel="stylesheet" href="../assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="../assets/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <!--[if lt IE 9]>
    <script src="../assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="../assets/vendor/media-match/media.match.min.js"></script>
    <script src="../assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="../assets/vendor/modernizr/modernizr.js"></script>
  <script src="../assets/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="dashboard">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<?php include '../inc/public-top-bar.php'; ?>
<?php include '../inc/menu_h.php'; ?>
<div class="container">
<center><img src="../assets/images/logo.svg" alt="Crown" style="width:150px; height:auto; "></center>
<center><div class="font-size-20 margin-bottom-30 blue-grey-800">Welcome to Lanet Umoja Public Downloads Section</div></center>
<center><p>Sorry, there is no public record to download at the moment, please visit later for more updates</p></center>


</div>
<!--footer section -->
</div>



<script src="../assets/vendor/jquery/jquery.js"></script>
  <!-- Footer -->
 <?php include '../inc/footer.php'; ?>

  <!-- Core  -->
  
  <script src="../assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="../assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="../assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="../assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="../assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="../assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="../assets/vendor/switchery/switchery.min.js"></script>
  <script src="../assets/vendor/intro-js/intro.js"></script>
  <script src="../assets/vendor/screenfull/screenfull.js"></script>
  <script src="../assets/vendor/slidepanel/jquery-slidePanel.js"></script>

  <!-- Plugins For This Page -->
  <script src="../assets/vendor/chartist-js/chartist.min.js"></script>
  <script src="../assets/vendor/gmaps/gmaps.js"></script>
  <script src="../assets/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <script src="../assets/vendor/chart-js/Chart.js"></script>
  <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="../assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="../assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="../assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="../assets/vendor/asrange/jquery-asRange.min.js"></script>
  <script src="../assets/vendor/bootbox/bootbox.js"></script>

  <!-- Scripts -->
  <script src="../assets/js/core.js"></script>
  <script src="../assets/js/site.js"></script>

  <script src="../assets/js/sections/menu.js"></script>
  <script src="../assets/js/sections/menubar.js"></script>
  <script src="../assets/js/sections/gridmenu.js"></script>
  <script src="../assets/js/sections/sidebar.js"></script>

  <script src="../assets/js/configs/config-colors.js"></script>
  <script src="../assets/js/configs/config-tour.js"></script>

  <script src="../assets/js/components/asscrollable.js"></script>
  <script src="../assets/js/components/animsition.js"></script>
  <script src="../assets/js/components/slidepanel.js"></script>
  <script src="../assets/js/components/switchery.js"></script>

  <!-- Scripts For This Page -->
  <script src="../assets/js/components/gmaps.js"></script>
  <script src="../assets/js/components/matchheight.js"></script>
 <script src="../assets/js/chartjs.js"></script>





</body>

</html>
