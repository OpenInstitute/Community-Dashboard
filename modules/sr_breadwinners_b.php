<?php
require("../inc/conn.inc"); 

$q = strtolower($_GET["q"]);
if (!$q) return;

$sq_ctypes = "SELECT `bw_id` , `bread_winner_name`, `bw_phone` FROM `households`  WHERE CONVERT(CONCAT(`bw_id` , `bread_winner_name`, `bw_phone`) USING latin1) like '%".$q."%' ; "; 

$rs_ctypes = $cndb->dbQueryFetch($sq_ctypes,''); 
echo json_encode($rs_ctypes); 

/*$rs_ctypes = $cndb->dbQuery($sq_ctypes);
$rs_ctypes_count = $cndb->recordCount($rs_ctypes);
		
if($rs_ctypes_count>=1)
{
	$menu_loop=1;
	while($cn_ctypes  = $cndb->fetchRow($rs_ctypes))
	{
		$codes[] = array(''.$cn_ctypes[0].'', ''.$cn_ctypes[1].'', ''.$cn_ctypes[2].'');
	}
}
echo json_encode($codes); */

?>