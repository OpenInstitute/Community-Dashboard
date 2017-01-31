<?php
$codes = ''; 
$sq_ctypes = "SELECT `casetype` FROM `serviceregister` WHERE (`casetype` <> '') GROUP BY `casetype`;"; 
$rs_ctypes = $cndb->dbQuery($sq_ctypes);
$rs_ctypes_count = $cndb->recordCount($rs_ctypes);
		
if($rs_ctypes_count>=1){
	while($cn_ctypes  = $cndb->fetchRow($rs_ctypes)) { $codes[] = '"'.clean_output($cn_ctypes[0]).'"';  }
}
//echo json_encode($codes); 
echo 'ac_casetypes = ['.implode(',',$codes).'];';

?>