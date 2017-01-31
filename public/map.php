<?php include '../inc/conn.inc'; 
session_start();
?>

<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html class="no-js css-menubar" lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="Benjamin Charagu">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <title>
    <?php
$title = "Lanet Umoja | Map";
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
  
<!--
  <script src='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.js'></script>
-->
<link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css">
    <link rel="stylesheet" href="../assets/css/leaflet_awesome_markers.css">
    <link rel="stylesheet" href="../assets/css/MarkerCluster.css">
    <link rel="stylesheet" href="../assets/css/MarkerCluster.Default.css">
 

    <!--this is new-->

    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../assets/js/leaflet_awesome_markers.js"></script>
    <script src="../assets/js/leaflet.markercluster-src.js"></script>
   <style type="text/css">

	button {
        width: 100px;
    }
   </style>
</head>
<body class="dashboard">
<?php include_once("../inc/analyticstracking.php") ?>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

	<?php include '../inc/public-top-bar.php'; ?>
	<?php include '../inc/menu_h.php'; ?>
	 <div class="page animsition" style="opacity: 9 !important;">
			<div class="container" >
				<ul class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <?php
				  $id=$_GET['id'];
				   if($id>=1){?>
				  <li><a  href="map.php">Household Map</a></li>
				  <li><a class="active" href="#">Household Location</a></li>
				  <?php } else {?>
				  <li><a class="active" href="#">Household Map</a></li>
				  <?php }?>
				  
				</ul>
				
				
				<div id="map" style="width: 100%"; ></div>

			</div>
	</div> <!--End animsition in menu.php -->
  <!-- Footer -->
 <?php include '../inc/footer.php'; ?>
 <script src="../assets/vendor/jquery/jquery.js"></script>

  <script type="text/javascript">
jQuery(document).ready(init)

	function init(){
		var cw = $('#map').width();
		$('#map').css({'height':(cw*2/3)+'px'});
		
		   L.mapbox.accessToken = 'pk.eyJ1IjoiYmNoYXJhZ3UiLCJhIjoiY2lpNTZvbjkxMDA1OHZnbTJmbWwyOTZubyJ9.FVdCc0e1upe7ivWtJ5zwkw'
			// Replace 'mapbox.streets' with your map id.
			var mapboxTiles = L.tileLayer('https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=' + L.mapbox.accessToken, { attribution: '<a href="http://www.mapbox.com/about/maps/" target="_blank">Terms &amp; Feedback</a>' });
			
			//possible colors 'red', 'darkred', 'orange', 'green', 'darkgreen', 'blue', 'purple', 'darkpuple', 'cadetblue'
		var householdIcon = L.AwesomeMarkers.icon({
			prefix: 'fa', //font awesome rather than bootstrap
			markerColor: 'blue', // see colors above
			icon: 'home' //http://fortawesome.github.io/Font-Awesome/icons/
		});
		var map = L.map('map')
			.addLayer(mapboxTiles)
			.setView([-0.2442221700, 36.16881354], 12);
		var markers = L.markerClusterGroup({ chunkedLoading: true });
		var promise = $.get("map_data.php",{id:"<?php echo $_GET['id']?>"});

		promise.then(function(data) {
		
		var n = $.parseJSON(data);

			for (var i = 0; i < n.features.length; i++) {
				var a = n.features[i];
				
				var marker = L.marker(L.latLng(a.geometry["coordinates"]));

				markers.addLayer(marker);
			}

			map.addLayer(markers);
		});
		
	}
  </script>	
 
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

</body>

</html>
