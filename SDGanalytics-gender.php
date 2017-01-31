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
<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>-->

<style type="text/css">
    .user-profile img{width: 28px !important;}
    .padded{ padding: 10px 0; }
    .top{ margin-top: 5px; }
    .aligntxt {
    	font-weight: 400;
    	text-align: left;
    	font-size: 16px;
	}
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
						$purpose = array("Education", "Profession", "Social", "Gender Based Violence", "Health", "Security");

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
						
						<!-- Education Tab Data -->
							<div class="tab-pane active" id="tab1">
								
								<div class="top col-md-12">
									<!--<div class="col-md-5">
										<center><p class="aligntxt" id="eduLevelLabel"></p></center><br>
										<div class="row clearfix">
											<div id="eduLevel" class="flot-base fbchart"></div>
										</div>
										<p id="eduLevelNarative"></p>
									</div>--> 
								
									
									  
									<div class="col-md-5">
										<div class="row clearfix">
											<div id="hc_eduLevel"></div>
											<p id="hc_eduLevelNarative"></p>
										</div>									
									</div>
																
								</div>
								
								<div class="top col-md-12"><p>&nbsp;</p></div>
								
								<div class="top col-md-12">
									<!-- @Scholarship access -->   
									<div class="col-md-5">
										<center><p class="aligntxt" id="bwDataLabel13"></p></center><br>
										<div class="row clearfix">
											<div id="bwData13" class="flot-base fbchart"></div>
										</div>
										<p id="bwDataNarative13"></p>									
									</div>	
									
									<!-- @Scholarship access by bw-gender -->   
									<div class="col-md-offset-2 col-md-5">
										<center><p class="aligntxt" id="bwDataLabel15"></p></center><br>
										<div class="row clearfix">
											<div id="bwData15" class="flot-base fbchart"></div>
										</div>
										<p id="bwDataNarative15"></p>									
									</div>								
								</div>
					
					
					
							</div>
							<!-- //Employment Data -->

							<!-- Profession Tab Data -->
							<div class="tab-pane" id="tab2">
								
								<div class="top col-md-12">
									<div class="col-md-5">
										<center><p class="aligntxt" id="proLabel"></p></center><br>
										<div class="row clearfix">
											<div id="pro" class="flot-base fbschart"></div>
										</div>
										<p id="proNarative"></p>
									</div> 
								
									
									  
									<div class="col-md-5 col-md-offset-2 ">
										<figure style="width: 400px; height: 300px;" id="example2"></figure>									
									</div>
					
								</div>
								
								<div class="top col-md-12"><p>&nbsp;</p></div>
								
								<div class="top col-md-12">
									<!-- @Scholarship access -->   
									<div class="col-md-5">
										<center><p class="aligntxt" id="bwDataLabel13"></p></center><br>
										<div class="row clearfix">
											<div id="bwData13" class="flot-base fbchart"></div>
										</div>
										<p id="bwDataNarative13"></p>									
									</div>	
									
									<!-- @Scholarship access by bw-gender -->   
									<div class="col-md-offset-2 col-md-5">
										<center><p class="aligntxt" id="bwDataLabel15"></p></center><br>
										<div class="row clearfix">
											<div id="bwData15" class="flot-base fbchart"></div>
										</div>
										<p id="bwDataNarative15"></p>									
									</div>								
								</div>
					
							</div>
							<!-- //Profession Data -->
							
							<!-- Social Data -->
							<div class="tab-pane " id="tab3">
								
								<div class="top col-md-12">
									<!-- Monthly contribution for 1st groups -->  
									<div class="col-md-5">
										<center><p class="aligntxt" id="mContribLabel"></p></center><br>
										<div class="row clearfix">
											<div id="mContrib" class="flot-base fbschart"></div>
										</div>
										<p id="mContribNarative"></p>										
									</div>
									
									<!-- Average monthly contribution -->   
									<div class="col-md-5 col-md-offset-2">
										<center><p class="aligntxt" id="amContribLabel"></p></center>
										<div class="row clearfix">
											<div id="amContrib" class="flot-base fbschart"></div>
										</div>
										<p id="amContribNarative"></p>
									</div>
								</div>
								
								
								
								<div class="top clearfix col-md-12">
									<!-- Held leadership position -->  
									<div class="col-md-5">
										<center><p class="aligntxt" id="lPLabel"></p></center><br>
										<div class="row clearfix">
											<div id="lP"></div>
										</div>
										<p id="lPNarrative"></p>									
									</div>
									
									<!-- Whether there is equality in leadership -->  
									<div class="col-md-5 col-md-offset-2">
										<center><p class="aligntxt" id="equalityLabel"></p></center><br>
										<div class="row clearfix">
											<div id="equality"></div>
										</div>
										<p id="equalityNarative"></p>									
									</div>
									
								</div>
								
								
								<div class="top col-md-12">
									
									
									
								</div>
								
								
						  </div>
						  <!-- // Social Data -->
						  <!-- Gender Based Violence -->
						  <div class="tab-pane " id="tab4">
								
								<div class="top col-md-12">
								<!-- Physical Violence -->
								<div class="col-md-5">
									<center><p class="aligntxt" id="genPVLabel"></p></center><br>
									<div class="row clearfix">
										<div id="genPV"></div>
									</div>
									<p id="genPVNarative"></p>
									
								</div>
								
								<!--Sexual Violence -->   
								<div class="col-md-offset-2 col-md-5">
									<center><p class="aligntxt" id="genSVLabel"></p></center><br>
									<div class="row clearfix">
										<div id="genSV"></div>
									</div>
									<p id="genSVNarative"></p>
									
								</div>
								</div>
								
								<p> <br> &nbsp; <br></p>
								<div class="top clearfix col-md-12">
								<div class="col-md-5">
									<center><p class="aligntxt" id="genPSVLabel"></p></center><br>
									<div class="row clearfix">
										<div id="genPSV"></div>
									</div>
									<p id="genPSVNarrative"></p>
									
								</div>
						 
								<div class="col-md-offset-2  col-md-5">
									<center><p class="aligntxt" id="propertyLabel33"></p></center><br>
									<div class="row clearfix">
										<div id="property33" class="flot-base fbchart"></div>
									</div>
									<p id="propertyNarative33"></p>
									
								</div>
								</div>
								
							</div>
							<!-- //Gender Based Violence Data -->

							<!-- Health -->
							<div class="tab-pane" id="tab5">
								<div class="top col-md-12">  
									<div class="col-md-5">
										<center><p class="aligntxt" id="sdLabel"></p></center><br>
										<div class="row clearfix">
											<div id="sd"></div>
										</div>
										<p id="sdNarrative"></p>
										
									</div>
									
									<div class="col-md-offset-2 col-md-5">
										<center><p class="aligntxt" id="sdlLabel"></p></center><br>
										<div class="row clearfix">
											<div id="sdl"></div>
										</div>
										<p id="sdlNarrative"></p>
										
									</div>
								</div>
								<div class=" top clearfix col-md-12">  
									<div class="col-md-5">
										<center><p class="aligntxt" id="fpynLabel"></p></center><br>
										<div class="row clearfix">
											<div id="fpyn"></div>
										</div>
										<p id="fpynNarative"></p>
										
									</div>
									
									<div class="col-md-offset-2 col-md-5">
										<center><p class="aligntxt" id="fpLabel"></p></center><br>
										<div class="row clearfix">
											<div id="fp"></div>
										</div>
										<p id="fpNarrative"></p>
										
									</div>
								</div>

								
							</div>
							<!-- //Health tab -->

							<!-- Security -->
							
							<div class="tab-pane " id="tab6">
								
								<div class="col-md-5">
									<center><p class="aligntxt" id="secLabel"></p></center><br>
									<div class="row clearfix">
										<div id="sec"></div>
									</div>
									<p id="secNarrative"></p>
									
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
		
	var hdta = {"data0" :[ {"name": "Unspecified", "y": <?php echo $EUnspecified; ?>},{"name": "College", "y": <?php echo $college; ?>},{"name": "None","y": <?php echo $none; ?>},{"name": "Primary", "y": <?php echo $primary; ?>},{"name": "Secondary", "y": <?php echo $secondary; ?>},{"name": "University","y": <?php echo $university; ?>}]};
	var hpieData = hdta.data0;
	//hc_eduLevel
	hc_pieChart('hc_eduLevel','Level of Education',hpieData);
	
	
    /*Professions Tab*/
    //$("#proLabel").text("Top 10 professions");
    $("#proNarative").html('');
    <?php
    $proQuery ="SELECT profession, COUNT(post_id) as numpro FROM `mob_form_posts_sdg_gender` GROUP BY `profession` order by numpro desc LIMIT 10";
    $pR = $cndb->dbQueryFetch($proQuery);

    // displayArray($pR); exit;
    $entriis = array();
    /*foreach($pR as $k=>$arr){
    	$profession = ($arr['profession'] <> '') ? $arr['profession'] : 'None';
    	$entriis[]= '{"DLabel": "'.$profession.'", "DVal": "'.$arr['numpro'].'"}';
    }
    $entriisStr = implode(',', $entriis);
    ?>*/
    foreach($pR as $k=>$arr){
    	$profession = ($arr['profession'] <> '') ? $arr['profession'] : 'None';
    	$entriis[]= '["'.$profession.'",'.$arr['numpro'].']';
    }
    $entriisStr = implode(',', $entriis);
    ?>
    //var entries = ;
    //for(var i = 0; i < 9; i++){
    //	entries += '{"DLabel": "<?php //echo $pR[i]["profession"];?>", "DVal": "<?php //echo $pR[i]["numpro"]; ?>"},';
    //}
    //  var dta = {"pr" :[<?php echo $entriisStr; ?>]};  
		
    // var barData = dta.pr;
    // BarData(barData,'pro');
	$(function () {
	Highcharts.chart('pro', {
	chart: {
	type: 'column'
	},
	title: {
	            text: 'Top 10 professions'
	        },
	xAxis: {
	type: 'category',
	labels: {
	rotation: -45,
	style: {
	fontSize: '13px',
	fontFamily: 'Verdana, sans-serif'
	}
	}
	},
	yAxis: {
	min: 0,
	title: {
	text: 'Number of professionals'
	}
	},
	legend: {
	enabled: false
	},
	tooltip: {
	pointFormat: 'Professionals: <b>{point.y:1f}</b>'
	},
	series: [{
	name: 'Population',
	data: [
	<?php echo $entriisStr; ?>
	],
	dataLabels: {
	enabled: true,
	rotation: -90,
	color: '#FFFFFF',
	align: 'right',
	format: '{point.y:.1f}', // one decimal
	y: 10, // 10 pixels down from the top
	style: {
	fontSize: '13px',
	fontFamily: 'Verdana, sans-serif'
	}
	}
	}],
	exporting: {
	enabled: false
	},
	credits: {
	enabled: false
	}
	});
	});



    /*End of Professions Tab*/
    
    
    /* Social Tab*/

    /* Monthly Contribution Chart */
    //$("#mContribLabel").text("Monthly Contribution Amounts For Group 1s");
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
    $(function () {
    Highcharts.chart('mContrib', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Contribution Amounts For Group 1s'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount of Contribution'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Number of respondents: <b>{point.y:1f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Above 1000', <?php echo $aboveThao; ?>],
                ['Ksh. 500 - 1000', <?php echo $fiveToThao; ?>],
                ['Ksh. 200 - 500', <?php echo $twoToFive; ?>],
                ['Below 200', <?php echo $below200; ?>],
                ['Not Specified', <?php echo $notSpecified; ?>]   
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif',
                    background: 'rgba(255,255,255, 0.2)'
                }
            }
        }],
            exporting: {
            	enabled: false
            },
            credits: {
            	enabled: false
            }
    });
});

    //     var dta = {"contrib" :[{"DLabel": "Above Ksh. 1000", "DVal": "<?php echo $aboveThao; ?>"},{"DLabel": "Ksh. 500 - 1000", "DVal": "<?php echo $fiveToThao; ?>"},{"DLabel": "Ksh. 200 - 500", "DVal": "<?php echo $twoToFive; ?>"},{"DLabel": "Below 200", "DVal": "<?php echo $below200; ?>"},{"DLabel": "Not Specified", "DVal": "<?php echo $notSpecified; ?>"}]};  
		
    // var barData = dta.contrib;
    // BarData(barData,'mContrib');
    /* Bar chart End */ 

	/*Average monthly contribution*/
	//$("#amContribLabel").text("Average Combined Monthly Contribution from 5 Groups");
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

    $(function () {
    Highcharts.chart('amContrib', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Average Combined Monthly Contribution from 5 Groups'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount of Contribution'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Number of respondents: <b>{point.y:1f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Above 1000', <?php echo $aboveThao_; ?>],
                ['Ksh. 500 - 1000', <?php echo $fiveToThao_; ?>],
                ['Ksh. 200 - 500', <?php echo $twoToFive_; ?>],
                ['Below 200', <?php echo $below200_; ?>],
                ['Not Specified', <?php echo $notSpecified_; ?>]   
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }],
            exporting: {
            	enabled: false
            },
            credits: {
            	enabled: false
            }
    });
});

    //     var dta = {"BarD" :[{"DLabel": "Above Ksh. 1000", "DVal": "<?php echo $aboveThao_; ?>"},{"DLabel": "Ksh. 500 - 1000", "DVal": "<?php echo $fiveToThao_; ?>"},{"DLabel": "Ksh. 200 - 500", "DVal": "<?php echo $twoToFive_; ?>"},{"DLabel": "Below 200", "DVal": "<?php echo $below200_; ?>"},{"DLabel": "Not Specified", "DVal": "<?php echo $notSpecified_; ?>"}]};  
		
    // var barData = dta.BarD;
    // BarData(barData,'amContrib'); 

    /* Bar chart End */ 

    /* Bar chart */
     $("#lPLabel").text("");
    $("#lPNarrative").html('');
    <?php
    $lpQ = "SELECT leadership_held as ans, COUNT(post_id) as numlp FROM `mob_form_posts_sdg_gender` WHERE leadership_held !='' GROUP BY leadership_held";
    $lpR = $cndb->dbQueryFetch($lpQ);
    // displayArray($lpR); exit();
    $lpNotAns = $lpR[0]['numlp'];
    $lpYes = $lpR[2]['numlp'];
	$lpNo = $lpR[1]['numlp'];    

	?>
	// var dta = {"lp" :[{"label": "Yes","data": <?php echo $lpYes; ?> , "color": "#F7464A"},{"label": "No","data": <?php echo $lpNo; ?>, "color": "#9400D3"},{"label": "Did not answer","data": <?php echo $lpNotAns; ?>, "color": "#FDB45C"}]};
	         
 //    var pieData = dta.lp;
 //    boxPieData(pieData,'#lP');
 	var hpos = {"lPos" :[{"name": "Yes", "y": <?php echo $lpYes; ?>},{"name": "No", "y": <?php echo $lpNo; ?>},{"name": "Did not Answer","y": <?php echo $lpNotAns; ?>}]};
	var hLpos = hpos.lPos;
	//hc_eduLevel
	hc_pieChart('lP','Held Leadership Position',hLpos);
    
    
    $("#equalityLabel").text("");
    $("#equalityNarative").html('');
       <?php 
       		$weQ = "
