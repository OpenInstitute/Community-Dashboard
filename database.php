<?php include 'inc/conn.inc'; ini_set("display_errors","off");
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Household Database';
    $description = 'Welcome to Lanet Umoja Location Dashboard database. Use this database to search through the records for names and other search terms';
}
 include 'inc/head.php';

	$dbClass = 'household';
	
    $typ = "";
    $colname = array();
    $typ = ($_GET['typ']=="") ? "col" : $_GET['typ'];
    $col0 = ($_GET['col'] == "") ? '' : $_GET['col']; /* @Murage: '' instead of [] */
	//displayArray($col0);
    if(count($col0)> 1){	//!= 0
        foreach($col0 as $explore) {
            $colname[] = $explore['value'];
        }
    } else {
        //$colname= [];
    }
    //
    //$colname= [substr($coln, 0, -1)];
    $breadwinnername = stripslashes(str_replace("&quot;", "\"", ($_GET['bw'])));
    $locale = $_GET['loc'];
    if($breadwinnername!=''){$val=$breadwinnername;}
    if($locale!=''){$val=$locale;}
    if(count($colname)==0){$val=$colname;}
	
/* @Murage: Declare variables */
if(isset($_REQUEST['MID'])) { $MID = clean_request($_REQUEST['MID']);}  else {$MID = NULL;}
$page = 1;
						
 ?>
