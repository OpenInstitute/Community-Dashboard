<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | SDG Analytics';
    $description = 'Welcome to Lanet Umoja Location Dashboard. SDG Analytics are viewed from this page';
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
                        <div class="example-box-wrapper">
							<ul class="nav-responsive nav nav-tabs">
						<?php
						$k=1;
						//$purpose = ["Basic Household Data", "School Facilities", "Property", "Water & Sanitation", "Energy", "Expenditure", "Health"];
						$purpose = array("Employment", "Social", "Gender Based Violence", "Health", "Security");

						for($i=0; $i<count($purpose);$i++)
						{
							if ($k == 1) {$act = ' class="active"';}
							echo '<li data-interest="'. $purpose[$i].'" class="tab" id="b'. $k .'" '. $act .'><a href="#tab'. $k .'"  data-toggle="tab">'. $purpose[$i].'</a></li>';
							$k++;
							$act = '';
						}
						?>
							
						</ul>
						<div class="tab-content" style="color:#222;">
						
						<!-- Employment Tab Data -->
							<div class="tab-pane active" id="tab1">
								
								<div class="col-md-12">
									<div class="col-md-5">
										<center><p id="eduLevlLabel"></p></center><br>
										<div class="row clearfix">
											<div id="eduLevel" class="flot-base fbchart"></div>
										</div>
										<p id="eduLevelNarative"></p>
									</div> 
								
									
									  
									<div class="col-md-5 col-md-offset-2 ">
																			
									</div>
																
								</div>
								
								<div class="col-md-12"><p>&nbsp;</p></div>
								
								<div class="col-md-12">
									<!-- @Scholarship access -->   
									<div class="col-md-5">
										<center><p id="bwDataLabel13"></p></center><br>
										<div class="row clearfix">
											<div id="bwData13" class="flot-base fbchart"></div>
										</div>
										<p id="bwDataNarative13"></p>									
									</div>	
									
									<!-- @Scholarship access by bw-gender -->   
									<div class="col-md-offset-2 col-md-5">
										<center><p id="bwDataLabel15"></p></center><br>
										<div class="row clearfix">
											<div id="bwData15" class="flot-base fbchart"></div>
										</div>
										<p id="bwDataNarative15"></p>									
									</div>								
								</div>
					
					
					
							</div>
							<!-- //Employment Data -->
							
							<!-- Social Data -->
							<div class="tab-pane " id="tab2">
								
								<div class="col-md-12">
									<!-- @Food -->  
									<div class="col-md-5">
										<center><p id="mContribLabel"></p></center><br>
										<div class="row clearfix">
											<div id="mContrib" class="flot-base fbchart"></div>
										</div>
										<p id="mContribNarative"></p>										
									</div>
									
									<!-- @School Fees -->   
									<div class="col-md-5 col-md-offset-2">
										<center id="amContribLabel"></center>
										<div class="row clearfix">
											<div id="amContrib" class="flot-base fbchart"></div>
										</div>
										<p id="amContribNarative"></p>
									</div>
								</div>
								
								
								
								<div class="col-md-12">
									<!-- @Rent/Housing -->  
									<div class="col-md-5">
										<center><p id="expenditureLabel62"></p></center><br>
										<div class="row clearfix">
											<div id="expenditure62" class="flot-base fbchart"></div>
										</div>
										<p id="expenditureNarative62"></p>									
									</div>
									
									
									<!-- @Medical -->  
									<div class="col-md-5 col-md-offset-2">
										<center><p id="expenditureLabel64"></p></center><br>
										<div class="row clearfix">
											<div id="expenditure64" class="flot-base fbchart"></div>
										</div>
										<p id="expenditureNarative64"></p>									
									</div>
									
								</div>
								
								
								<div class="col-md-12">
									
									
									
								</div>
								
								
						  </div>
						  <!-- // Social Data -->
						  <!-- Gender Based Violence -->
						  <div class="tab-pane " id="tab3">
								
								<div class="col-md-12">
								<!-- Physical Violence -->
								<div class="col-md-5">
									<center><p id="genPVLabel"></p></center><br>
									<div class="row clearfix">
										<div id="genPV" class="flot-base fbchart"></div>
									</div>
									<p id="genPVNarative"></p>
									
								</div>
								
								<!--Sexual Violence -->   
								<div class="col-md-offset-2 col-md-5">
									<center><p id="genSVLabel"></p></center><br>
									<div class="row clearfix">
										<div id="genSV" class="flot-base fbchart"></div>
									</div>
									<p id="genSVNarative"></p>
									
								</div>
								</div>
								
								<p> <br> &nbsp; <br></p>
								<div class="clearfix col-md-12">
								<div class="col-md-5">
									<center><p id="genPSVLabel"></p></center><br>
									<div class="row clearfix">
										<div id="genPSV" class="flot-base fbchart"></div>
									</div>
									<p id="genPSVNarrative"></p>
									
								</div>
						 
								<div class="col-md-offset-2  col-md-5">
									<center><p id="propertyLabel33"></p></center><br>
									<div class="row clearfix">
										<div id="property33" class="flot-base fbchart"></div>
									</div>
									<p id="propertyNarative33"></p>
									
								</div>
								</div>
								
							</div>
							<!-- //Gender Based Violence Data -->

							<!-- Health -->
							<div class="tab-pane" id="tab4">
								   
								<div class="col-md-5">
									<center><p id="propertyLabel41"></p></center><br>
									<div class="row clearfix">
										<div id="property41" class="flot-base fbchart"></div>
									</div>
									<p id="propertyNarative41"></p>
									
								</div>
								
								<div class="col-md-offset-2 col-md-5">
									<center><p id="propertyLabel42"></p></center><br>
									<div class="row clearfix">
										<div id="property42" class="flot-base fbchart"></div>
									</div>
									<p id="propertyNarative42"></p>
									
								</div>
								
							</div>
							<!-- //Health tab -->

							<!-- Security -->
							
							<div class="tab-pane " id="tab5">
								
								<div class="col-md-4">
									<center><p id="energyLabel51"></p></center><br>
									<div class="row clearfix">
										<div id="energy51" class="flot-base fbchart"></div>
									</div>
									<p id="energyNarative51"></p>
									
								</div>
								
							</div>
							<!-- //Security -->
 
						</div>
						

						</div>
							
						</div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
 
