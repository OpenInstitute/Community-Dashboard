<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
    if(count($_POST)>0) {
    $result = mysqli_query($conn,"SELECT * from public_login WHERE id='" . $_SESSION["userId"] . "'");
    $row=mysqli_fetch_array($result);

    $CurPassword = $_POST["currentPassword"];
    $CurPassword = stripslashes($CurPassword);
    $CurPassword = md5(sha1($CurPassword));

    //echo $CurPassword . ' -- '.$row["password"];

    $password = $_POST["newPassword"];
    $password = stripslashes($password);
    $password = md5(sha1($password));
        
    if($CurPassword == $row["password"]) {
    mysqli_query($conn,"UPDATE public_login set password='" . $password . "' WHERE id='" . $_SESSION["userId"] . "'");
    $message = "Password Changed";
    } else $message = "Current Password is not correct";
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang2="en">
<?php
if(!isset($title)){
    $title = 'Lanet Umoja | My Account - Change Password';
    $description = 'Change password';
}
 include 'inc/head.php'; ?>
<script>
function validatePassword() {
    var currentPassword,newPassword,confirmPassword,output = true;

    currentPassword = document.frmChange.currentPassword;
    newPassword = document.frmChange.newPassword;
    confirmPassword = document.frmChange.confirmPassword;
    var Nre = /[0-9]/;
    var alpre = /[a-z]/;
    var Capre = /[A-Z]/;
    if(!currentPassword.value) {
        currentPassword.focus();
        document.getElementById("currentPassword").innerHTML = "required";
        output = false;
    }
    
    else if(!newPassword.value) {
        newPassword.focus();
        document.getElementById("newPassword").innerHTML = "required";
        output = false;
    }
    
    else if(newPassword.value.length < 6) {
        //alert("Error: Password must contain at least six characters!");
        document.getElementById("message").innerHTML = "Error: Password must contain at least six characters!";
        newPassword.focus();
        output = false;
    }
    
    
    else if(!Nre.test(newPassword.value)) {
        document.getElementById("message").innerHTML = "Error: password must contain at least one number (0-9)!";
        newPassword.focus();
        output = false;
    }
    
    
    else if(!alpre.test(newPassword.value)) {
        document.getElementById("message").innerHTML = "Error: password must contain at least one lowercase letter (a-z)!";
        newPassword.focus();
        output = false;
    }
    
    
    else if(!Capre.test(newPassword.value)) {
        document.getElementById("message").innerHTML = "Error: password must contain at least one uppercase letter (A-Z)!";
        newPassword.focus();
        output = false;
    }
    
    else if(!confirmPassword.value) {
        confirmPassword.focus();
        document.getElementById("confirmPassword").innerHTML = "required";
        output = false;
    }
    
    else if(newPassword.value != confirmPassword.value) {
        newPassword.value="";
        confirmPassword.value="";
        newPassword.focus();
        document.getElementById("confirmPassword").innerHTML = "not same";
        output = false;
    }   
    return output;
}


</script>
<style type="text/css">
    .user-profile img{width: 28px !important;}
    .toppad{margin-top: 15px;
            font-size: 18px !important;
            font-weight: 250;
            line-height: 90;
            color:#333 !important;}
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
                    <!-- change password-->
            <div class="col-md-offset-2 col-md-8 col-md-offset-2 panel" style="margin-top:10px;">
                    <center><h1>Change Password</h1></center> 
                    <form name="frmChange" method="post" action="" onSubmit="return validatePassword()"  class="form-horizontal">
                        <center><p style="color: green; padding:2px;"><?php if(isset($message)) { echo $message; } ?></p></center>
            <div class="form-group">
                <label for="currentPassword" class="col-sm-offset-1 col-sm-2 control-label"><strong>Current Password</strong></label>
                <div class="col-sm-8">
                   <input type="password" name="currentPassword" class="form-control txtField"/><span id="currentPassword"  class="required"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="newPassword" class="col-sm-offset-1 col-sm-2 control-label"><strong>New Password</strong></label>
                <div class="col-sm-8">
                   <input type="password" name="newPassword" class="form-control txtField"/><span id="newPassword" class="required"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword" class="col-sm-offset-1 col-sm-2 control-label"><strong>Confirm Password</strong></label>
                <div class="col-sm-8">
                   <input type="password" name="confirmPassword" class="form-control txtField"/><span id="confirmPassword" class="required"></span>
                </div>
            </div>
            <div class="col-md-offset-3 col-md-3">
              <input type="submit" name="submit" value="Submit" class="btnSubmit btn btn-primary form-control">
            </div>
             <div class="clearfix" style="margin-bottom:10px;">&nbsp;<br/></div>
            <center><h5><em>Passwords must contain at least six characters, including uppercase, lowercase letters and numbers.</em></h5></center>
          </div>
         
      </form>  
      <div class="clearfix" style="margin-bottom:10px;">&nbsp;<br/></div> 
    </div>
                    <!--//change password-->
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