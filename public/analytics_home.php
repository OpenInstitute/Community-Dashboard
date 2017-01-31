<?php
include '../inc/conn.inc'; 
include '../inc/sessions.php'; 
$title = "Lanet Umoja Public Dashboard | Analytics Home";
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
if(isset($title)){
    echo $title;
} else{
  echo "Lanet Umoja Dashboard";
}
?>
</title>
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
<?php include_once("../inc/analyticstracking.php") ?>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<?php include '../inc/public-top-bar.php'; ?>
<?php include '../inc/menu_h.php'; ?>
 <div class="page animsition">
<div class="container">
    <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a class="active" href="#">Analytics</a></li>
    </ul>
    <div class="page-content">
    <?php require_once("../inc/queries.php");?>
      <!-- Panel -->
      <div class="panel">
        <div class="panel-body container-fluid">
        <!--Children-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Children </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/childrencard.php'; ?>
                <!--view more section 
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=Nw==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->
            </div>
            <!-- /.row -->
        <!--end of Children-->
        <!--Agriculture-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Agriculture</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/agriculturecard.php'; ?>
                <!--view more section -->
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=MQ==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->
            </div>
            <!-- /.row -->



        <!--end of Agriculture-->

        <!--Education-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Education</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/educationcard.php'; ?>
                 <!--view more section -->
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=Mg==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->

            </div>
            <!-- /.row -->
        <!--end of Education-->
        <!--Health-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Health</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/healthcard.php'; ?>
                 <!--view more section -->
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=Mw==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->
            </div>
            <!-- /.row -->
        <!--end of Health-->
        <!--Security-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Security</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/securitycard.php'; ?>
                 <!--view more section -->
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=NA==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->
            </div>
            <!-- /.row -->
        <!--end of Security-->
        <!--Energy-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Energy</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/energycard.php'; ?>
                 <!--view more section -->
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=NQ==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->
            </div>
            <!-- /.row -->
        <!--end of Energy-->
        <!--Water and Sanitation-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Water and Sanitation</h1>
                    <h4><?php echo $totalRows; ?> households have access to water</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php include '../inc/watercard.php'; ?>
                 <!--view more section -->
                <div class="clearfix"></div>
                <div class="row panel-footer">
                  <div class="col-md-offset-9 col-md-3">
                    <a href="analytics.php?MID=NA==&SMID=Ng==">
                              <div class="panel-footer">
                                  <span class="pull-left">View Details</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                  </div>
                </div>
                <!-- /. view more section -->

            </div>
            <!-- /.row -->
        <!--end of Water and sanitation-->
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
  <!-- End Page -->
</div>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <!-- Footer -->
  <?php include '../inc/footer.php'; ?>

  <!-- Core  -->
  <script src="../assets/vendor/jquery/jquery.js"></script>
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

  <script src="../assets/vendor/raphael/raphael-min.js"></script>
  <script src="../assets/vendor/morris-js/morris.min.js"></script>



</body>

</html>
