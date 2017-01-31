<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | My Account';
    $description = 'View your account, edit and manage other users on admin level';
}
 include 'inc/head.php'; ?>

<style type="text/css">
    
</style>
    <body>


    <div id="page-wrapper">
  <!-- Top bar here -->
  <?php include 'inc/topbar.php'; ?>
    <div id="page-sidebar">
    <div class="scroll-sidebar">
        <?php include 'inc/account-menu.php'; ?>
    </div>
    </div>
        <div id="page-content-wrapper">
            <div id="page-content">   
                    <div ng-view></div>
                    <!-- Everything that appears on the website goes here -->
                       <div class="panel panel-body">
                           <center>
                            <h3>Your Profile - <?php echo $_SESSION['user_session']; ?></h3>
                            <div class="col-md-3 dp">
                                <?php
                                    if($chkrow >= 1){
                                    $av = $img['avatar'];
                                        if($img['RoleId']>1){
                                            if($img['signedInFrom'] !== 'Web'){
                                                echo $av;
                                            }else{
                                          $av = str_replace('src="', 'src="../', $av);
                                            }
                                        } 
                                    }
                                    else{
                                    $image = "<img src=\"assets/images/avatar.png\" title=\"". $_SESSION['user_session'] ."\">";
                                    echo $image;
                                    }
                                ?>
                            </div>
                            <div class="col-md-9">
                                <?php

                                    $sesname = $_SESSION['user_session'];
                                    $uq = "SELECT * from public_login WHERE name='$sesname'";
                                    $ures = mysqli_query($conn, $uq);

                                    $udata = mysqli_fetch_assoc($ures);
                                ?>
                                <form method="post" action="inc/form.php">
                                    <div class="top form-group">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" value="<?php echo $udata['name']; ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="top form-group">
                                        <label class="col-md-3 control-label">Organization</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="organization" value="<?php echo $udata['organization']; ?>" />
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="top form-group">
                                        <label class="col-md-3 control-label">E-mail</label>
                                        <div class="col-md-8">
                                        <input type="text" class="form-control" name="email" value="<?php echo $udata['email']; ?>"/>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <input type="hidden" value="update" name="update">
                                    <div class="top form-group">
                                        <div class="col-md-offset-4 col-md-4">
                                        <input type="submit" class="btn btn-primary form-control" style="padding: 2.5px !important;" name="submitProfile" value="Save &amp; Update Account" />
                                        </div>
                                    </div>

                                </form>
                                <div class="col-md-offset-3 col-md-6">
                                    <p>
                                        <?php
                                            if(isset($_SESSION['upstatus'])){
                                                echo $_SESSION['upstatus'];
                                                unset($_SESSION['upstatus']);
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                           </center>
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