<!-- additional helpers for the skin tools -->
<link rel="stylesheet" type="text/css" href="assets/css/skintools.min.css">
<!--<script type="text/javascript" src="assets/js/skintools.min.js"></script>-->
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
                        
                        <div class="col-md-12">
                           <h2>Lanet Household Database</h2>
							
                           
                            <!-- Dropdown menu -->
                              <div class="panel" data-collapsed="0" style="top:10px;"><!-- to apply shadow add class "panel-shadow" -->
                            <!-- panel head -->
                            <div class="panel-heading" style="display: none;" id="TableList">
                              <form method="get" action="database.php">
                                <div class="panel-title col-md-10">
                                  <select class="selectpicker btn btn-color btn-default col-md-12" name="loc" id="area">
                                    <option value="">All Sub Locations</option>
                                  <?php
                                    $sql = "SELECT location FROM  sublocations";
                                    $result = mysqli_query($conn, $sql);
                                    while ($data = mysqli_fetch_array($result)) {
                                      if($locale == $data['location']){ $sel='selected'; }
                                        echo "<option value='".$data['location']."' ". $sel ."> ". $data['location'] ."</option>";
                                        $sel='';
                                    }
                                  ?>
                                  </select>
                                </div>
                                <div class="panel-title col-md-2">
                                   <input type='hidden' value="col" name="typ">
                                   <input type='submit' value="Submit">
                                </div>
                                <?php
                               

                        $raw_row = array('bread_winner_role','bw_age','bw_id','bw_reg_to_vote','bw_occupation','bw_phone','sub_location','plot_number','property_livestock','property_farming','property_farming_other','property_house','property_sanitation_facility','property_source_drinking_water','house_facility_electricity','house_facility_sanitation','security_crime','bw_diseases','bw_health_facility','bw_health_facility_other','health_group_immunization','health_group_mosquito_nets','energy_power_source','energy_cooking_facilities');

                        $clean_row = array('Role In The Family','Age','ID Number','Registered Voter','Occupation','Phone Number','Location','Plot Number','Has Livestock?','Does Farming?','Farming Detail','House Type','Sanitation Facility','Source of Drinking Water?','Is Electricity Installed?','Is There Sanitation Facility?','Have There Been Any Crime?','Health Category','Visited Health Facility?','Which Health Facility?','Are Children Immunized?','Are Mosquito Nets Available?','What Is The Power Source','Energy Source For Cooking');
						
						$columns_private = array();
						
                        ?>
                                <div class="containerX">
                                  <div class="col-md-12X" style="display:inline-block; position:relative;">
                                      
                        <?php
                        /* @Murage: Redeclare column accessibility based on roles */
						$t= '<th>Name</th>'; //<th>No. </th>
						if($_SESSION['RoleId'] == 1)  
						{ 	
							$colname= array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23); //
							?> <?php
						} 
						elseif($_SESSION['RoleId'] == 2)  
						{ 
							$colname= array(0,1,3,4,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23); //,19,20,21,22,23
							$t= '<th>No.</th>'; 
							
							/* Columns to hide in "Selection-List" */
							$columns_private = array(2,5,7); //[2,5,7]; 							
						}
						
						
						
						
                        if(count($colname)==0) { $colname= array(1,2,3,4,5,6,7); /*[1,2,3,4,5,6,7]*/ }

                            for($i=0; $i< count($clean_row); $i++){
                                if(in_array($i,$colname)){$checked='checked';}
                                
								 /* @Murage: Hide private columns from list  */
								if(!in_array($i,$columns_private)) 
								{ 
								echo '<label style="font-weight:normal"><input type="checkbox" '.$checked.' value='. $i .' name="col[]"> '. $clean_row[$i] .'</label> &nbsp; ';
								}
                                  $checked=''; 
                            }
                         //$colids=implode(",",$colname);
                         if($_SESSION['RoleId'] == 1){ 
                         $k= 'bread_winner_name';
                       }
                         //$t= '<th>No. </th><th>Name</th>';
                         /*for($j=0; $j < count($colname); $j++){
                             $l=$colname[$j];
                             $k .= ','. $raw_row[$l];
                             $t .= '<th>'. $clean_row[$l] .'</th>';
                         }*/
						foreach($colname as $j) {	
							 $k .= ','. $raw_row[$j];
							 $t .= '<th>'. $clean_row[$j] .'</th>';
						 }

                        ?>
                                  </div>
                                </div>
                                
                              </form>
                            </div>
                         
                              <div class="panel-heading" style="display: none;" id="SearchForm">
                                  <form method="get" action="database.php">
                                     <div class="container" style="max-width:100%;">         

                                    <div class="panel-title col-md-10">
                                      <input class="btn btn-color btn-default col-md-12" name="bw" id="breadwinner"/>
                                    </div>
                                    <div class="panel-title col-md-2">
                                       <input type='hidden' value="bw" name="typ">
                                       <input type='submit' value="Submit">
                                    </div>
                                    </div>
                                  </form>
                              </div> 
                          </div>
                          <!--//End of dropdown menu -->
                          <!-- Table begins here --> 
						  
						  <?php
						  /* @Murage */
						  //displayArray($colname);
						  ?>
                            <div class="example table-responsive">
                                    <table id="tb_household" class="panel table table-striped dataTable display" data-page-size="10" data-plugin="dataTable">
                                        <thead>
                                          <tr>
                                            <?php echo $t; ?>
                                          </tr>
                                        </thead>
                                        <tbody>
										</tbody>
									</table>
                            <div>
                          <!-- Table ends here -->
                          

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

    <!--<div class="site-skintools">
        <div class="site-skintools-inner">
            <div class="site-skintools-toggle">
                <i class="glyph-icon icon-gear primary-600"></i>
            </div>
            <div class="site-skintools-content">
                <div class="nav-tabs-horizontal">
                    <ul role="tablist" data-plugin="nav-tabs" class="nav nav-tabs nav-tabs-line">
                        <li role="presentation" class="active">
                            <a role="tab" aria-controls="skintoolsList" href="#skintoolsList" data-toggle="tab" aria-expanded="true">List</a>
                        </li>
                        <li role="presentation" class="">
                            <a role="tab" aria-controls="skintoolsNavbar" href="#skintoolsSearch" data-toggle="tab" aria-expanded="false">Search</a>
                        </li>
                        <li role="presentation" class="">
                            <a role="tab" aria-controls="skintoolsPrimary" href="#skintoolsPrint" data-toggle="tab" aria-expanded="false">Print</a>
                        </li>
                    </ul>
                    <div class="tab-content">
				
                    </div>
                </div>
            </div>
        </div>
    </div>-->
	
	
<?php include("_scripts.php"); ?>
	
</body>
</html>