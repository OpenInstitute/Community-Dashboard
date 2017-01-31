<?php
ini_set("display_errors", "off");


if(isset($_REQUEST['id']) and is_numeric($_REQUEST['id'])) {$id=$_REQUEST['id'];} else {$id=NULL;}
if(isset($_REQUEST['qst']) and is_numeric($_REQUEST['qst'])) {$qst=$_REQUEST['qst'];} else {$qst=NULL;}
if(isset($_REQUEST['pt']) and is_numeric($_REQUEST['pt'])) {$pt=$_REQUEST['pt'];} else {$pt=NULL;}
if(isset($_REQUEST['mst']) and is_numeric($_REQUEST['mst'])) {$mstone=$_REQUEST['mst'];} else {$mstone=NULL;}
if(isset($_REQUEST['d'])) {$dir=$_REQUEST['d'];} else {$dir=NULL;}
if(isset($_REQUEST['call'])) {$call=$_REQUEST['call'];} else {$call=NULL;}
if(isset($_REQUEST['fcall'])) {$fcall=$_REQUEST['fcall'];} else {$fcall= NULL;}
if(isset($_REQUEST['tab'])) {$tab=$_REQUEST['tab'];} else {$tab= 'dashboard';} if(!$dir) { $dir = $tab; }
if(isset($_REQUEST['ureg'])) {$ureg = $_GET['ureg'];} else { $ureg= NULL;}
if(isset($_REQUEST['uac'])) {$uac = $_GET['uac'];} else { $uac= NULL;}
if(isset($_REQUEST['op'])) { $op=$_REQUEST['op']; } else { $op=NULL; }
	
//include('inc_pageload_hd.php');
require_once('cls.formats.php');
require_once('cls.config.php');	
require_once('cls.sessions.php');	
//require_once('cls.defines.php');
require_once('cls.data.sr.php'); 
require_once('cls.select.php');
require_once('cls.displays.php');
require_once('cls.post.php');



$msge_array  = array(
		//199  => "Your session has expired! Login to proceed.",
		3 => "Your password was reset. Check your email for the new password.",
		1  => "Thank you. Feedback Posted Successfully",
		2  => "<h1>Mailing List Subscription</h1><h3>Details Posted Successfully</h3><p>Thank you for taking the time to provide us with your details.</p><p>You are now subscribed and will be hearing from us soon.</p>",
		7  => "Update successfull.",
		8  => "Your Online Application was received. We will contact you through details provided.",
		
		/* account alerts */
		//101 => "Welcome. ",
		106 => "Account Verified. Login using your credentials below. ",		
		100 => "Error. Please enter a valid email.",				
		114 => "Error. Please confirm your login details.",
		115 => "Error. Password NOT changed. Enter valid Current Password.",
		116 => "Error. Passwords Dont Match.",		
		117 => "Error. Account Registration NOT Successfull. Try again or contact the Administrator.",
		
		20 => "Error. Account with specified Email exists!",
		21 => "Error. Account does NOT exist or is not verified.",		
		22 => "Account Sign Up: Check email for confirmation details. <strong>If you dont see the email check in your SPAM folder</strong>.",
		23 => "Log in below to proceed.",
		24 => "Message sent.",
		25 => "Your submission upload was successfull.",
		26 => "Reset Password: Check your email for a verification link. <strong>If you dont see the email check in your SPAM folder</strong>.",
		27 => "Success: New password saved. Login using your credentials below.",
		
		
		// APPLICATION FORMS	
		32 => "Account Registration: Check your email for confirmation link.",
		33 => "Listing Request: <br>Check your email for confirmation link.",
		34 => "Advert Post: <br>Check your email for confirmation link.",
		35 => "Message Pending.",
		36 => "Message Pending.",
		
		// USER POSTS	
		201 => "Your comments have been submitted.<br>Posted comments will be published once approved.",
		202 => "Check your email for account verification link.",
		203 => "Account Verified.<br>Awaiting approval from the administrator.",
		205 => "Account Verified.",
		
	
		// PETITION ALERTS
		'has_voted' => "Petition locked. You cannot submit vote or post resolution.",
		223 => "Invalid command. The requested item was not found on this server.",
		
		251 => "Meeting for this date already exists for this Committee!",
		
		// ADMIN NOTIFICATIONS	
		241 => "Request Processed.",
		242 => "Action processed. Petition updated!",		
		401 => "The requested URL was not found on this server.",
		
		);
		

$adSysTabs = array();
$adSysTabs['courts'] 		  = array('tbn' => 'pom_courts', 'tbk' => 'court_id');
$adSysTabs['status'] 		  = array('tbn' => 'pom_status', 'tbk' => 'status_id');
$adSysTabs['prisons'] 		 = array('tbn' => 'pom_prisons', 'tbk' => 'prison_id');
$adSysTabs['counties'] 		= array('tbn' => 'pom_counties', 'tbk' => 'region_id');
$adSysTabs['hearings'] 		= array('tbn' => 'pom_hearings', 'tbk' => 'hearing_id');
$adSysTabs['milestones'] 	  = array('tbn' => 'pom_milestones', 'tbk' => 'milestone_id');
$adSysTabs['members'] 	     = array('tbn' => 'pom_reg_accounts', 'tbk' => 'account_id');	
$adSysTabs['profile'] 	     = array('tbn' => 'pom_reg_accounts', 'tbk' => 'account_id');
$adSysTabs['levels'] 	      = array('tbn' => 'pom_reg_levels', 'tbk' => 'level_id');


	
$adSecureQuestions = array();
$adSecureQuestions['mother_maiden_name'] 		  = 'What is your mothers maiden name?';
$adSecureQuestions['father_middle_name'] 		 = 'What is your fathers middle name?';
$adSecureQuestions['city_born'] 		  = 'What city were you born in?';
$adSecureQuestions['first_school'] 		 = 'What was the name of your first school?';
$adSecureQuestions['first_pet_name'] 		 = 'What was the name of your first pet?';
	

