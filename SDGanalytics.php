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
<script type="text/javascript">
	function hB(id, yLabel, series, tooltip, cTitle){
    jQuery(document).ready(function($) {
    Highcharts.chart(id,{
            chart: {
                type: 'column'
            },
            title: {
                text: cTitle
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
                    text: yLabel
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: tooltip+': <b>{point.y:1f}</b>'
            },
            series: [{
                name: 'Population',
                data: series,
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
}
</script>
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
						$purpose = array("Basic Household Data", "Household Consumption", "Property & Housing", "Water & Sanitation", "Energy", "Social Protection");

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
						
						
							<div class="tab-pane active" id="tab1">
								
								<div class="col-md-12">
									<!-- @Breadwinner % Data --> 
									<div class="col-md-5">
										<center><p id="bwDataLabel11"></p></center><br>
										<canvas id="bwData11" class="fbchart" style="  padding: 0px; position: relative;"></canvas><br>
										<p id="bwDataNarative11"></p>
										<div id="legend"><ul class="bar-legend"><li><span style="background-color:rgba(220,220,220,0.5)"></span>% of Total</li><li><span style="background-color:rgba(151,187,205,0.5)"></span>Avg. Age</li></ul></div>
									</div> 
								
									
									<!-- @Living Standards -->   
									<div class="col-md-5 col-md-offset-2 ">
										<center><p id="bwDataLabel12"></p></center><br>
										<div class="row clearfix">
											<div id="bwData12"></div>
										</div>
										<p id="bwDataNarative12"></p>
										
									</div>
																
								</div>
								
								<div class="col-md-12"><p>&nbsp;</p></div>
								
								<div class="col-md-12">
									<!-- @Scholarship access -->   
									<div class="col-md-5">
										<center><p id="bwDataLabel13"></p></center><br>
										<div class="row clearfix">
											<div id="bwData13"></div>
										</div>
										<p id="bwDataNarative13"></p>									
									</div>	
									
									<!-- @Scholarship access by bw-gender -->   
									<div class="col-md-offset-2 col-md-5">
										<center><p id="bwDataLabel15"></p></center><br>
										<div class="row clearfix">
											<div id="bwData15"></div>
										</div>
										<p id="bwDataNarative15"></p>									
									</div>								
								</div>
					
					
					
							</div>
							
							
							
							
							<div class="tab-pane " id="tab2">
								
								<div class="col-md-12">
									<!-- @Food -->  
									<div class="col-md-5">
										<center><p id="expenditureLabel61"></p></center><br>
										<div class="row clearfix">
											<div id="expenditure61"></div>
										</div>
										<p id="expenditureNarative61"></p>										
									</div>
									
									<!-- @School Fees -->   
									<div class="col-md-5 col-md-offset-2">
										<center id="SchoolFacilityLabel21"></center>
										<div class="row clearfix">
											<div id="SchoolFacility21"></div>
										</div>
										<p id="SchoolFacilityNarative21"></p>
									</div>
								</div>
								
								
								
								<div class="col-md-12">
									<!-- @Rent/Housing -->  
									<div class="col-md-5">
										<center><p id="expenditureLabel62"></p></center><br>
										<div class="row clearfix">
											<div id="expenditure62"></div>
										</div>
										<p id="expenditureNarative62"></p>									
									</div>
									
									
									<!-- @Medical -->  
									<div class="col-md-5 col-md-offset-2">
										<center><p id="expenditureLabel64"></p></center><br>
										<div class="row clearfix">
											<div id="expenditure64"></div>
										</div>
										<p id="expenditureNarative64"></p>									
									</div>
									
								</div>
								
								
								<div class="col-md-12">
									
									
									
								</div>
								
								
						  </div>
						  
						  <div class="tab-pane " id="tab3">
								
								<div class="col-md-12">
								<div class="col-md-5">
									<center><p id="propertyLabel231"></p></center><br>
									<div class="row clearfix">
										<div id="property231"></div>
									</div>
									<p id="propertyNarative231"></p>
									
								</div>
								
								<!--@ -->   
								<div class="col-md-offset-2 col-md-5">
									<center><p id="propertyLabel31"></p></center><br>
									<div class="row clearfix">
										<div id="property31"></div>
									</div>
									<p id="propertyNarative31"></p>
									
								</div>
								</div>
								
								<p> <br> &nbsp; <br></p>
								<div class="col-md-12">
								<div class="clearfix col-md-5">
									<center><p id="propertyLabel32" ></p></center><br>
									<div class="row clearfix">
										<div id="property32"></div>
									</div>
									<p id="propertyNarative32"></p>
									
								</div>
						 
								<div class="col-md-offset-2  col-md-5">
									<center><p id="propertyLabel33"></p></center><br>
									<div class="row clearfix">
										<div id="property33"></div>
									</div>
									<p id="propertyNarative33"></p>
									
								</div>
								</div>
								
							</div>
							
							
							
							<div class="tab-pane" id="tab4">
								   
								<div class="col-md-5">
									<center><p id="propertyLabel41"></p></center><br>
									<div class="row clearfix">
										<div id="property41"></div>
									</div>
									<p id="propertyNarative41"></p>
									
								</div>
								
								<div class="col-md-offset-2 col-md-5">
									<center><p id="propertyLabel42"></p></center><br>
									<div class="row clearfix">
										<div id="property42"></div>
									</div>
									<p id="propertyNarative42"></p>
									
								</div>
								
							</div>
							
							<div class="tab-pane " id="tab5">
								
								<div class="col-md-4">
									<center><p id="energyLabel51"></p></center><br>
									<div class="row clearfix">
										<div id="energy51"></div>
									</div>
									<p id="energyNarative51"></p>
									
								</div>
								
							</div>
							
							<?php /*?><div class="tab-pane " id="tab6">
							</div><?php */?>
							
							<div class="tab-pane" id="tab6">
								
							    <div class="col-md-12">
									<!-- @NHIF 1 -->
									<div class="col-md-5">
										<center><p id="healthLabel71"></p></center><br>
										<div class="row clearfix">
											<div id="health71"></div>
										</div>
										<p id="healthNarative71"></p>									
									</div>
									
									<!-- @NHIF 2 -->
									<div class="col-md-5 col-md-offset-2">
										<center><p id="healthLabel72"></p></center><br>
										<div class="row clearfix">
											<div id="health72"></div>
										</div>
										<p id="healthNarative72"></p>									
									</div>
							   </div>
							   <div><p>&nbsp;  </p></div>
							   
							   
							   <div class="col-md-12">
									<!-- @NHIF 3 -->
									<div class="col-md-5">
										<center><p id="healthLabel73"></p></center><br>
										<div class="row clearfix">
											<div id="health73"></div>
										</div>
										<p id="healthNarative73"></p>									
									</div>
									
									<!-- @NHIF 4 -->
									<div class="col-md-5 col-md-offset-2">
										<center><p id="healthLabel74"></p></center><br>
										<div class="row clearfix">
											<div id="health74"></div>
										</div>
										<p id="healthNarative74"></p>									
									</div>
							   </div>
							   <div><p>&nbsp;  </p></div>
								
								
								<div class="col-md-12">
									<!-- @NHIF 5 -->
									<div class="col-md-5">
										<center><p id="healthLabel75"></p></center><br>
										<div class="row clearfix">
											<div id="health75"></div>
										</div>
										<p id="healthNarative75"></p>									
									</div>
									
							   </div>
							   <div><p>&nbsp;  </p></div>
							   
							   
								
							</div>
							 
						</div>
						

						</div>
							
						</div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
 
<script type="text/javascript">
    /* Radial chart */
    $("#bwDataLabel11").text("Breadwinner % Data");
    $("#bwDataNarative11").html('Close to two-thirds of interviewed households (1,149) indicated the breadwinner of the house is the father (65%) followed by the mother (34%) while few reported the daughter, grandmother and grandfather to be the breadwinner of the household. About 43% of breadwinners were between 36 and 50 years old, followed by those aged 51-64 years.  The youth (22-35 years) and elderly (65+) formed 19% and 12% respondents who reported to be breadwinners. More than half (54%) of interviewed people reported they earn their living from business (28%), which is most small scale business such as vegetable vending;  and farming (26%). Teaching, casual labour and driving and masonry were also reported as primary sources of livelihood opportunity. More than a third of young breadwinners interviewed (35%) reported they are engaged in business and only 15% of them were in farming; whereas close to three-quarters (74%) of respondents aged 65+ earned their living from farming. This is in line with findings in developing countries where young people find farming less attractive    while farming is popular among old people ');
    
      
    <?php /*?>rChartData(["Father","Mother","Grandmother","Grandfather","Son","Brother"],[52.61,35.31,0.51,0.34,0.05,0.04],[41,41,58,45,28,24],'bwData11');<?php */?>
	rChartData(["Father","Mother","Grandmother","Grandfather","Son","Brother"],[65,34.31,0.51,0.34,0.05,0.04],[41,41,58,45,28,24],'bwData11');


    
    /* Pie chart */
    $("#bwDataLabel12").text("");
    $("#bwDataNarative12").html('In choosing the measurement of living standards through household consumption and wealth indices, the World Bank recommends the use of consumption rather than income in developing countries where informal employment is more common since the source of household income is continually changing and home production is wide spread. Residents interviewed (1,149) reported that they spend more on food (32%) followed by medical expenses (29%), school fees (26%) and on housing/rent (13%). Many of the respondents spend less than Ksh 10,000 per month on food, school fees, medical care and rent each.');
	
	/*var dta = {"data0" :[{"label": "Food","data": 32.00, "color": "#F7464A"},{"label": "Medical","data": 29.00, "color": "#46BFBD"},{"label": "Fees","data": 26.00, "color": "#FDB45C"},{"label": "Housing","data": 13.00, "color": "#0dafe5"}]};
	
	
	$("#bwDataLabel12").text("% of Parents in Households");
    $("#bwDataNarative12").html('48% of all households have both parents, whereas more households are run by mothers only (32.88%), as compared to households run by fathers only(18.9%). Female only run homes double the number of households ran by men only.');
    
         
    var pieData = dta.data0;
    boxPieData(pieData,'#bwData12'); */

    var hdta = {"data0" :[ {"name": "Food", "y": 32.0},{"name": "Medical", "y": 29.0},{"name": "Fees","y": 26.0},{"name": "Housing", "y": 13.0}]};
	var hpieData = hdta.data0;
	//hc_eduLevel
	hc_pieChart('bwData12','Living Standards',hpieData);
    
    
    /* Bar chart */
    /*$("#SchoolFacilityLabel21").text("Number of School Facilities");
    $("#SchoolFacilityNarative21").html('42% have toilet facilities while 36% have access to running water in the schools. Overall, more than 50% lack access to toilets, water, permanent structures, libraries or feeding programs in schools. Only 23% have access to libraries in the schools.');    
    
    var dta = {"BarD":[{"DLabel": "Running Water", "DVal": "2905"},{"DLabel": "Toilet", "DVal": "3479"},{"DLabel": "Feeding Program", "DVal": "2165"},{"DLabel": "Library", "DVal": "1822"},{"DLabel": "Permanent", "DVal": "2998"}]}; */ 
	
	//$("#SchoolFacilityLabel21").text("Expenditure on School Fees");
    $("#SchoolFacilityNarative21").html('About 60% of residents report they pay below 10,000 per term or semester on school fees while about 18% reported Ksh 10,000-20,000 on the same.');    
    
    // var dta = {"BarD":[{"DLabel": "Below 5000", "DVal": "33"},{"DLabel": "5000-10000", "DVal": "27"},{"DLabel": "10000-20000", "DVal": "18"},{"DLabel": "20000-30000", "DVal": "9"},{"DLabel": "30000-40000", "DVal": "4"},{"DLabel": "Above 40000", "DVal": "9"}]}; 
	
    // var barData = dta.BarD;
    // BarData(barData,'SchoolFacility21');
    var fees = [["Below 5000", 33],["5000-10000", 27],["10000-20000", 18],["20000-30000", 9],["30000-40000", 4],["Above 40000",9]];
    var yLabel = "Expenditure on School Fees";

    hB('SchoolFacility21', 'Expenditure', fees, 'Expenditure(%)',"Expenditure on School Fees");
    /* Bar chart End */ 
    
	
	
	
    /* Property Pie chart */
	
	 $("#propertyLabel231").text("");
    $("#propertyNarative231").html('Of those in rental housing, 79% paid below Ksh 5,000 while 15% paid between Ksh 5,000 and 10,000 per month. Less than 1% of the residents paid more than Ksh 30,000. Of those temporary housing structure such as mud huts, 90% pay below Ksh 5,000.');
    
    //     var dta = {"data231" :[{"label": "Below 5000","data": 79, "color": "#F7464A"},{"label": "5000-10000","data": 15, "color": "#46BFBD"},{"label": "","data": 6, "color": "#FDB45C"}]};
    // var pieData = dta.data231;
    // boxPieData(pieData,'#property231');
    var hdta = {"data231" :[ {"name": "Below 5000", "y": 79},{"name": "5000-10000", "y": 15},{"name": "Other","y": 6}]};
	var hpieData = hdta.data231;
	//hc_eduLevel
	hc_pieChart('property231','Expenditure on Housing',hpieData);
	
	
	
   // $("#propertyLabel31").text("Type of Households");
    $("#propertyNarative31").html('');
    
    //     var dta = {"data0" :[{"label": "","data": 921, "color": "#F7464A"},{"label": "MAIZE","data": 1, "color": "#46BFBD"},{"label": "Permanent","data": 5645, "color": "#FDB45C"},{"label": "Temporary","data": 2569, "color": "#949FB1"}]};
    // var pieData = dta.data0;
    // boxPieData(pieData,'#property31');
     var hdta = {"data231" :[ {"name": "Semi-Permanent", "y": 921},{"name": "Permanent", "y": 5645},{"name": "Temporary","y": 2569}]};
	var hpieData = hdta.data231;
	//hc_eduLevel
	hc_pieChart('property31','Type of Households',hpieData);
    
    
    /* Bar chart */
    //$("#propertyLabel32").text("Number of Household Farming Activity");
    $("#propertyNarative32").html('A larger percentage of the population do both livestock and crop farming. Of those who practice only one type of farming, majority do crop farming.');
      
    
    
    // var dta = {"BarD" :[{"DLabel": "Farming", "DVal": "912"},{"DLabel": "Livestock", "DVal": "387"},{"DLabel": "Both", "DVal": "2468"}]};  
    // var barData = dta.BarD;
    // BarData(barData,'property32');
    var numH = [['Farming', 912],['Livestock', 387],['Both', 2468]];
    hB('property32', 'Number of Household Farming Activity', numH, 'Total Number', "Number of Household Farming Activity");


    /* Bar chart End */ 
    
    /* Property Ownership Pie chart */
   <?php /*?> $("#propertyLabel33").text("Land Ownership");
    $("#propertyNarative33").html('Majority live in permanent houses while more than 30% live in temporary houses. But very few community members have ownership of the property they live in, with the land mainly belonging to their father or landlords. An average of half the population owns livestock property while 60% of the population use their property for farming purposes. This includes farming bananas, beans, cabbage, carrots with majority of the population(35%) farming maize. Cows are the majority livestock reared in homes, making up 20% of all the livestock owned.');
    
        var dta = {"data0" :[{"label": "Father","data": 920, "color": "#F7464A"},{"label": "Landlord","data": 696, "color": "#46BFBD"},{"label": "Mother","data": 310, "color": "#FDB45C"},{"label": "Grandfather","data": 63, "color": "#949FB1"},{"label": "Grandmother","data": 44, "color": "#4D5360"},{"label": "self","data": 24, "color": "#EEEEEE"}]};
    var pieData = dta.data0;
    boxPieData(pieData,'#property33');
    <?php */?>
	 $("#propertyLabel33").text("");
    $("#propertyNarative33").html('Of those households headed by women engaged in farming, 41% reported the land was owned by the father, grandfather or the landlord indicating the dominance of patriarchal landownership despite women head the household and depend on farming as a primary source of livelihood. Land ownership by age shows marginalisation of the young and elderly. Only 11.84 % of those aged 65 years old and above and 19.76% of the youth aged below 35 reported land ownership. The majority of people, 41.95%, who reported to own landed were 36-50 years of age. Male headed households kept livestock (62%) more than female headed households (only 31%). There was not a significant difference in the type of livestock they keep- these included cattle, chicken, goat and sheep. None of the respondents aged below 35 owned any type of livestock. Those aged between 35 and 49 owned the majority of livestock followed by 50-64 years of age. ');
    
	// var dta = {"data0" :[{"label": "Father","data": 920, "color": "#F7464A"},{"label": "Landlord","data": 696, "color": "#46BFBD"},{"label": "Mother","data": 310, "color": "#FDB45C"},{"label": "Grandfather","data": 63, "color": "#949FB1"},{"label": "Grandmother","data": 44, "color": "#4D5360"},{"label": "self","data": 24, "color": "#EEEEEE"}]};
	// var pieData = dta.data0;
	// boxPieData(pieData,'#property33');
	var hdta = {"poas" :[ {"name": "Father", "y": 920},{"name": "Landlord", "y": 696},{"name": "Mother","y": 310},{"name": "Grandfather","y": 63},{"name": "Grandmother","y": 44},{"name": "Self","y": 24}]};
	var hpieData = hdta.poas;
	//hc_eduLevel
	hc_pieChart('property33','Property ownership by age and sex',hpieData);
    
	
	
    /* Water Pie chart */
    $("#propertyLabel41").text("");
    $("#propertyNarative41").html('Majority, 82%, have access to pit latrines in households while less than 10% have access to W/C toilets. Piped water is the main source of drinking water, with 73% having access to piped water. Rain water and borehole/well are also accessible sources of water, with 25% having access to borehole water and 38% having access to rainwater. Tank and stream were the least accessible sources of water.');
    
    //     var dta = {"data0" :[{"label": "Borehole/well, Community Water","data": 8, "color": "#F7464A"},{"label": "Borehole/well","data": 413, "color": "#46BFBD"},{"label": "Borehole/well, Tap","data": 6, "color": "#FDB45C"},{"label": "Piped water","data": 1589, "color": "#949FB1"},{"label": "Borehole/well, Delivery (by cart, lorries, e.t.c)","data": 13, "color": "#4D5360"},{"label": "Community Water, river water","data": 1, "color": "#EEEEEE"}]};
    // var pieData = dta.data0;
    // boxPieData(pieData,'#property41');
    var hdta = {"sodw" :[ {"name": "Borehole/well, Community Water", "y": 8},{"name": "Borehole/well", "y":413},{"name": "Borehole/well, Tap","y": 6},{"name": "Piped water", "y": 1589},{"name": "Borehole/well, Delivery (by cart, lorries, e.t.c)", "y": 13},{"name": "Community Water, river water", "y": 1}]};
	var hpieData = hdta.sodw;
	//hc_eduLevel
	hc_pieChart('property41','Source of Drinking Water',hpieData);
    
    
    /* Water Pie chart */
    $("#propertyLabel42").text("");
    $("#propertyNarative42").html('On average, community members travel 0-1km to access water. This shows that majority of community members do not have to travel long distances outside their communities to access water. The community also spends a cumulative average of 1 hour daily to collect water.  This also shows that they do not spend too much time sourcing for their water.');
    
    //     var dta = {"data0" :[{"label": "Both","data": 1189, "color": "#F7464A"},{"label": "Permanent","data": 2, "color": "#46BFBD"},{"label": "Pit Latrine","data": 6068, "color": "#FDB45C"},{"label": "W/C Toilet","data": 946, "color": "#949FB1"}]};
    // var pieData = dta.data0;
    // boxPieData(pieData,'#property42');
    var hdta = {"sodw" :[ {"name": "Both", "y": 1189},{"name": "Pit Latrine", "y":6068},{"name": "W/C Toilet","y": 946}]};
	var hpieData = hdta.sodw;
	//hc_eduLevel
	hc_pieChart('property42','Sanitation Facility',hpieData);
    
    
    /* Energy Pie chart */
    $("#energyLabel51").text("");
    $("#energyNarative51").html('Majority, 64%, have access to electricity, with more than 80% using electricity generated by the Kenya Power and Lighting Corporation as compared to other sources of energy such as kerosene, batteries and solar lamps.');
    
    //     var dta = {"data0" :[{"label": "No","data": 626, "color": "#F7464A"},{"label": "Plastic","data": 2, "color": "#46BFBD"},{"label": "Yes","data": 7773, "color": "#FDB45C"}]};
    // var pieData = dta.data0;
    // boxPieData(pieData,'#energy51');
    var hdta = {"a2e" :[ {"name": "No", "y": 626},{"name": "Yes", "y":7773}]};
	var hpieData = hdta.a2e;
	//hc_eduLevel
	hc_pieChart('energy51','Access To Electricity',hpieData);
    
    /* Bar chart */
    //$("#expenditureLabel61").text("Expenditure on Food");
    $("#expenditureNarative61").html('90% of respondents spend less than Ksh10,000 a month on food. Of these, 48% reported to spend below Ksh 5,000 a month on food while those who spend Ksh 5,000-10,000 a month were about 42%. Most of the people (30%) who reported to spend between Ksh 10,0000 and 20,000 on food per month had business as their primary source of  livelihood while a quarter of the people who spend less than Ksh 5,000 had farming as their main occupation.');
        // var dta = {"BarD" :[{"DLabel": "Below 5000", "DVal": "48.44"},{"DLabel": "5000 - 10000", "DVal": "41.64"},{"DLabel": "10000 - 20000", "DVal": "6.70"},{"DLabel": "20000 - 30000", "DVal": "1.43"},{"DLabel": "30000- 40000", "DVal": "0.98"},{"DLabel": "Above 40000", "DVal": "0.80"}]};  
		
    // var barData = dta.BarD;
    // BarData(barData,'expenditure61');

    var series = [["Below 5000",48.44],["5000 - 10000", 41.64],["10000 - 20000",6.70],["20000 - 30000", 1.43],["30000- 40000", 0.98],["Above 40000", 0.80]];
    var yLabel = "Expenditure on Food";
    var tooltip ="";

    hB('expenditure61', yLabel, series, 'Expenditure(%)',"Expenditure on Food");
    /* Bar chart End */ 
    
	
	
    /* Bar chart */
   // $("#expenditureLabel62").text("Expenditure on Rent / Housing");
    $("#expenditureNarative62").html('Of those in rental housing, 79% paid below Ksh 5,000 while 15% paid between Ksh 5,000 and 10,000 per month. Less than 1% of the residents paid more than Ksh 30,000. Of those temporary housing structure such as mud huts, 90% pay below Ksh 5,000.');
    //     var dta = {"BarD" :[{"DLabel": "10000 - 20000", "DVal": "40"},{"DLabel": "20000 - 30000", "DVal": "11"},{"DLabel": "30000- 40000", "DVal": "6"},{"DLabel": "5000 - 10000", "DVal": "156"},{"DLabel": "Above 40 000", "DVal": "2"},{"DLabel": "Below 5000", "DVal": "776"}]};  
    // var barData = dta.BarD;
    // BarData(barData,'expenditure62');
    var series = [["10000 - 20000", 40],["20000 - 30000", 11], ["30000- 40000", 6],["5000 - 10000", 156],["Above 40 000", 2],["Below 5000", 776]];
    var yLabel = "Expenditure on Rent/Housing";
    var tooltip ="";

    hB('expenditure62', yLabel, series, 'Expenditure(%)',"Expenditure on Rent / Housing");

    /* Bar chart End */ 
    
    /* Bar chart */
    <?php /*?>$("#expenditureLabel63").text("Expenditure on School Fees");
    $("#expenditureNarative63").html('');
        var dta = {"BarD" :[{"DLabel": "10000 - 20000", "DVal": "311"},{"DLabel": "20000 - 30000", "DVal": "162"},{"DLabel": "30000- 40000", "DVal": "78"},{"DLabel": "5000 - 10000", "DVal": "473"},{"DLabel": "Above 40 000", "DVal": "147"},{"DLabel": "Below 5000", "DVal": "631"}]};  
    var barData = dta.BarD;
    BarData(barData,'expenditure63');<?php */?>
    /* Bar chart End */ 
    
    /* Bar chart */
   // $("#expenditureLabel64").text("Expenditure on Health");
    $("#expenditureNarative64").html('Close to 90% of respondents reported to spend less than Ksh 10,000 a month, with overwhelming majority 70% reporting to spend less than Ksh 5,000 a month. Close to 80% of respondents who had no access to NHIF still report to spend as little as Ksh 5,000 per month. During the validation meeting held with the community leaders, it was revealed that this could be due to decline in water borne diseases such as typhoid as a result of water filters distributed few months prior to the second round of data collection. It could also be due to the long distance to the nearest hospital that discourages residents from travelling and would rather resort to natural methods of treatment. ');
       <?php /*?> var dta = {"BarD" :[{"DLabel": "10000 - 20000", "DVal": "96"},{"DLabel": "20000 - 30000", "DVal": "37"},{"DLabel": "30000- 40000", "DVal": "18"},{"DLabel": "5000 - 10000", "DVal": "374"},{"DLabel": "Above 40 000", "DVal": "11"},{"DLabel": "Below 5000", "DVal": "1425"}]};  <?php */?>
		var health = [["10000 - 20000", 96],["20000 - 30000",37],["30000- 40000",18],["5000 - 10000",374],["Above 40 000",11],["Below 5000",1425]];
    	var yLabel = "Expenditure on Health";

    	hB('expenditure64', yLabel, health, 'Expenditure',"Expenditure on Health");
    /* Bar chart End */ 
    
    /* NHIF 1 */
    $("#healthLabel71").text("");
    $("#healthNarative71").html('Majority live in permanent houses while more than 30% live in temporary houses. But very few community members have ownersMajority of community members do not have access to NHIF(The National Hospital Insurance Fund)');
    
    //     var dta = {"data0" :[{"label": "No","data": 1512, "color": "#F7464A"},{"label": "Yes","data": 643, "color": "#46BFBD"}]};
    // var pieData = dta.data0;
    // boxPieData(pieData,'#health71');
      var hdta = {"nhif" :[ {"name": "No", "y": 1512},{"name": "Yes", "y":643}]};
	var hpieData = hdta.nhif;
	//hc_eduLevel
	hc_pieChart('health71','NHIF Access',hpieData);
    
	
	
    /* NHIF 2 */
    //$("#healthLabel72").text("NHIF Access By Gender");
    $("#healthNarative72").html('Of those that had access to NHIF, more than 59% were men');
    //     var dta = {"BarD" :[{"DLabel": "Female", "DVal": "31.65"},{"DLabel": "Male", "DVal": "59.87"},{"DLabel": "Undefined", "DVal": "8.48"}]};  
    // var barData = dta.BarD;
    // BarData(barData,'health72');
    var health = [["Female",31.65],["Male",59.87],["Undefined",8.48]];
    var yLabel = "NHIF Access By Gender";

    hB('health72', yLabel, health, 'Percentage(%)',"NHIF Access By Gender");
	
	
	
	 /* NHIF 3 */
   // $("#healthLabel73").text("NHIF Access By Occupation");
    $("#healthNarative73").html('More than half of those that had access to NHIF were in business (23.6%), farming (15.0%), and teaching (14.7%)');
   //      var dta = {"BarD" :[
			// {"DLabel": "Business Person", "DVal": "23.62"},
			// {"DLabel": "Farmer", "DVal": "14.96"},
			// {"DLabel": "Teacher", "DVal": "14.70"},
			// {"DLabel": "Driver", "DVal": "5.25"},
			// {"DLabel": "Civil Servant", "DVal": "3.67"},
			// {"DLabel": "KDF Soldier", "DVal": "2.89"},
			// {"DLabel": "Retired", "DVal": "2.10"},
			// {"DLabel": "Other", "DVal": "32.81"}

			// ]};  
   //  var barData = dta.BarD;
   //  BarData(barData,'health73');
   	var occ = [["Business Person", 23.62],["Farmer", 14.96],["Teacher", 14.70],["Driver", 5.25],["Civil Servant", 3.67],["KDF Soldier", 2.89],["Retired", 2.10],["Other", 32.81]];
    var yLabel = "NHIF Access By Occupation";

    hB('health73', yLabel, occ, 'Percentage(%)',"NHIF Access By Occupation");
	
	
	
	 /* NHIF 4 */
    //$("#healthLabel74").text("NHIF Access By Disabled Breadwinners");
    $("#healthNarative74").html('Only about 38% of those who reported disability had access to the state health insurance.');
   //      var dta = {"BarD" :[
			// {"DLabel": "Yes", "DVal": "37.50"},
			// {"DLabel": "No", "DVal": "50.00"},
			// {"DLabel": "Undefined", "DVal": "12.50"}]}; 
   //  var barData = dta.BarD;
   //  BarData(barData,'health74');
	var dbw = [["Yes", 37.50],["No", 50.00],["Undefined", 12.50]];
    var yLabel = "NHIF Access By Disabled Breadwinners";

    hB('health74', yLabel, dbw, 'Percentage(%)',"NHIF Access By Disabled Breadwinners");
	
	
	/* NHIF 5 */
    $("#healthLabel75").text("");
    $("#healthNarative75").html('The elderly and young have the least access to NHIF as compared to those between 36 and 64 years.');
    
   //      var dta = {"data0" :[
			// {"name": "22-35","y": 14.44},{"name": "36-50","y": 43.31},{"name": "51-64","y": 27.0},{"name": "65+","y": 11.29}
			// 
			// ]};
   //  var pieData = dta.data0;
   //  boxPieData(pieData,'#health75');
   var hdta = {"nbA" :[ {"name": "22-35","y": 14.44},{"name": "36-50","y": 43.31},{"name": "51-64","y": 27.0},{"name": "65+","y": 11.29}]};
	var hpieData = hdta.nbA;
	//hc_eduLevel
	hc_pieChart('health75','NHIF Access By Age',hpieData);

	
	
	
	/* Scholarship 1 */
    $("#bwDataLabel13").text("");
    $("#bwDataNarative13").html('Kenyan students from poor families in secondary and tertiary schools benefit from the Constituency  Development Fund (CDF). Of the interviewed 1,149 respondents, 8.3% had access to scholarships, of which close to 93% benefit from CDF while the rest from school bursary provision. The majority of children who benefit from this scholarship kitty come from a household whose livelihood depends on business (31%), followed by farming (28%), casual labour (7%), church service/pastor (4%) and teaching (3.2%). 42% of the children who benefited from scholarship came from female headed households. ');
    
   //      var dta = {"data0" :[
			// {"label": "CDF","data": 7.66},
			// {"label": "School Bursary","data": 0.61},
			// {"label": "None","data": 91.73}
			// ]};
   //  var pieData = dta.data0;
   //  boxPieData(pieData,'#bwData13');
	var hdta = {"sA" :[ {"name": "CDF", "y": 7.66},{"name": "School Bursary", "y": 0.61},{"name": "None","y": 91.73},{"name": "Housing", "y": 13.0}]};
	var hpieData = hdta.sA;
	//hc_eduLevel
	hc_pieChart('bwData13','Scholarship Access',hpieData);
	
	
	
    /* Bar chart End */ 
<!--- functions start --->
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
