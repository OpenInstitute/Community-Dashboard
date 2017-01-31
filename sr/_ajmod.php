<?php require_once("classes/conn.inc"); 


$dir    = @$_REQUEST['fcall'];
$parent_id = @$_REQUEST['p_id'];

$opts = "";
$out = '';



function modHeader($title){
	return '<div id="myModalB" class="modal fade" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">'.$title.'</h4></div><div class="modal-body">';
}

function modFooter(){
	return '</div></div></div></div>';
}
//displayArray($_REQUEST);
//echobr($dir);

if($dir <> '') {
	
	switch($dir)
	{ 
		case "servreg_fu":		
			echo modHeader('Follow Up');
			include("includes/frm_serviceregister_followup.php");
			echo modFooter();
		break;
		
		case "servreg_form":		
			//echo modHeader('Follow Up');
			include("includes/frm_serviceregister_followup.php");
			//echo modFooter();
		break;
		
		
		
		default:		
			echo modHeader('Error');
			echo 'Incomplete request!';
			echo modFooter();
		break;		
	}
	
}
else
{
	echo modHeader('Error');
	echo 'Incomplete request!';
	echo modFooter();
}

	

?>

