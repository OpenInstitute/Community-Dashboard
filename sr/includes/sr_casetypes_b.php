<?php
require("../classes/conn.inc"); 

$q = strtolower($_GET["q"]);
if (!$q) return;
/*
$sq_ctypes = "SELECT `casetype` FROM `serviceregister` WHERE (`casetype` like '%".$q."%') GROUP BY `casetype`;"; 
$rs_ctypes = $cndb->dbQueryFetch($sq_ctypes,''); 
echo json_encode($rs_ctypes); 
*/

$sq_ctypes = "SELECT `casetype` FROM `serviceregister` WHERE (`casetype` <> '') GROUP BY `casetype`;"; 
$rs_ctypes = $cndb->dbQuery($sq_ctypes);
$rs_ctypes_count = $cndb->recordCount($rs_ctypes);
		
if($rs_ctypes_count>=1)
{
	$menu_loop=1;
	while($cn_ctypes  = $cndb->fetchRow($rs_ctypes))
	{
		$codes[] = array(''.$cn_ctypes[0].''	=> 	''.$cn_ctypes[0].'');	
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