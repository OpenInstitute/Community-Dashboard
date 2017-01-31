<?php 
include_once('../inc/conn.inc');
include_once('../inc/cls.report.excel.php');
ob_start();
ini_set("display_errors","off");

$dta = $_REQUEST['dta'];

if($dta == 'gender'){
	include("gender_export.php");
}
elseif($dta == 'household'){
	include("household_export.php");
}

if($dta <> ''){
#### Roshan's very simple code to export data to excel   
#### Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
#### if you have any problem contact me at http://roshanbh.com.np
#### fell free to visit my blog http://php-ajax-guru.blogspot.com

	$excel_obj=new ExportExcel("$fn");
	$excel_obj->setHeadersAndValues($headArray,$contArray); 
	$excel_obj->GenerateExcelFile();
}
 ?>