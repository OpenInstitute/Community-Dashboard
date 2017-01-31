<?php include 'inc/conn.inc'; ini_set("display_errors","off");
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Gender Database';
    $description = 'Welcome to Lanet Umoja Location Dashboard database. This is the database  for SDG5 Gender Data';
}
 include 'inc/head.php';
 
$dbClass = 'gender';
	
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
                            <h2>Lanet Gender Database</h2>

                            <!-- Dropdown menu -->
                            <div class="panel" data-collapsed="0" style="top:10px;" style="display: none;"><!-- to apply shadow add class "panel-shadow" -->
                            	<!-- panel head -->
                            	<div class="panel-heading" style="display: none;" id="TableList">
                              <form method="get" action="gender-database.php">
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
                               

                        $raw_row = array('cluster', 'age', 'gender', 'profession', 'employment', 'group_number', 'group_1name', 'group_1purpose', 'group_1gender', 'group_1contribution', 'group_2name', 'group_2purpose', 'group_2gender', 'group_2contribution', 'group_3name', 'group_3purpose', 'group_3gender', 'group_3contribution', 'group_4name', 'group_4purpose', 'group_4gender', 'group_4contribution', 'group_5name', 'group_5purpose', 'group_5gender', 'group_5contribution', 'violence_physical', 'violence_sexual', 'violence_psych');

                        $clean_row = array('Cluster', 'Age', 'Gender', 'Profession', 'Education Level', 'Number of Groups', 'Group 1 Name', 'Group 1 Purpose', 'Group 1 Gender', 'Group 1 Monthly Contribution', 'Group 2Name', 'Group 2 Purpose', 'Group 2 Gender', 'Group 2 Monthly Contribution', 'Group 3 Name', 'Group 3 Purpose', 'Group 3 Purpose', 'Group 3 Monthly Contribution', 'Group 4 Name', 'Group 4Purpose', 'Group 4 Gender', 'Group 4 Monthly Contribution', 'Group 5 Name', 'Group 5 Purpose', 'Group 5 Gender', 'Group 5 Monthly Contribution', 'Physical Violence?', 'Sexual Violence?', 'Psychological Violence?');
						
						$columns_private = array();
						
                        ?>
                                <div class="containerX">
                                  <div class="col-md-12X" style="display:inline-block; position:relative;">
                                      
                        <?php
                        /* @Murage: Redeclare column accessibility based on roles */
						          $t= '<th tabindex="0">No. </th><th tabindex="0">Sub-Location</th>';
				 	            $colname= array(0,1,2,3,4,5,6,7,8,9,26,27,28); //[1,2,3,4,5,6,7];
						
						
						
                        if(count($colname)==0) { $colname= array(1,2,3,4,5,6,7); /*[1,2,3,4,5,6,7]*/ }

                            //for($i=0; $i< count($clean_row); $i++){
							foreach($clean_row as $i => $cr_val) {
                                if(in_array($i,$colname)){$checked='checked';}
                                
								 /* @Murage: Hide private columns from list  */
								if(!in_array($i,$columns_private)) 
								{ 
								echo '<label style="font-weight:normal"><input type="checkbox" '.$checked.' value='. $i .' name="col[]"> '. $clean_row[$i] .'</label> &nbsp; ';
								}
                                  $checked=''; 
                            }
                         //$colids=implode(",",$colname);
                         
                         $k= 'sublocation';
                        
						$tabindex = 0;
                        //for($j=0; $j < count($colname); $j++){
						foreach($colname as $j) {	 							 
                             //$l = $colname[$j];
                             $k .= ','. $raw_row[$j];
                             $t .= '<th tabindex="'.$tabindex.'">'. $clean_row[$j] .'</th>';
							 //$tabindex ++;
                         }

                        ?>
                                  </div>
                                </div>
                                
                              </form>
                            </div>
                         
                              <div class="panel-heading" style="display: none;" id="SearchForm">
                                  <form method="get" action="gender-database.php">
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
					<table id="tb_gender" class="panel table table-striped dataTable display" data-page-size="50" data-plugin="dataTable">
						<thead>
						  <tr>
							<?php echo $t; ?>
						  </tr>
						</thead>
						<tbody>
                                        
                            <?php
                            $start=0;
                            $limit=5000;
                             
                            if(isset($_GET['page']))
                            {
                                $page=$_GET['page'];
                                $start=($page-1)*$limit;
                            }
                            else{
                                $id=1;
                            }
                                if (($locale == "")) {
                                      $subloc = "";
                                    } 
                                    elseif (($locale != "")) {
                                      $subloc = " WHERE 1 OR sublocation ='". $locale ."'" ;
                                    }
                                    elseif (($locale == "")) {
                                      //$subloc = " WHERE MATCH(bread_winner_name) AGAINST('$breadwinnername' IN BOOLEAN MODE)";
									  $subloc = " WHERE CONVERT(CONCAT($k) USING latin1) like '%".$sublocation."%'  " ;
                                    }
                                   
                            $query=mysqli_query($conn,"SELECT post_id, $k FROM `mob_form_posts_sdg_gender` $subloc ORDER BY sublocation DESC  LIMIT $start, $limit");					
							
							/* @Murage: Row numbers */
							$z = ($page > 1) ? ((($page - 1) * $limit)) : 0;
							

							//print 10 items
							while($result=mysqli_fetch_array($query))
							{

							   $z++;
							  ?>
									  <tr>
										<td><?php echo $z; ?></td>
                    <td><?php echo $result['sublocation']; ?></td>
										<?php 
										/* @Murage: added IF below */	
										for($j=0; $j < count($colname); $j++){
										  $col_=$colname[$j];
										  echo '<td>'. $result[$raw_row[$col_]] .'</td>';
										}
										?>
									  </tr>
							   <?php } ?>
									  
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