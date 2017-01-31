<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Downloads';
    $description = 'Welcome to Lanet Umoja Location Dashboard. Download your documents from this portal. Includes ID application, Funeral gatherings permit, abstract forms etc';
}
 include 'inc/head.php'; ?>

<style type="text/css">
    .user-profile img{width: 28px !important;}
    .padded{ padding: 10px 0; }
    .top{ margin-top: 5px; }
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
                        <div class="panel col-md-12">
                            <div class=" top col-md-8">
                                <h3>Downloads</h3><br/><br/>
                               
                                <?php 
                                $catsql = "SELECT DISTINCT id, name FROM `downloadscat` WHERE 1";
                                    $catres = mysqli_query($conn, $catsql);
                                    $catrows = mysqli_num_rows($catres);                          
                                    while($cdata = mysqli_fetch_array($catres)){
                                    $did = $cdata['id'];
                                    
                                ?>

                                 <div class="col-md-12 bg-blue">
                                     <h4 class="padded"><?php echo $cdata['name']; ?></h4>
                                 </div> 
                                 <?php     $dsql = "SELECT * FROM downloads WHERE dcatid = $did";
                                        $dres = mysqli_query($conn, $dsql);
                                        while($downl = mysqli_fetch_array($dres)){
                                 ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><?php echo $downl['title']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $downl['description'];?></td>
                                            </tr>
                                            <tr>
                                                <td><a href=<?php echo '"downloads/'.$downl['linkname'].'.pdf"';?> download><i class="glyph-icon icon-download"></i> Download</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php } } ?>
                            </div>

                            <div class="top col-md-4">
                                <h3>Resources</h3><br/>
                                <div class="col-md-12 bg-blue">
                                    <h4 class="padded">Related Websites</h4>
                                </div>
                                <div class="clearfix"></div>
                                <ol type="i">
                                    <li><a href="#">Ministry of Internal Security</a></li>
                                    <li><a href="#">Nyumba Kumi</a></li>

                                </ol>

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