<script type="text/javascript">
    /* Pie chart */
    $("#eduLevelLabel").text("Level of Education");
    $("#eduLevelNarative").html('');
    <?php
    $qLE = "SELECT `employment`, count(`post_id`) as level FROM `mob_form_posts_sdg_gender` group by `employment`";
    $rLE = $cndb->dbQueryFetch($qLE);
    // displayArray($rLE); exit;
    $EUnspecified = $rLE[0]['level'];
    $college = $rLE[1]['level'];
    $none = $rLE[2]['level'];
    $primary = $rLE[3]['level'];
    $secondary = $rLE[4]['level'];
    $university = $rLE[5]['level'];

	?>
	var dta = {"data0" :[{"label": "Unspecified","data": <?php echo $EUnspecified; ?> , "color": "#F7464A"},{"label": "College","data": <?php echo $college; ?>, "color": "#46BFBD"},{"label": "None","data": <?php echo $none; ?>, "color": "#FDB45C"},{"label": "Primary","data": <?php echo $primary; ?>, "color": "#0dafe5"},{"label": "Secondary","data": <?php echo $secondary; ?>, "color": "#949FB1"},{"label": "University","data": <?php echo $university; ?>, "color": "#9400D3"}]};
	         
    var pieData = dta.data0;
    boxPieData(pieData,'#eduLevel');
    
    
    /* Social Tab*/

    /* Monthly Contribution Chart */
    $("#mContribLabel").text("Monthly Contribution Amounts For Group 1s");
    $("#mContribNarative").html('For Respondents who have multiple groups. This Chart shows how the respondents\' first groups of choice and the amount of money they contribute. Most respondents contribute between Ksh. 200 - 500 per month');
    <?php
    //$queryL2 = "SELECT * FROM `mob_form_posts_sdg_gender` where `group_1contribution` = 'Below Ksh 200'";
    $queryL2 = "SELECT COUNT(post_id) as `ngapi`, group_1contribution as `label` FROM mob_form_posts_sdg_gender GROUP BY group_1contribution";
    /*$rL2 = $cndb->dbQuery($queryL2);
    $nrLs = $cndb->recordCount($rL2);*/
    $rL2 = $cndb->dbQueryFetch($queryL2);
    //displayArray($rL2);
    $aboveThao = $rL2[2]['ngapi'];
    $fiveToThao = $rL2[5]['ngapi'];
    $twoToFive = $rL2[4]['ngapi'];
    $below200 = $rL2[3]['ngapi'];
    $notSpecified = $rL2[0]['ngapi']+$rL2[1]['ngapi'];
    ?>

        var dta = {"contrib" :[{"DLabel": "Above Ksh. 1000", "DVal": "<?php echo $aboveThao; ?>"},{"DLabel": "Ksh. 500 - 1000", "DVal": "<?php echo $fiveToThao; ?>"},{"DLabel": "Ksh. 200 - 500", "DVal": "<?php echo $twoToFive; ?>"},{"DLabel": "Below 200", "DVal": "<?php echo $below200; ?>"},{"DLabel": "Not Specified", "DVal": "<?php echo $notSpecified; ?>"}]};  
		
    var barData = dta.contrib;
    BarData(barData,'mContrib');
    /* Bar chart End */ 
    
	/*Average monthly contribution*/
	$("#amContribLabel").text("Average Combined Monthly Contribution from 5 Groups");
    $("#amContribNarative").html('Most of the respondents who contribute to their groups give Ksh. 200 - 500 on average Monthly');
        <?php
    //$queryL2 = "SELECT * FROM `mob_form_posts_sdg_gender` where `group_1contribution` = 'Below Ksh 200'";
    $queryL1 = "SELECT COUNT(post_id) as `ngapi`, group_1contribution as `label` FROM mob_form_posts_sdg_gender GROUP BY group_1contribution";
    $queryL2 = "SELECT COUNT(post_id) as `ngapi`, group_2contribution as `label` FROM mob_form_posts_sdg_gender GROUP BY group_2contribution";
    $queryL3 = "SELECT COUNT(post_id) as `ngapi`, group_3contribution as `label` FROM mob_form_posts_sdg_gender GROUP BY group_3contribution";
    $queryL4 = "SELECT COUNT(post_id) as `ngapi`, group_4contribution as `label` FROM mob_form_posts_sdg_gender GROUP BY group_4contribution";
    $queryL5 = "SELECT COUNT(post_id) as `ngapi`, group_5contribution as `label` FROM mob_form_posts_sdg_gender GROUP BY group_5contribution";
    /*$rL2 = $cndb->dbQuery($queryL2);
    $nrLs = $cndb->recordCount($rL2);*/
    $rL1 = $cndb->dbQueryFetch($queryL1);
    $rL2 = $cndb->dbQueryFetch($queryL2);
    $rL3 = $cndb->dbQueryFetch($queryL3);
    $rL4 = $cndb->dbQueryFetch($queryL4);
    $rL5 = $cndb->dbQueryFetch($queryL5);
    //displayArray($rL2);
    $aboveThao1 = $rL1[2]['ngapi'];
    $fiveToThao1 = $rL1[5]['ngapi'];
    $twoToFive1 = $rL1[4]['ngapi'];
    $below2001 = $rL1[3]['ngapi'];
    $notSpecified1 = $rL1[0]['ngapi']+$rL1[1]['ngapi'];

    $aboveThao2 = $rL2[2]['ngapi'];
    $fiveToThao2 = $rL2[5]['ngapi'];
    $twoToFive2 = $rL2[4]['ngapi'];
    $below2002 = $rL2[3]['ngapi'];
    $notSpecified2 = $rL2[0]['ngapi']+$rL2[1]['ngapi'];

    $aboveThao2 = $rL2[2]['ngapi'];
    $fiveToThao2 = $rL2[5]['ngapi'];
    $twoToFive2 = $rL2[4]['ngapi'];
    $below2002 = $rL2[3]['ngapi'];
    $notSpecified2 = $rL2[0]['ngapi']+$rL2[1]['ngapi'];

    $aboveThao3 = $rL3[2]['ngapi'];
    $fiveToThao3 = $rL3[5]['ngapi'];
    $twoToFive3 = $rL3[4]['ngapi'];
    $below2003 = $rL3[3]['ngapi'];
    $notSpecified3 = $rL3[0]['ngapi']+$rL3[1]['ngapi'];

    $aboveThao4 = $rL4[2]['ngapi'];
    $fiveToThao4 = $rL4[5]['ngapi'];
    $twoToFive4 = $rL4[4]['ngapi'];
    $below2004 = $rL4[3]['ngapi'];
    $notSpecified4 = $rL4[0]['ngapi']+$rL4[1]['ngapi'];

    $aboveThao5 = $rL5[2]['ngapi'];
    $fiveToThao5 = $rL5[5]['ngapi'];
    $twoToFive5 = $rL5[4]['ngapi'];
    $below2005 = $rL5[3]['ngapi'];
    $notSpecified5 = $rL5[0]['ngapi']+$rL5[1]['ngapi'];

    $aboveThao_ = ($aboveThao1+$aboveThao2+$aboveThao3+$aboveThao4+$aboveThao5)/5; 
    $fiveToThao_ = ($fiveToThao1+$fiveToThao2+$fiveToThao3+$fiveToThao4+$fiveToThao5)/5; 
    $twoToFive_ = ($twoToFive1+$twoToFive2+$twoToFive3+$twoToFive4+$twoToFive5)/5;
    $below200_ = ($below2001+$below2002+$below2003+$below2004+$below2005)/5;
    $notSpecified_ = ($notSpecified1+$notSpecified2+$notSpecified3+$notSpecified4+$notSpecified5)/5;

    ?>

        var dta = {"BarD" :[{"DLabel": "Above Ksh. 1000", "DVal": "<?php echo $aboveThao_; ?>"},{"DLabel": "Ksh. 500 - 1000", "DVal": "<?php echo $fiveToThao_; ?>"},{"DLabel": "Ksh. 200 - 500", "DVal": "<?php echo $twoToFive_; ?>"},{"DLabel": "Below 200", "DVal": "<?php echo $below200_; ?>"},{"DLabel": "Not Specified", "DVal": "<?php echo $notSpecified_; ?>"}]};  
		
    var barData = dta.BarD;
    BarData(barData,'amContrib'); 

    /* Bar chart End */ 
    
	/*End of Social Tab*/
	/*Gender Based Violence Charts*/
	
    /* Property Pie chart */
	
	 $("#genPVLabel").text("Physical Violence");
    $("#genPVNarative").html('');
    <?php
    $qPVY = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_physical` = 'yes'";
    $qPVN = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_physical` = 'No'";
    $rPVY = $cndb->dbQuery($qPVY);
    $rPVN = $cndb->dbQuery($qPVN);
    $nPVY = $cndb->recordCount($rPVY);
    $nPVN = $cndb->recordCount($rPVN);
    ?>
        var dta = {"pv" :[{"label": "Experienced Physical Violence","data": <?php echo $nPVY; ?>, "color": "#F7464A"},{"label": "Did not experience violence","data": <?php echo $nPVN; ?>, "color": "#46BFBD"}]};
    var pieData = dta.pv;
    boxPieData(pieData,'#genPV');
	
	
	
    $("#genSVLabel").text("Sexual Violence");
    $("#genSVNarative").html('');
    <?php
	    $qSVY = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_sexual` = 'yes'";
	    $qSVN = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_sexual` = 'No'";
	    $rSVY = $cndb->dbQuery($qSVY);
	    $rSVN = $cndb->dbQuery($qSVN);
	    $nSVY = $cndb->recordCount($rSVY);
	    $nSVN = $cndb->recordCount($rSVN);
    ?>
        var dta = {"sv" :[{"label": "Experienced Sexual Violence","data": <?php echo $nSVY; ?>, "color": "#F7464A"},{"label": "Did not experience violence","data": <?php echo $nSVN; ?>, "color": "#46BFBD"}]};
    var pieData = dta.sv;
    boxPieData(pieData,'#genSV');
    
    
    /* Bar chart */
    $("#genPSVLabel").text("Psychological Violence");
    $("#genPSVNarrative").html('');
    
    <?php
	    $qPsVY = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_psych` = 'yes'";
	    $qPsVN = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_psych` = 'No'";
	    $rPsVY = $cndb->dbQuery($qPsVY);
	    $rPsVN = $cndb->dbQuery($qPsVN);
	    $nPsVY = $cndb->recordCount($rPsVY);
	    $nPsVN = $cndb->recordCount($rPsVN);
    ?>
        var dta = {"pSv" :[{"label": "Experienced Psychological Violence","data": <?php echo $nPsVY; ?>, "color": "#F7464A"},{"label": "Did not experience violence","data": <?php echo $nPsVN; ?>, "color": "#46BFBD"}]}; 

    var pieData = dta.pSv;
    boxPieData(pieData,'#genPSV');


    /* Bar chart End */ 
    /*End of Gender Based Violence*/

	    
      
	
	
    /* Bar chart */
    $("#expenditureLabel62").text("Physical Violence");
    $("#expenditureNarative62").html('');
        var dta = {"pV" :[{"DLabel": "10000 - 20000", "DVal": "40"},{"DLabel": "20000 - 30000", "DVal": "11"},{"DLabel": "30000- 40000", "DVal": "6"},{"DLabel": "5000 - 10000", "DVal": "156"},{"DLabel": "Above 40 000", "DVal": "2"},{"DLabel": "Below 5000", "DVal": "776"}]};  
    var barData = dta.pV;
    BarData(barData,'#expenditure62');
    /* Bar chart End */ 
    
    /* Bar chart */
    <?php /*?>$("#expenditureLabel63").text("Expenditure on School Fees");
    $("#expenditureNarative63").html('');
        var dta = {"BarD" :[{"DLabel": "10000 - 20000", "DVal": "311"},{"DLabel": "20000 - 30000", "DVal": "162"},{"DLabel": "30000- 40000", "DVal": "78"},{"DLabel": "5000 - 10000", "DVal": "473"},{"DLabel": "Above 40 000", "DVal": "147"},{"DLabel": "Below 5000", "DVal": "631"}]};  
    var barData = dta.BarD;
    BarData(barData,'expenditure63');<?php */?>
    /* Bar chart End */ 
    
    /* Bar chart */
    $("#expenditureLabel64").text("Expenditure on Health");
    $("#expenditureNarative64").html('');
       <?php /*?> var dta = {"BarD" :[{"DLabel": "10000 - 20000", "DVal": "96"},{"DLabel": "20000 - 30000", "DVal": "37"},{"DLabel": "30000- 40000", "DVal": "18"},{"DLabel": "5000 - 10000", "DVal": "374"},{"DLabel": "Above 40 000", "DVal": "11"},{"DLabel": "Below 5000", "DVal": "1425"}]};  <?php */?>
		var dta = {"BarD" :[{"DLabel": "Below 5000", "DVal": "70.40"},{"DLabel": "5000 - 10000", "DVal": "18.98"},{"DLabel": "10000 - 20000", "DVal": "5.60"},{"DLabel": "20000 - 30000", "DVal": "2.95"},{"DLabel": "30000- 40000", "DVal": "1.47"},{"DLabel": "Above 40000", "DVal": "0.59"}]};  
    var barData = dta.BarD;
    BarData(barData,'expenditure64');
    /* Bar chart End */ 
    
	
// <!--- functions start --->
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