$arrPetitionNature = array(
	'free_pardon' => 'Free or conditional pardon',
	'postponing' => 'Postponing the carrying out of a punishment for a period of time or indefinite period',
	'substituting' => 'Substituting a less severe form of punishment',
	'remitting' => 'Remitting all or part of punishment'
);

$arrPetitionVote = array('0'=>'Pending','1'=>'Approved','2'=>'Denied');
$arrPetitionVoteShort = array('0'=>'-','1'=>'Yes','2'=>'No');


$uploadMime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf';



if($us_level_id <> 1 and $us_level_id <> 3){ $my='My'; } else { $my=''; } 




$m2_data=new displays;
$m2_data->addir = $dir; 

$ddSelect = new drop_downs;






/***********************************************************************
	* New Account Auto Validator
************************************************************************/
$reg_ac = '';
if(isset($_REQUEST['ac']))
{
	$reg_ac	= trim(htmlentities(addslashes($_REQUEST['ac'])));
	$reg_mod   = strtolower(substr($reg_ac,0,3));
	
	//RST - Password Reset
	//ADV - Advert Post
	//SST - Share Stories
	//SGN = Account Signup
	
	if($reg_mod == 'sgn')
	{
		$clsVerify = new clsVerify;
		$result 	= $clsVerify->verifySignupAccount($reg_ac);
		if($result['result'] === 1) { 
			unset($_SESSION['sess_pom_member']);  unset($_SESSION['sess_pom_pet']); 
			$redirect ="index.php?fc=signin&qst=106&ureg=".uniqid(); 
		  	?><script>location.href = "<?php echo $redirect; ?>"; </script><?php exit;
		}
	}
	
	if($reg_mod == 'rst')
	{
		$dir = 'pass_reset';
	}
}
/***********************************************************************
	* New Account Auto Validator
************************************************************************/




/* ============================================================================== 
/*	@PETITION DISPLAY FUNCTIONS
/* ------------------------------------------------------------------------------ */


function get_uploads($arr, $pt, $parent = 'f'){
	$result = array();
	$arr_docs = @unserialize($arr); 
	if(is_array($arr_docs)) {		
		foreach($arr_docs as $k => $file){
			$link = 'lib.php?pt='.$pt.'&f='.$parent.'&d='.$k;
			if(is_array($file)){
				foreach($file as $file_key => $file_name){
					//if($file_key == 'doc'){ $file_name = '<a href="'.DISP_FILES.$file_name.'">'.$file_name.'</a>'; }
					
					$result[$k][$file_key] = $file_name;
					$result[$k]['link'] = '<a href="'.$link.'" target="_blank">'.$file_name.'</a>';
				}
			}
			else {
			$result[$k]['doc'] = $file;
			$result[$k]['link'] = '<a href="'.$link.'" target="_blank">'.$file.'</a>';
			}
		}
	}
	return $result;
}


function get_subdata($arr, $sview = 'report'){
	$result = array();
	$arr_item = @unserialize($arr); 
	if($sview !== 'report')
	{
		$result = $arr_item;
	}
	else
	{
		if(is_array($arr_item)) {		
			foreach($arr_item as $col => $data){
				$result[] = '<strong>'.ucwords(clean_title($col)).'</strong>: '.$data.' &nbsp; ';
			}
		}
	}
	return $result;
}


function get_subdataYN($val){
	$result = array();
	$result['y'] = '';
	$result['n'] = '';
	
	if(strtolower($val) == 'yes') { $result['y'] = ' checked '; }
	if(strtolower($val) == 'no')  { $result['n'] = ' checked '; }
	
	return $result;
}



/*-----------------------------------------------------------------------------------*/
/*	ACCESS RIGHTS FOR LOGGED IN USER
/*-----------------------------------------------------------------------------------*/

function get_UserAccess($staff) {
	
	//$u_contacts = '';
	//$this->connect() or trigger_error('SQL', E_USER_ERROR);
	
	$departments = array();
	$groups	  = array();
	
	$sq_data ="SELECT `id_department`, `id_group` FROM `admk_relations_group_dept` WHERE
	 (`id_staff` = ".quote_smart($staff).")  and `id_group` <> '0' or 
	 (`id_staff` = ".quote_smart($staff).")  and `id_department` <> '0' ; ";
	 //echo $sq_data;
	 
	$rs_data = $this->dbQuery($sq_data);	//

	if($this->recordCount($rs_data) >0 )
	{
		while($cn_data = $this->fetchRow($rs_data))
		{
			if($cn_data[0] <> 0) { $departments[$cn_data[0]] = $cn_data[0]; }
			if($cn_data[1] <> 0) { $groups[$cn_data[1]] 	  = $cn_data[1]; }
			
		}
	}
	//displayArray()
	$userAccess = array('depts' => $departments, 'groups' => $groups);
	return $userAccess;
}



$conf_edit_mode = 1;
$cms_bg_color = $GLOBALS['SYS_CONF']['ADM_STYLE_BG'];

$my_redirect = '';
?>
