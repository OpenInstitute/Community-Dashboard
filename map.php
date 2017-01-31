<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">
<link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />

    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css">
    <link rel="stylesheet" href="assets/css/leaflet_awesome_markers.css">
    <!--this is new-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.js'></script>
    <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js"></script>
    <script src="assets/js/leaflet_awesome_markers.js"></script>
    <!--<script src="assets/js/leaflet.markercluster-src.js"></script>-->
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
   <style type="text/css">

    button {
        width: 100px;
    }
   </style>
<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Map';
    $description = 'Welcome to Lanet Umoja Location Dashboard';
}
 include 'inc/head.php'; ?>

<style type="text/css">
    .user-profile img{width: 28px !important;}
</style>
    <body>


    <div id="page-wrapper">
  <!-- Top bar here -->
  <?php include 'inc/topbar.php'; ?>
    <div id="page-sidebar">
    <div class="scroll-sidebar">
        <?php include 'inc/menu.php'; ?>
    </div>
    </div>
        <div id="page-content-wrapper">
            <div id="page-content">   
                    <div ng-view></div>
                    <!-- Everything that appears on the website goes here -->
                        <div class="panel panel-body col-md-12">
                            <div id="map" style="width: 100%"; ></div>
                        </div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
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
        var promise = $.get("modules/map_data.php",{id:"<?php echo $_GET['id']?>"});

        promise.then(function(data) {
        
        var n = $.parseJSON(data);

            for (var i = 0; i < n.features.length; i++) {
                var a = n.features[i];
                var title = a.properties["Name"];
                var marker = L.marker(L.latLng(a.geometry["coordinates"]), { title: title });
                marker.bindPopup(title);
                markers.addLayer(marker);
            }

            map.addLayer(markers);
        });
        
    }
  </script>
    <!-- WIDGETS -->
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
<!-- Bootstrap Dropdown -->
<!-- <script type="text/javascript" src="assets/widgets/dropdown/dropdown.js"></script> -->
<!-- Bootstrap Tooltip -->
<!-- <script type="text/javascript" src="assets/widgets/tooltip/tooltip.js"></script> -->
<!-- Bootstrap Popover -->
<!-- <script type="text/javascript" src="assets/widgets/popover/popover.js"></script> -->
<!-- Bootstrap Progress Bar -->
<script type="text/javascript" src="assets/widgets/progressbar/progressbar.js"></script>
<!-- Bootstrap Buttons -->
<!-- <script type="text/javascript" src="assets/widgets/button/button.js"></script> -->
<!-- Bootstrap Collapse -->
<!-- <script type="text/javascript" src="assets/widgets/collapse/collapse.js"></script> -->
<!-- Superclick -->
<script type="text/javascript" src="assets/widgets/superclick/superclick.js"></script>
<!-- Input switch alternate -->
<script type="text/javascript" src="assets/widgets/input-switch/inputswitch-alt.js"></script>
<!-- Slim scroll -->
<script type="text/javascript" src="assets/widgets/slimscroll/slimscroll.js"></script>
<!-- Slidebars -->
<script type="text/javascript" src="assets/widgets/slidebars/slidebars.js"></script>
<script type="text/javascript" src="assets/widgets/slidebars/slidebars-demo.js"></script>
<!-- PieGage -->
<script type="text/javascript" src="assets/widgets/charts/piegage/piegage.js"></script>
<script type="text/javascript" src="assets/widgets/charts/piegage/piegage-demo.js"></script>
<!-- Screenfull -->
<script type="text/javascript" src="assets/widgets/screenfull/screenfull.js"></script>
<!-- Content box -->
<script type="text/javascript" src="assets/widgets/content-box/contentbox.js"></script>
<!-- Overlay -->
<script type="text/javascript" src="assets/widgets/overlay/overlay.js"></script>
<!-- Widgets init for demo -->
<script type="text/javascript" src="assets/js-init/widgets-init.js"></script>
<!-- Theme layout -->
<script type="text/javascript" src="assets/themes/admin/layout.js"></script>
<!-- Theme switcher -->
<script type="text/javascript" src="assets/widgets/theme-switcher/themeswitcher.js"></script>

</div>
</body>
</html>