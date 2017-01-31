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
	

<h1 style="border-bottom:1px solid #ccc;">Lanet SDG5 Data: Posts Per Group</h1>

<div>&nbsp;</div>
<?php

$sq_qry = "SELECT
COUNT(form_source) as `num_posts`,
DATE_FORMAT(sync_date, '%Y-%b-%d') as sync_date,
group_1name, sublocation
FROM
mob_form_posts_sdg_gender
WHERE
group_1name <> ''
GROUP BY
DATE_FORMAT(sync_date, '%Y-%b-%d'),
group_1name, sublocation ";	//ORDER BY num_posts DESC 	
$rs_qry = $cndb->dbQuery($sq_qry);	

$rs_qry_count = $cndb->recordCount($rs_qry);
		
	if($rs_qry_count)
	{
		$result    = '';
		$i = 1;
		while($cn_qry_a = $cndb->fetchRow($rs_qry, 'assoc')) {
			$cn_qry 	   = array_map("clean_output", $cn_qry_a); 
			
			$num_posts      = $cn_qry['num_posts']; 
			$sync_date  	= $cn_qry['sync_date'];
			$group_1name      = $cn_qry['group_1name']; //echobr($psource);
			$sublocation        = $cn_qry['sublocation'];
			
			
			$result .= '<tr>
					<td>'.$sync_date.'</td>
					<td>'.$sublocation.'</td>
					<td>'.$group_1name.'</td>
					<td>'.$num_posts.'</td>
				</tr>';
			
			$i += 1;	
		}
		
	}

?>
<table class="table display">
	<thead>
		<tr>
			<th>Date</th>
			<th>Sub Location</th>
			<th>Group Name</th>
			<th># Posts</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $result; ?>
	</tbody>
</table>


<?php include("zscript_vary.php"); ?>
</body>
</html>