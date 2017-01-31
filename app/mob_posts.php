<?php
require_once("../inc/conn.inc"); 

//require_once("classes/cls.formats.php"); 
//require_once("classes/cls.config.php"); 



/* ============================================================================== 
/*	SPAM BLOCK! 
/* ------------------------------------------------------------------------------ */
/*if($_SERVER['REQUEST_METHOD'] !== 'POST') { 
echo "<script language='javascript'>location.href=\"index.php?qst=401&token=".$conf_token."\"; </script>"; exit; }

if (isset($_POST['nah_snd'])){$nah_snd=$_POST['nah_snd'];} else {$nah_snd='';}
if(strlen($nah_snd)>0) {echo "<script language='javascript'>location.href=\"index.php\"; </script>"; exit; }*/

/* ============================================================================== */
$us_id = 0;


//$post	 = array_map("filter_data", $_POST);
//$postb 	= array_map("q_si", $post);
//$field_names = array_keys($post);
$msg = 'Failed';
if($_SERVER['REQUEST_METHOD'] == 'POST') { 

$posted = $_POST;
$somecontent = implode(",", $posted) . "\n";

/*$posted = '{"rpt_val":[{"fLbl":"txtCheckupDate","fDta":"11-29-2014 "},{"fLbl":"txtHba","fDta":"hb"},{"fLbl":"txtGlucose","fDta":"bl"},{"fLbl":"txtUrine","fDta":"ur"},{"fLbl":"txtCholesterol","fDta":"ch"},{"fLbl":"txtGfr","fDta":"gf"},{"fLbl":"txtEye","fDta":"dil"},{"fLbl":"txtBlood","fDta":"pre"},{"fLbl":"txtWeight","fDta":"wei"},{"fLbl":"txtHeight","fDta":"hei"}],"rpt_id":15,"rpt_cat":"Diabetes","acc_key":"732210038"}';*/
$postedXX = '{"rpt_form_detail":"{\"employment\":\"\",\"adequate_midwives\":\"\",\"profession\":\"\",\"spending_paid_housegirl\":\"\",\"married\":\"\",\"leadership_position\":\"\",\"family_planning_spouse_support\":\"\",\"spending_female_relative\":\"\",\"age\":\"5\",\"gender\":\"\",\"skilled_delivery_location\":\"\",\"child_death_cause\":\"\",\"leadership_held\":\"\",\"spending_male_relative\":\"\",\"adequate_medicine\":\"\",\"adequate_laboratory\":\"\",\"spending_daughters\":\"\",\"group_contribution\":\"\",\"married_age\":\"\",\"security_suggestion\":\"\",\"hospital_closest\":\"\",\"own_mobile\":\"\",\"gov_deliver_c\":\"c\",\"time_to_hospital\":\"\",\"group_member\":\"\",\"spending_wife\":\"\",\"group_gender\":\"\",\"family_planning_method\":\"\",\"gov_deliver_a\":\"a\",\"women_equality\":\"\",\"own_land\":\"\",\"gov_deliver_b\":\"b\",\"spending_husband\":\"\",\"group_purpose\":\"\",\"sublocation\":\"a\",\"water_access\":\"\",\"breadwinner_gender\":\"\",\"adequate_doctors\":\"\",\"violence_reported\":\"\",\"security_enough\":\"\",\"violence_reported_to_other\":\"\",\"skilled_delivery\":\"All\",\"adequate_beds\":\"\",\"group_name\":\"\",\"violence_report_action_other\":\"\",\"child_death\":\"\",\"spending_sons\":\"\",\"subjected_violence\":\"\",\"adequate_cleanliness\":\"\",\"family_planning\":\"\",\"violence_report_action\":\"\",\"adequate_nurses\":\"\",\"hospital_improvement\":\"\",\"spending_paid_houseboy\":\"\",\"family_planning_method_other\":\"\",\"violence_reported_to\":\"\",\"cluster\":\"a\"}","rpt_source":"722333__ABC12356XYZ","rpt_form_date":"20161016","rpt_form":"data_gaps_a"}';

//$somecontent = implode(",", $posted) . "\n";

$json_a = json_decode($somecontent,true);

$acc_rpt_source	   = $json_a['rpt_source'];
$acc_rpt_form   	    = $json_a['rpt_form'];
$acc_rpt_form_detail = $json_a['rpt_form_detail'];
$acc_rpt_date  	 = $json_a['rpt_form_date']; 
$acc_rpt_duration  	 = $json_a['rpt_duration']; 

$sqpost = " insert into `mob_form_posts` 
	(`form_source`, `form_id`, `form_detail`, `form_date`, `duration`)  values  
	(".quote_smart($acc_rpt_source).", ".quote_smart($acc_rpt_form).", ".quote_smart($acc_rpt_form_detail).", ".quote_smart($acc_rpt_date).", ".quote_smart($acc_rpt_duration)." ); "; 
	
	if($cndb->dbQuery($sqpost)) {	
	$msg = 'Success';
	} 
	//displayArray($json_a);
}
echo $msg;
exit;	

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