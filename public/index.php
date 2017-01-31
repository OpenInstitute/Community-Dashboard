<?php
session_start();
if(!isset($_SESSION['user_session'])){
  
  header("location: login.php");
}
$title = "Lanet Umoja | Welcome";
include '../inc/conn.inc'; 
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
  <link rel="stylesheet" href="../assets/css/site.css">

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
<?php 
  include '../inc/public-top-bar.php';
  include '../inc/menu.php'; 
?>
 <div class="page animsition">
<div class="container">
<center><img src="../assets/images/logo.svg" alt="Crown" style="width:150px; height:auto; "></center>
<center><div class="font-size-50 margin-bottom-30 blue-grey-800">Welcome to Lanet Umoja Dashboard</div></center>
<!--
<div class="container">
  <div class="col-md-4 font-size-14">You asked, Font Awesome delivers with 20 shiny new icons in version</div>
  <div class="col-md-4">You asked, Font Awesome delivers with 20 shiny new icons in version</div>
  <div class="col-md-4">You asked, Font Awesome delivers with 20 shiny new icons in version</div>

</div>
-->

<!--analytics teaser-->
<div class="panel container">
<?php
  $nhquery = mysqli_query($conn,"SELECT * FROM `households` WHERE 1");
  $secquery = mysqli_query($conn,"SELECT * FROM `households` WHERE `security_crime` = 'yes'");
  $mosquery = mysqli_query($conn,"SELECT * FROM `households` WHERE `health_group_mosquito_nets` = 'yes'");
  $regquery = mysqli_query($conn,"SELECT COUNT(bw_reg_to_vote) as bw_voters FROM `households`  WHERE bw_reg_to_vote = 'YES'");
  
  //$hhreg = mysqli_query($conn,"SELECT * FROM `households` WHERE `bw_reg_to_vote` = 'yes'");
  //$fmreg = mysqli_query($conn,"SELECT * FROM `household_members` WHERE `group_member_reg` = 'yes'");
  $landQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE `property_farming` = 'yes'");
  $livestockQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE`property_livestock` = 'yes'");
  $elecQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE `house_facility_electricity` = 'yes'");
  $healthQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE `bw_health_facility` = 'yes'");

  $schoolchildrenQuery = mysqli_query($conn,"SELECT SUM(`number_of_children_in_household`) as ChildrenInSch FROM `households` where `children_school_facilities` is not null");


  $totHH = mysqli_num_rows($nhquery);
  $secIncidence = mysqli_num_rows($secquery);
  $mosqnets = mysqli_num_rows($mosquery);

  //$hhregv = mysqli_num_rows($hhreg);
  //$fmregv = mysqli_num_rows($fmreg);
  $totReg_SQL = mysqli_fetch_assoc($regquery);
  $totReg = $totReg_SQL['bw_voters'];
  
  $totSchCh_SQL = mysqli_fetch_assoc($schoolchildrenQuery);
  $totSchCh = $totSchCh_SQL['ChildrenInSch'];
  
  $landOwners = mysqli_num_rows($landQuery);
  $electricity = mysqli_num_rows($elecQuery);
  $livestock = mysqli_num_rows($livestockQuery);
  $healthVisit = mysqli_num_rows($healthQuery);


?>

<div class="container">
    <div class="sector col-md-4">
          <div class="heading family">
              <i class="fa fa-users"></i>
                <h3>Family and Property</h3>
          </div>
          <div class="col-md-12 no1">
                <h5>Lanet Umoja Households</h5>
                <h4><?php echo number_format($totHH); ?></h4> 
                <h6>TOTAL HOUSEHOLDS</h6>
                <h5 class="date">Recorded in the database (About 2000 records to be added)</h5>
          </div>
          <div class="col-md-12 no2">
                <h5>Lanet Umoja Household Heads Registered to vote</h5>
                <h4><?php echo number_format($totReg); ?></h4> 
                <h6>TOTAL HOUSEHOLD HEADS Registered to vote</h6>
                <h5 class="date">Recorded in the database</h5>
          </div>
    </div>
    <div class="sector col-md-4">
          <div class="heading agriculture">
              <i class="fa fa-pagelines"></i>
                <a href="analytics.php?MID=NA==&SMID=MQ=="><h3>Agriculture</h3></a>
          </div>
          <div class="col-md-12 no1">
                <h5>Crop Farming</h5>
                <h4><?php echo number_format($landOwners); ?></h4> 
                <h6>People grow crops in Lanet</h6>
                <h5 class="date">Recorded in the database</h5>
          </div>
          <div class="col-md-12 no2">
                <h5>Livestock Keeping</h5>
                <h4><?php echo number_format($livestock); ?></h4> 
                <h6>People keeping livestock in Lanet</h6>
                <h5 class="date">In the last year</h5>
          </div>
    </div>
    <div class="sector col-md-4">
          <div class="heading health">
              <i class="fa fa-ambulance"></i>
                  <a href="analytics.php?MID=NA==&SMID=Mw=="><h3>Health</h3></a>
          </div>
          <div class="col-md-12 no1">
                <h5>Mosquito nets</h5>
                <h4><?php echo number_format($mosqnets); ?></h4> 
                <h6>Houses fitted with mosquito nets</h6>
                <h5 class="date">As of May 2016</h5>
          </div>
          <div class="col-md-12 no2">
                <h5>Health facility</h5>
                <h4><?php echo number_format($healthVisit); ?></h4> 
                <h6>households have visited a health facility</h6>
                <h5 class="date">in the last year</h5>
          </div>
    </div>
</div>
   
<div class="clearfix"></div>
<div class="container">
    <div class="sector col-md-4">
      <div class="heading education">
          <i class="fa fa-book"></i>
            <a href="analytics.php?MID=NA==&SMID=Mg=="><h3>Education</h3></a>
      </div>  
      <div class="col-md-12 no1">
                <h5>Education</h5>
                <h4><?php echo number_format($totSchCh); ?></h4> 
                <h6>Number of school going children</h6>
                <h5 class="date">Recorded in the database</h5>
      </div>
    </div>
   
    <div class="sector col-md-4">
        <div class="heading security">
            <i class="fa fa-shield"></i>
                <a href="analytics.php?MID=NA==&SMID=NA=="><h3>Security</h3></a>
        </div>
        <div class="col-md-12 no1">
                <h5>Families affected by crime</h5>
                <h4><?php echo number_format($secIncidence); ?></h4> 
                <h6>INSECURITY INCIDENCES</h6>
                <h5 class="date">In the last year</h5>
        </div>

    </div> 
   
    <div class="sector col-md-4">
        <div class="heading energy">
            <i class="fa fa-bolt"></i>
              <a href="analytics.php?MID=NA==&SMID=NQ=="><h3>Energy</h3></a>
        </div>  
        <div class="col-md-12 no1">
                <h5>Lanet Umoja Households with Electricity</h5>
                <h4><?php echo number_format($electricity); ?></h4> 
                <h6>Households with electricity</h6>
                <h5 class="date">In the last year</h5>
        </div>
    </div>
 </div>  

 
  </div>



  <!--end of analytics teaser -->



</div>
<!--footer section -->
</div>


 <script src="http://maps.google.com/maps/api/js?sensor=false"></script>


  <!-- Footer -->
 <script src="../assets/vendor/jquery/jquery.js"></script>
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
