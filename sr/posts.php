<?php
include_once("classes/conn.inc"); 
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
displayArray($post); //exit;



/* ============================================================================== 
/*	SERVICE REGISTER FOLLOW-UP
/* ------------------------------------------------------------------------------ */	

if($formname=="frm_sr_followup")
{ 
	$status_id = $post['status_id'];
	$register_id = $post['register_id'];
	
	//$sqpost = "INSERT INTO `serviceregister` (`name` , `parent_id` , `location` , `entry_type` , `statement` , `date` , `start` , `post_by`) VALUES (".quote_smart($post['chief']).", ".quote_smart($post['parent_id']).", ".quote_smart($post['location']).",'followup', ".quote_smart($post['statement']).", ".quote_smart($post['date']).",".quote_smart($post['start']).", ".quote_smart($post_by).") ";		
	
	$sqpost[] = "INSERT INTO `sr_followup` (`register_id`, `followup_date`,`followup_time`, `followup_comments`, `assigned_to`, `post_by`) VALUES 
	(".q_si($register_id).", ".q_si($post['follow_date']).", ".q_si($post['follow_time']).", ".q_si($post['followup_comments']).", ".q_si($post['assigned_to']).", ".q_si($post_by)."); ";		
	
	if($status_id <> 1){
		$sqpost[] = "UPDATE `sr_serviceregister` SET `status_id` = ".q_si($status_id)." WHERE `register_id` = ".q_si($register_id)."; ";
	}
	//displayArray($sqpost) ; exit;
	$rspost = $cndb->dbQueryMulti($sqpost);
	
	
	?><script>location.href="srdetail.php?uid=<?php echo $register_id; ?>&qst=7#/search";</script> <?php exit;
}

/* ============================================================================== 
/*	SERVICE REGISTER 
/* ------------------------------------------------------------------------------ */	

if($formname=="frm_serviceregister")
{ 
	if(empty($post['name'])){ $nameErr = "Name Cannot be blank"; }
	
	$status_id = $post['status'];
	
	$sqpost = "INSERT INTO `sr_serviceregister` 
	(`name`, `id_number`, `cell`, `location`, `casetype`, `statement`, `visit_date`, `visit_time`, `status_id`, `post_by`) VALUES 
	(".q_si($post['name']).", ".q_si($post['id_number']).", ".q_si($post['cell']).",".q_si($post['location']).", ".q_si($post['casetype']).", ".q_si($post['statement']).",".q_si($post['visit_date']).", ".q_si($post['visit_time']).", ".q_si($post['status']).", ".q_si($post_by)." ) ";				
	
	//echo $sqpost ; exit;
	$rspost = $cndb->dbQuery($sqpost);
	$rec_id = $cndb->insertId($rspost);	
	
	if($status_id == 1){
		
		$sqfollow = "INSERT INTO `sr_followup` (`register_id`, `followup_date`,`followup_time`, `followup_comments`, `assigned_to`, `post_by`) VALUES 
		(".q_si($rec_id).", ".q_si($post['follow_date']).", ".q_si($post['follow_time']).", ".q_si($post['followup_comments']).", ".q_si($post['assigned_to']).", ".q_si($post_by).") ";				
		//echo $sqpost ; exit;
		$rsfollow = $cndb->dbQuery($sqfollow);
		
	}
	
	?><script>location.href="index.php?qst=7#search";</script> <?php 
	exit;
}

?>