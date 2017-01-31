<?php
require_once("../inc/conn.inc"); 

//require_once("classes/cls.formats.php"); 
//require_once("classes/cls.config.php"); 

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lanet SDG5 Data</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" /> 
<script type="text/javascript" src="scripts/jquery-1.12.3.js"></script>
</head>

<body class="padd20">
<script>var pageOp = 'new';var pageDir = 'dashboard'; var aLoader = '...loading...';</script>

<h1 style="border-bottom:1px solid #ccc;">Lanet SDG5 Data: Submission Details</h1>

<div>&nbsp;</div>

<?php

$id = $_REQUEST['id'];

$sq_qry = "SELECT * FROM `mob_form_posts` WHERE `post_id` = ".quote_smart($id).";";		
$rs_qry = $cndb->dbQueryFetch($sq_qry);	

//displayArray($rs_qry); exit;

$rs_qry_count = count($rs_qry);
		
if($rs_qry_count)
{
	$result    = '';
	
	$form_data    = (array) json_decode($rs_qry[0]['form_detail']);
	//displayArray($form_data); exit;
	foreach($form_data as $k => $v){
		$result .= '<tr>
				<th>'.clean_title($k).'</th>
				<td>'.$v.'</td>
			</tr>';
	}
	
}

?>
<table class="table">
	<thead>
		<tr>
			<th style="width:250px !important;">Field Label</th>
			<th>Field Data</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $result; ?>
	</tbody>
</table>


<?php include("zscript_vary.php"); ?>
</body>
</html>