SELECT women_equality as ans, COUNT(post_id) as num FROM `mob_form_posts_sdg_gender` WHERE women_equality IS NOT NULL GROUP BY women_equality";
			
			$weR = $cndb->dbQueryFetch($weQ);
			// displayArray($lpR); exit;
			$weYes = $weR[3]['num'];
			$weNo = $weR[1]['num'];
			$weNoOpinion = $weR[2]['num'];
			$weDunno = $weR[0]['num'];

       ?>
		// var dta = {"eq" :[{"label": "yes","data": <?php echo $weYes; ?> , "color": "#F7464A"},{"label": "No","data": <?php echo $weNo; ?>, "color": "#46BFBD"},{"label": "No Opinion","data": <?php echo $weNoOpinion; ?>, "color": "#FDB45C"},{"label": "Don't Know","data": <?php echo $weDunno; ?>, "color": "#9400D3"}]};
	         
  //   var pieData = dta.eq;
  //   boxPieData(pieData,'#equality');
  	var eQ = {"eq" :[{"name": "Yes", "y": <?php echo $weYes; ?>},{"name": "No", "y": <?php echo $weNo; ?>},{"name": "No Opinion","y": <?php echo $weNoOpinion; ?>},{"name": "Don't Know","y": <?php echo $weDunno; ?>}]};
	var eqPos = eQ.eq;
	//hc_eduLevel
	hc_pieChart('equality','Whether women have equal opportunities as men in leadership',eqPos);
    
	/*End of Social Tab*/
	/*Gender Based Violence Charts*/
	
    /* Property Pie chart */
	
	 $("#genPVLabel").text("");
    $("#genPVNarative").html('');
    <?php
    $qPVY = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_physical` = 'yes'";
    $qPVN = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_physical` = 'No'";
    $rPVY = $cndb->dbQuery($qPVY);
    $rPVN = $cndb->dbQuery($qPVN);
    $nPVY = $cndb->recordCount($rPVY);
    $nPVN = $cndb->recordCount($rPVN);
    ?>
    //     var dta = {"pv" :[{"label": "Experienced Physical Violence","data": <?php echo $nPVY; ?>, "color": "#F7464A"},{"label": "Did not experience violence","data": <?php echo $nPVN; ?>, "color": "#46BFBD"}]};
    // var pieData = dta.pv;
    // boxPieData(pieData,'#genPV');
	var hpos = {"pV" :[{"name": "Experienced Physical Violence", "y": <?php echo $nPVY; ?>},{"name": "Did not experience violence", "y": <?php echo $nPVN; ?>}]};
	var hLpos = hpos.pV;
	//hc_eduLevel
	hc_pieChart('genPV','Physical Violence',hLpos);
	
	
    $("#genSVLabel").text("");
    $("#genSVNarative").html('');
    <?php
	    $qSVY = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_sexual` = 'yes'";
	    $qSVN = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_sexual` = 'No'";
	    $rSVY = $cndb->dbQuery($qSVY);
	    $rSVN = $cndb->dbQuery($qSVN);
	    $nSVY = $cndb->recordCount($rSVY);
	    $nSVN = $cndb->recordCount($rSVN);
    ?>
    //     var dta = {"sv" :[{"label": "Experienced Sexual Violence","data": <?php echo $nSVY; ?>, "color": "#F7464A"},{"label": "Did not experience violence","data": <?php echo $nSVN; ?>, "color": "#46BFBD"}]};
    // var pieData = dta.sv;
    // boxPieData(pieData,'#genSV');
    var hpos = {"sV" :[{"name": "Experienced Sexual Violence", "y": <?php echo $nSVY; ?>},{"name": "Did not experience violence", "y": <?php echo $nSVN; ?>}]};
	var hLpos = hpos.sV;
	//hc_eduLevel
	hc_pieChart('genSV','Sexual Violence',hLpos);
    
    
    /* Bar chart */
    $("#genPSVLabel").text("");
    $("#genPSVNarrative").html('');
    
    <?php
	    $qPsVY = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_psych` = 'yes'";
	    $qPsVN = "SELECT * FROM `mob_form_posts_sdg_gender` WHERE `violence_psych` = 'No'";
	    $rPsVY = $cndb->dbQuery($qPsVY);
	    $rPsVN = $cndb->dbQuery($qPsVN);
	    $nPsVY = $cndb->recordCount($rPsVY);
	    $nPsVN = $cndb->recordCount($rPsVN);
    ?>
    //     var dta = {"pSv" :[{"label": "Experienced Psychological Violence","data": <?php echo $nPsVY; ?>, "color": "#F7464A"},{"label": "Did not experience violence","data": <?php echo $nPsVN; ?>, "color": "#46BFBD"}]}; 

    // var pieData = dta.pSv;
    // boxPieData(pieData,'#genPSV');
    var hpos = {"pSv" :[{"name": "Experienced Psychological Violence", "y": <?php echo $nSVY; ?>},{"name": "Did not experience violence", "y": <?php echo $nSVN; ?>}]};
	var hLpos = hpos.pSv;
	//hc_eduLevel
	hc_pieChart('genPSV','Psychological Violence',hLpos);


    /* Bar chart End */ 
    /*End of Gender Based Violence*/

    /* Health Tab*/
    $("#sdLabel").text("");
    $("#sdNarrative").html('');
    <?php
    $sdQ = "SELECT skilled_delivery as sd, COUNT(post_id) as numsd FROM `mob_form_posts_sdg_gender` WHERE skilled_delivery is not null and skilled_delivery !='' GROUP BY skilled_delivery";
    $sdR = $cndb->dbQueryFetch($sdQ);
    // displayArray($lpR); exit();
    $sdAll = $sdR[0]['numsd'];
    $sdNone = $sdR[1]['numsd'];
	$sdSome = $sdR[2]['numsd'];    

	?>
	// var dta = {"sD" :[{"label": "All","data": <?php echo $sdAll; ?> , "color": "#F7464A"},{"label": "None","data": <?php echo $sdNone; ?>, "color": "#9400D3"},{"label": "Some","data": <?php echo $sdSome; ?>, "color": "#FDB45C"}]};
	         
 //    var pieData = dta.sD;
 //    boxPieData(pieData,'#sd');

 	var hpos = {"sD" :[{"name": "All", "y": <?php echo $sdAll; ?>},{"name": "None", "y": <?php echo $sdNone; ?>},{"name": "Some", "y": <?php echo $sdSome; ?>}]};
	var hLpos = hpos.sD;
	//hc_eduLevel
	hc_pieChart('sd','Births delivered by a skilled health personnel',hLpos);

    $("#sdlLabel").text("");
    $("#sdlNarrative").html('');
    <?php
    $sdlQ = "SELECT skilled_delivery_location as sdl, COUNT(post_id) as numsdl FROM `mob_form_posts_sdg_gender` WHERE skilled_delivery_location is not null and skilled_delivery_location !='' GROUP BY skilled_delivery_location";
    $sdlR = $cndb->dbQueryFetch($sdlQ);
    // displayArray($lpR); exit();
    $sdlUnspecified = $sdlR[0]['numsdl'];
    $sdlPrivate = $sdlR[1]['numsdl'];
    $sdlPublic = $sdlR[2]['numsdl'];
    $sdlHome = $sdlR[3]['numsdl'];
        

	?>
	// var dta = {"sDl" :[{"label": "Unspecified","data": <?php echo $sdlUnspecified; ?> , "color": "#F7464A"},{"label": "At a private hospital","data": <?php echo $sdlPrivate; ?>, "color": "#9400D3"},{"label": "At a public hospital","data": <?php echo $sdlPublic; ?>, "color": "#FDB45C"},{"label": "At a home by a midwife","data": <?php echo $sdlHome; ?>, "color": "#DC143C"}]};
	         
 //    var pieData = dta.sDl;
 //    boxPieData(pieData,'#sdl');
 	var hpos = {"sDl" :[{"name": "Unspecified", "y": <?php echo $sdlUnspecified; ?>},{"name": "At a private hospital", "y": <?php echo $sdlPrivate; ?>},{"name": "At a public hospital", "y": <?php echo $sdlPublic; ?>},{"name": "At a home by a midwife", "y": <?php echo $sdlHome; ?>}]};
	var hLpos = hpos.sDl;
	//hc_eduLevel
	hc_pieChart('sdl','Place of Delivery',hLpos);

    $("#fpynLabel").text("");
    $("#fpynNarrative").html('');
    <?php
    $fpynQ = "SELECT family_planning as fpl, COUNT(post_id) as numfpl FROM `mob_form_posts_sdg_gender` WHERE family_planning IS NOT NULL and family_planning !='' GROUP BY family_planning";
    $fpynR = $cndb->dbQueryFetch($fpynQ);
    // displayArray($lpR); exit();
    $fpynNo = $fpynR[0]['numfpl'];
    $fpynNot = $fpynR[1]['numfpl'];
    $fpynYes = $fpynR[2]['numfpl'];
	?>
	// var dta = {"fpyn" :[{"label": "No","data": <?php echo $fpynNo; ?> , "color": "#F7464A"},{"label": "Not Willing to Answer","data": <?php echo $fpynNot; ?>, "color": "#9400D3"},{"label": "Yes","data": <?php echo $fpynYes; ?>, "color": "#FDB45C"}]};
	         
 //    var pieData = dta.fpyn;
 //    boxPieData(pieData,'#fpyn');
 	var hpos = {"fpyn" :[{"name": "No", "y": <?php echo $fpynNo; ?>},{"name": "Not Willing to Answer", "y": <?php echo $fpynNot; ?>},{"name": "Yes", "y": <?php echo $fpynYes; ?>}]};
	var hLpos = hpos.fpyn;
	//hc_eduLevel
	hc_pieChart('fpyn','Use of family planning methods',hLpos);

    // $("#fpLabel").text("Methods of family planning used");
    $("#fpNarative").html('For Respondents who have multiple groups. This Chart shows how the respondents\' first groups of choice and the amount of money they contribute. Most respondents contribute between Ksh. 200 - 500 per month');
    <?php
    //$queryL2 = "SELECT * FROM `mob_form_posts_sdg_gender` where `group_1contribution` = 'Below Ksh 200'";
    $fpQ= "SELECT family_planning_method as fp, COUNT(post_id) as numfp FROM `mob_form_posts_sdg_gender` WHERE family_planning_method IS NOT NULL and family_planning_method !='' GROUP BY family_planning_method";
    /*$rL2 = $cndb->dbQuery($queryL2);
    $nrLs = $cndb->recordCount($rL2);*/
    $fpR = $cndb->dbQueryFetch($fpQ);
    //displayArray($rL2);
    $fpUnspecified = $fpR[0]['numfp'];
    $fpCondom = $fpR[1]['numfp'];
    $fpCycl = $fpR[2]['numfp'];
    $fpPill = $fpR[3]['numfp'];
    $fpIud = $fpR[4]['numfp'];
    $fpOther = $fpR[5]['numfp'];
    $fpPatch = $fpR[6]['numfp'];
    ?>

    $(function () {
    Highcharts.chart('fp', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Methods of family planning used'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount of Contribution'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Number of respondents: <b>{point.y:1f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Did not answer', <?php echo $fpUnspecified; ?>],
                ['Condom', <?php echo $fpCondom; ?>],
                ['Cycle Tracking', <?php echo $fpCycl; ?>],
                ['Daily Pill', <?php echo $fpPill; ?>],
                ['IUD', <?php echo $fpIud; ?>],
                ['Other', <?php echo $fpOther; ?>],
                ['Patch', <?php echo $fpPatch; ?>]   
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }],
            exporting: {
            	enabled: false
            },
            credits: {
            	enabled: false
            }
    });
});

    //     var dta = {"fpl" :[{"DLabel": "Unspecified", "DVal": "<?php echo $fpUnspecified; ?>"},{"DLabel": "Condom", "DVal": "<?php echo $fpCondom; ?>"},{"DLabel": "Cycle Tracking", "DVal": "<?php echo $fpCycl; ?>"},{"DLabel": "Daily Pill", "DVal": "<?php echo $fpPill; ?>"},{"DLabel": "IUD", "DVal": "<?php echo $fpIud; ?>"},{"DLabel": "Other", "DVal": "<?php echo $fpOther; ?>"},{"DLabel": "Patch", "DVal": "<?php echo $fpPatch; ?>"}]};  
		
    // var barData = dta.fpl;
    // BarData(barData,'fp');
    
    /*End of Health Tab*/
	
	/*Security Tab*/
	$("#secLabel").text("");
    $("#secNarrative").html('');
    <?php
    $secQ = "SELECT security_enough as sec, COUNT(post_id) as numsec FROM `mob_form_posts_sdg_gender` WHERE security_enough IS NOT NULL and security_enough !='' GROUP BY security_enough";
    $secR = $cndb->dbQueryFetch($secQ);
    // displayArray($lpR); exit();
    $secUnspecified = $secR[0]['numsec'];
    $secNo = $secR[1]['numsec'];
    $secYes = $secR[2]['numsec'];
	?>
	// var dta = {"sec" :[{"label": "Unspecified","data": <?php echo $secUnspecified; ?> , "color": "#F7464A"},{"label": "No","data": <?php echo $secNo; ?>, "color": "#9400D3"},{"label": "Yes","data": <?php echo $secYes; ?>, "color": "#FDB45C"}]};
	         
 //    var pieData = dta.sec;
 //    boxPieData(pieData,'#sec');
 	var hpos = {"sec" :[{"name": "No Idea", "y": <?php echo $secUnspecified; ?>},{"name": "No", "y": <?php echo $secNo; ?>},{"name": "Yes", "y": <?php echo $secYes; ?>}]};
	var hLpos = hpos.sec;
	//hc_eduLevel
	hc_pieChart('sec','Whether there is enough security in Lanet',hLpos);



	/*End of Security Tab*/
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