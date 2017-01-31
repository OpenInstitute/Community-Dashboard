<?php
require("../inc/conn.inc"); 

$q = strtolower($_GET["q"]);
if (!$q) return;

$sq_ctypes = "SELECT `bw_id` , `bread_winner_name` FROM `households`; "; 
$rs_ctypes = $cndb->dbQuery($sq_ctypes);
$rs_ctypes_count = $cndb->recordCount($rs_ctypes);
		
if($rs_ctypes_count>=1)
{
	$menu_loop=1;
	while($cn_ctypes  = $cndb->fetchRow($rs_ctypes))
	{
		$codes[] = array(''.$cn_ctypes[0].''	=> 	''.$cn_ctypes[1].'');	
	}
}



foreach ($codes as $val) 
{
	foreach ($val as $key=>$value) 
	{
		if (strpos(strtolower($key), $q) !== false or strpos(strtolower($value), $q) !== false) {
			echo "$key|$value\n";
		}
	}
}

?>