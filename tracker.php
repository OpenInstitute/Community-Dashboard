<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | SDG Tracker';
    $description = 'Welcome to Lanet Umoja Location Dashboard. Download your documents from this portal. Includes ID application, Funeral gatherings permit, abstract forms etc';
}
 include 'inc/head.php';

function cleanOutput($str, $useBreak=0)
{
	if($useBreak){ $str = nl2br($str); }
		$patterns[0] = "/`/";
		$patterns[1] = "/’/";
		
	$str = trim(html_entity_decode(stripslashes($str),ENT_QUOTES,'UTF-8'));	
	$str = iconv("ISO-8859-15", "UTF-8", iconv("UTF-8", "ISO-8859-15//IGNORE", $str));
	$str = preg_replace('/\s\s+/', ' ', trim($str));	
	
    return $str;
} 
  ?>

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
                            <div style="padding:15px 0;">
                                <h3 style="padding-left:15px;">SDG Tracker</h3><br/>
                              
							  <!-- start tracker -->
<?php
$goal_arr = array();
$targ_arr = array();

$sq_tr_a = "SELECT * FROM  `sdggoals` ORDER BY `goal_id` ";
$rs_tr_a = mysqli_query($conn, $sq_tr_a);
$rw = 1;
while($cn_tr_a = mysqli_fetch_assoc($rs_tr_a))
{	//displayArray($cn_tr_a);
  $goal_id = $cn_tr_a['goal_id'];
  $goal    = cleanOutput($cn_tr_a['goal']);
  
  $sq_tr_b = "SELECT * FROM  `sdgtargets` WHERE `goal_id` = '$goal_id'; ";
  $rs_tr_b = mysqli_query($conn, $sq_tr_b);
  $target_list = '';
  
  if( mysqli_num_rows($rs_tr_b)>=1 ) {	
	while($cn_tr_b = mysqli_fetch_array($rs_tr_b)) {
		$targets = cleanOutput($cn_tr_b['targets']);
		$target_list .= '<li>'.$targets.'</li>';
	}					
  }
   $expand = ($rw == 1) ? 'in' : '';
   $goal_arr[$goal_id] = '<div class="panel"><div class="panel-heading"><h4 class="panel-title">
		 <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$goal_id.'" class="collapsed">
		 <strong>'.$goal.'</strong></a></h4></div>
		 <div id="collapse'.$goal_id.'" class="panel-collapse collapse '.$expand.'"><div class="panel-body">
		<ul>'.$target_list.'</ul></div></div></div>';
	$rw += 1;
}

?>		

									  
		<div class="">
            <div class="panel-body">
                
                <div class="example-box-wrapper">
                    <div class="panel-group" id="accordion">
										
					<?php echo implode('',$goal_arr); ?>
					
                    </div>
                </div>
            </div>
        </div>
							  
							  <!-- end tracker -->
							   
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
<script type="text/javascript" src="assets/widgets/collapse/collapse.js"></script>
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