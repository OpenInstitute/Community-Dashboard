<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){ header("location: login.php"); }
	if($_SESSION['RoleId'] <> 1) { header("location: index.php"); }
 ?>
<!DOCTYPE html> 
<html  lang="en"> <?php /*?> ng-app="monarchApp" <?php */?>

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Service Register';
    $description = 'Welcome to Lanet Umoja Location Service Register';
}
 include 'inc/head.php'; ?>
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
                        <div class="panel col-md-12">
                            
                            <iframe  onload="resizeIframe(this)" id="sr_frame" src="sr/index.php#reports" class="col-md-12" style=" border:none; " scrolling="off"></iframe>
                            <?php //include("sr/index.php"); ?>
							
                        </div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
    <!-- WIDGETS -->
<script type="text/javascript">
$(".bReport").click(function(){

    var k = $(this).attr("name");
    $.ajax({url: "modules/sr_ajax.php?param="+k, success: function(result){
        $("#report").html(result);
    }});
});
</script>
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




<?php include("_scripts.php"); ?>

</div>
</body>
</html>