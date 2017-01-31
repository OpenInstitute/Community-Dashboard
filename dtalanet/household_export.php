<?php 
//include_once('../inc/conn.inc');
//include_once('../inc/cls.report.excel.php');
//ob_start();
//ini_set("display_errors","off");

//displayArray($_SESSION['sess_lanet_account']);

$sess_role_id 	= $_SESSION['sess_lanet_account']['us_role'];

$raw_row 		 = array('id', 'bread_winner_name', 'bread_winner_role', 'bw_age','bw_id', 'bw_reg_to_vote', 'bw_occupation', 'bw_phone', 'sub_location' ,'plot_number', 'property_livestock', 'property_farming', 'property_farming_other', 'property_house', 'property_sanitation_facility', 'property_source_drinking_water', 'house_facility_electricity', 'house_facility_sanitation', 'security_crime','bw_diseases', 'bw_health_facility', 'bw_health_facility_other', 'health_group_immunization', 'health_group_mosquito_nets', 'energy_power_source', 'energy_cooking_facilities');

$clean_row 		= array('num', 'bread_winner_name', 'Role In The Family','Age','ID Number','Registered Voter','Occupation','Phone Number','Location','Plot Number','Has Livestock?','Does Farming?','Farming Detail','House Type','Sanitation Facility','Source of Drinking Water?','Is Electricity Installed?','Is There Sanitation Facility?','Have There Been Any Crime?','Health Category','Visited Health Facility?','Which Health Facility?','Are Children Immunized?','Are Mosquito Nets Available?','What Is The Power Source','Energy Source For Cooking');

$columns_private 	= array();
$columns_label  	= array();

$colname		= array(1,2,3,5,10,11,12);

if($sess_role_id == 1)  {  
	$colname= array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20); 
} 

$k= 'bread_winner_name';
for($j=0; $j < count($colname); $j++){
	
	$l = $colname[$j];
	$k .= ','. $raw_row[$l];	
	$columns_label[$raw_row[$l]] = $clean_row[$l];
 }


$sq_dta = "SELECT id, $k FROM households WHERE bread_winner_name !='' ORDER BY bread_winner_name ; "; 
$rs_dta = $cndb->dbQueryFetch($sq_dta);
$rs_count = count($rs_dta);

$fullArray = $rs_dta; 
$topArray  = @current($fullArray); 
$contArray = array();

$fields_ignore = array('id');


foreach($topArray as $key => $cp)
{
	if(!in_array($key, $fields_ignore))
	{
		$cleanlabel		= $columns_label[$key];
		$headArray[]	= strtoupper(clean_title($cleanlabel));
	}
}

$cont_row = 0;
foreach($fullArray as $key => $cp)
{
	$cont_col = 0; 
	foreach($cp as $ckey => $value)
	{
		if(!in_array($ckey, $fields_ignore))
		{
			$contArray[$cont_row][$cont_col] = trim(html_entity_decode(stripslashes($value)));
			$cont_col += 1;
		}
	}
	$cont_row += 1;
}

//displayArray($headArray);
//displayArray($contArray);
//exit;

$fn = 'household_database_'.date("Y-m-d-Hs").'_'.$rs_count.'_recs.xls';

//create the instance of the exportexcel format
//$excel_obj=new ExportExcel("$fn");
//setting the values of the headers and data of the excel file 
//$excel_obj->setHeadersAndValues($headArray,$contArray); 
//now generate the excel file with the data and headers set
//$excel_obj->GenerateExcelFile();
//print_r($_SESSION['report_values']);
 ?>