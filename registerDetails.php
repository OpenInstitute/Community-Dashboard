<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){ header("location: login.php"); }
	if($_SESSION['RoleId'] <> 1) { header("location: index.php"); }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Downloads';
    $description = 'Welcome to Lanet Umoja Location Dashboard. Download your documents from this portal. Includes ID application, Funeral gatherings permit, abstract forms etc';
}
 include 'inc/head.php'; 
    $uid = $_GET['uid'];
    $srQ = "SELECT * FROM serviceregister where id='$uid'";
    $srR = $cndb->dbQuery($srQ);
    $srAssoc = $cndb->fetchRow($srR, 'assoc');
 ?>
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
                            <div class=" top col-md-12">
                                <center><h3>Case Details - <?php echo $srAssoc['name']; ?> </h3></center>
                                    <!--Pre filled Form Will come here  -->
    <form name="frm_serviceregister" id="frm_serviceregister" class="rwdvalid" method="post" action="_posts.php">
        <input type="hidden" name="formname" value="frm_serviceregister" />
        <div class="top form-group">
            <label class="col-md-3 control-label">Name</label>
            <div class="col-md-9">
            <input type="text" class="form-control required" name="name" id="name" value="<?php echo $srAssoc['name']; ?>" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">ID Number</label>
            <div class="col-md-9">
            <input type="text" class="form-control" name="idNumber" id="idNumber" value="<?php echo $srAssoc['id_number']; ?>" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">Mobile Number</label>
            <div class="col-md-9">
            <input type="text" class="form-control required" name="cell" id="cell" value="<?php echo $srAssoc['cell']; ?>" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">Location</label>
            <div class="col-md-9">
            <select name="location" class="form-control required" id="location">
                <option name="umoja">Umoja</option>
                <option name="umoja">Kiamunyeki</option>
                <option name="murunyu">Murunyu</option>
                <option name="other">Other Visit</option>
            </select>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">Case Type</label>
            <div class="col-md-9">
            <input type="text" class="form-control required" name="casetype" id="casetype" placeholder="Please indicate the purpose of visit/case" />
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">Statement/Remark</label>
            <div class="col-md-9">
            <textarea name="statement" id="statement" placeholder="Please enter statement or remark" rows="3" class="form-control textarea-smX required"></textarea>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">Date, Start & End Time</label>
            <div class="col-md-3">
                <input type="date" value="<?php echo date('d-M-Y'); ?>" class="form-control required" placeholder="date" name="date" id="date" >
            </div>
            <div class="col-md-3">
                <input type="time" value="<?php echo date('H:i'); ?>" class="form-control" placeholder="start time" title="start time" name="start" id="start">
            </div>
            <div class="col-md-3">
                <input type="time" value="" class="form-control" title="end time" placeholder="end time" name="end" id="end">
            </div>
        </div>
        
        
        <div class="clearfix"></div>
        <div class="top form-group">
            <label class="col-md-3 control-label">Add Follow-up?</label>
            <div class="col-md-9">
            <label><input type="radio" name="followup"  id="followup_y" value="1" /> &nbsp; Yes</label> &nbsp; 
            <label><input type="radio" name="followup" id="followup_n" value="0" checked /> &nbsp; No</label>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <?php /*?><div class="col-md-offset-3 col-md-8">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Start Time</label>
                        <input type="time" value="<?php echo date('H:i'); ?>" class="form-control" placeholder="start time" name="start" id="start">
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">End Time</label>
                        <input type="time" value="<?php echo date('H:i'); ?>" class="form-control" placeholder="end time" name="end" id="end">
                    </div> 
                </div>
                
            </div>
        <div class="clearfix"></div><?php */?>
        
        <div class="top col-md-offset-3 col-md-8 form-group">
            <div class="col-md-6" style="padding: 2.5px !important;">
                <button style="padding: 2.5px !important;" id="submitForm" type="submit" class="btn btn-primary form-control" name="submit">Submit </button>
            </div>
            <?php /*?><div class="col-md-6" style="padding:2.5px !important;">
                <button style="padding: 2.5px !important;" class="btn btn-success" id="followUp" name="followupbtn" data-toggle="modal" data-target="#myModal">Submit &amp; Follow Up</button>
            </div><?php */?>
        </div>
    </form>
                                    <!-- Pre filled form ends here -->
        <div class="col-md-12">
            <?php
                $fupQ = "SELECT * FROM serviceregister where parent_id='$uid' ORDER BY date_record";
                $fupR = $cndb->dbQuery($fupQ);
                // $fupArr = $cndb->fetchRow($fupR, 'array');
                if($cndb->recordCount($fupR) >= 1){
            ?>
                <table class="panel panel-body table display">
                   
                    <tbody>
            <?php

                while($fupArr = $cndb->fetchRow($fupR,'assoc') ){
            ?>  
            <tr>
                <td><label>Date: </label>&nbsp;<?php echo $fupArr['date']; ?></td>
                <td><label>Location: </label>&nbsp;<?php echo $fupArr['location']; ?></td>
            </tr>
            <tr>
                <td colspan="2"><label>Statement: </label><br/><?php echo $fupArr['statement']; ?></td>
            </tr>

            <?php } ?>
            </tbody>
        </table>
            <?php } ?>
            
        </div>
                            </div>
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