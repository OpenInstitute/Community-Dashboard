<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Welcome';
    $description = 'Welcome to Lanet Umoja Location Dashboard';
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
                        <div class="col-md-12">
                            <div class="panel panel-body">
                                <div class="toppad col-md-12">
                                    <center><h2>WELCOME TO LANET UMOJA DASHBOARD</h2></center>
                                    <div class="toppad col-md-6">
                                        <p>Lanet Umoja project is a programme of Global Goals for Local Impact. It was initiated by the Open Institute and Chief Kariuki of Lanet Location in Nakuru county, Kenya. The purpose of this dashboard was to domesticate SDGs to subnational level especially to the grassroot level, to the people who need it most and use the citizens as data producers.</p>
                                    </div>
                                    <div class="toppad col-md-6">
                                        <p>Using the data in the dashboard, the chief is able to make better and informed data driven decisions for his people and also monitor his people's security through the Nyumba kumi initiative by the government. Citizens are also able to prioritize what is important to them according to the five SDGs the chose to achieve.</p>
                                    </div>
                                </div>
                            </div>
                            <?php include 'modules/generalstats.php'; ?>
                           <!-- <div class="panel panel-body col-md-12" style="min-height:200px;">
                                <center><h2>Our Partners and Friends</h2></center>
                                <?php
                                    // $pq = "SELECT * FROM partners";
                                    // $pr = mysqli_query($conn, $pq);
                                ?>
                                <div class="partners col-md-offset-2 col-md-8 col-md-offset-2">
                                <ul>
                                <?php
                                    // while($res = mysqli_fetch_array($pr)){
                                ?>
                                    // <li><a href="<?php //echo $res['partnerUrl'] ?>" alt="<?php echo $res['partnerName'] ?>" target="blank"><img src="assets/images/partners/<?php echo $res['partnerImg'] ?>" alt="<?php echo $res['partnerName'] ?>"></a></li>
                                <?php //} ?>
                                    
                                </ul>
                            </div>
                        </div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
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