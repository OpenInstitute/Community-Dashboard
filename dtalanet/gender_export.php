<?php 
/*include_once('../inc/conn.inc');
include_once('../inc/cls.report.excel.php');
ob_start();
ini_set("display_errors","off");*/


$sq_dta = "SELECT `mob_form_posts_sdg_gender`.*, `mob_form_posts_sdg_subcats`.* FROM `mob_form_posts_sdg_gender` INNER JOIN `mob_form_posts_sdg_subcats` ON  `mob_form_posts_sdg_gender`.`post_id` = `mob_form_posts_sdg_subcats`.`post_id`";
$rs_dta = $cndb->dbQueryFetch($sq_dta);
$rs_count = count($rs_dta);

$fullArray = $rs_dta; 
$topArray  = @current($fullArray); 
$contArray = array();

$fields_ignore = array('form_source','form_id');


foreach($topArray as $key => $cp)
{
	if(!in_array($key, $fields_ignore))
	{
		$key = ($key == 'employment') ? 'education_level' : $key;
		$headArray[] = strtoupper(clean_title($key));
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

$fn = 'gender_database_'.date("Y-m-d-Hs").'_'.$rs_count.'_recs.xls';

//create the instance of the exportexcel format
//$excel_obj=new ExportExcel("$fn");
//setting the values of the headers and data of the excel file 
//$excel_obj->setHeadersAndValues($headArray,$contArray); 
//now generate the excel file with the data and headers set
//$excel_obj->GenerateExcelFile();
//print_r($_SESSION['report_values']);
 ?>