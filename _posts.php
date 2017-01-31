<?php
include_once("inc/conn.inc"); 
#require_once("classes/cls.constants.php"); 


/* ============================================================================== 
/*	SPAM BLOCK! 
/* ------------------------------------------------------------------------------ */
if($_SERVER['REQUEST_METHOD'] !== 'POST') { 
echo "<script language='javascript'>location.href=\"index.php?qst=401&token=".$conf_token."\"; </script>"; exit; }

if (isset($_POST['nah_snd'])){$nah_snd=$_POST['nah_snd'];} else {$nah_snd='';}
if(strlen($nah_snd)>0) {echo "<script language='javascript'>location.href=\"index.php\"; </script>"; exit; }

/* ============================================================================== */
$us_id = 0;

if(isset($_SESSION['sess_lanet_account'])){ $us_id = $_SESSION['sess_lanet_account']['us_id']; }

$post	 = array_map("filter_data", $_POST);
$postb 	= array_map("q_si", $post);

$formname    = (isset($post['formname']))  ? $post['formname'] : '';
$formaction  = (isset($post['formaction']))  ? $post['formaction'] : '';
$redirect    = (isset($post['redirect'])) ? $post['redirect'] : 'home.php';
$formtab     = (isset($post['formtab']))  ? $post['formtab'] : '';
$post_by     = (isset($post['post_by'])) ? $post['post_by'] : @$us_id;

$published   = yesNoPost(@$post['published']);
$followup    = yesNoPost(@$post['followup']);

$field_names = array_keys($post);

//displayArray($_SESSION);
//displayArray($post); //exit;



/* ============================================================================== 
/*	SERVICE REGISTER FOLLOW-UP
/* ------------------------------------------------------------------------------ */	

if($formname=="frm_serviceregister_followup")
{ 
	//displayArray($post); //exit;
	
	$sqpost = "INSERT INTO `serviceregister` (`name` , `parent_id` , `location` , `entry_type` , `statement` , `date` , `start` , `post_by`) VALUES (".quote_smart($post['chief']).", ".quote_smart($post['parent_id']).", ".quote_smart($post['location']).",'followup', ".quote_smart($post['statement']).", ".quote_smart($post['date']).",".quote_smart($post['start']).", ".quote_smart($post_by).") ";				
	//echo $sqpost ; exit;
	$result = $cndb->dbQuery($sqpost);
	//$rec_id = $cndb->insertId();		
	
	?><script>location.href="ServiceRegister.php?qst=7#/search";</script> <?php exit;
}

/* ============================================================================== 
/*	SERVICE REGISTER 
/* ------------------------------------------------------------------------------ */	

if($formname=="frm_serviceregister")
{ 
	if(empty($post['name'])){ $nameErr = "Name Cannot be blank"; }
	
	$sqpost = "INSERT INTO `serviceregister` (`name` , `cell` , `location` , `casetype` , `statement` , `date` , `start` , `end` , `post_by`, `followup`) VALUES (".quote_smart($post['name']).", ".quote_smart($post['cell']).", ".quote_smart($post['location']).",".quote_smart($post['casetype']).", ".quote_smart($post['statement']).", ".quote_smart($post['date']).",".quote_smart($post['start']).", ".quote_smart($post['end']).", ".quote_smart($post_by).", ".quote_smart($followup)." ) ";				
		//echo $sqpost ; exit;
	$result = $cndb->dbQuery($sqpost);
	$rec_id = $cndb->insertId($result);	
	
	echo $rec_id;	
	exit;
}

?>