<?php
/*@session_start();
@session_cache_limiter('private');
$cache_limiter = @session_cache_limiter();

@session_cache_expire(15);
$cache_expire = @session_cache_expire();
require_once('cls.condb.php');*/
define('DB_HOST', 	   $hostname_conn);
define('DB_CHARSET', 	'utf8');
define('DB_NAME', 	   $database_conn);	
define('DB_USER',      $username_conn);
define('DB_PASSWORD',  $password_conn);


class master
{
  	public static $dbconn;
	public $result, $sql, $table_prefix, $tstart, $executedQueries, $queryTime, $dumpSQL, $queryCode;
	
	public static $menuBundle 	 = array();
	
	public static $contBundle 	= array();
	
	public static $listGallery = array();
	public static $listProfiles = array();
	
	public static $listResources	= array();
	public static $listRegions 		 = array();
	public static $listCounties 	    = array();
	
	 
	public function master()
	{
		global $dbhost, $dbuser, $dbpassword, $dbname;
		$this->dbconfig['dbhost'] = DB_HOST; //$dbhost;
		$this->dbconfig['dbname'] = DB_NAME; //$dbname;
		$this->dbconfig['dbuser'] = DB_USER; //$dbuser;
		$this->dbconfig['dbpass'] = DB_PASSWORD; //$dbpassword;
	}
 
	private function destruct__ (){ //unset
		unset ($this);
	}
 
  	public function getMicroTime() {
     list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
  	}

  	private function dbConnect() {
		$tstart = $this->getMicroTime();
		if(!isset(self::$dbconn)) {
			self::$dbconn = mysqli_connect($this->dbconfig['dbhost'], $this->dbconfig['dbuser'], $this->dbconfig['dbpass'], $this->dbconfig['dbname']) or die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
		
		if(self::$dbconn === false) {
			die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
		
		$tend = $this->getMicroTime();
		$totaltime = $tend-$tstart;
		if($this->dumpSQL) {
			$this->queryCode .= sprintf("Database connection was created in %2.4f s", $totaltime)."";
		}
		$this->queryTime = $this->queryTime+$totaltime;
		
		return self::$dbconn;
  	}


  	public function dbQuery($query) {
	  
		if(empty(self::$dbconn)) { $this->dbConnect(); } //echo $query; exit;
		$tstart = $this->getMicroTime();
		
		if(@!$result = mysqli_query(self::$dbconn, $query)) {
		  die("Execution of a query to the database failed. " .mysqli_error(self::$dbconn));
		}
		else {
		  $tend = $this->getMicroTime();
		  $totaltime = $tend-$tstart;
		  $this->queryTime = $this->queryTime+$totaltime;
		  $this->executedQueries = $this->executedQueries+1; //echo count($result);
		  if(count($result) > 0) {
			return $result;
		  } else {
			return false;
		  }
		}
  	}
  
  	public function dbQueryFetchXXX($query) {
	  $rows = array();
	  $rs   = $this->dbQuery($query);
	  if($rs === false) { return false; }
	  //if(mysqli_num_rows($rs))
	  while ($row = mysqli_fetch_assoc($rs)) {
		$row_clean = array_map("clean_output", $row);
	    $rows[] = $row_clean;
	  }
	  return $rows;
  	}
  
  	public function dbQueryFetch($query, $mode='assoc') {
	  $rows = array();
	  $rs   = $this->dbQuery($query);
	  if($rs === false) { return false; }
	  
	  $fetch_call = 'mysqli_fetch_assoc';
	  if($mode<>'assoc') { $fetch_call = 'mysqli_fetch_array'; }
	  
	  while ($row = $fetch_call($rs)) {
		$row_clean = array_map("clean_output", $row);
	    $rows[] = $row_clean;
	  }
	  return $rows;
  	}
	
  	public function dbQueryMulti($query) {
		foreach($query as $seq_post){
			$result = $this->dbQuery($seq_post);
		}
  	}
		
  	public function recordCount($rs) {
    	return mysqli_num_rows($rs);
  	}

  	public function fetchRow($rs, $mode='both') {
		if(($mode=='both') || ($mode == '')) {
		  return mysqli_fetch_array($rs, MYSQLI_BOTH);
		} elseif($mode=='num') {
		  return mysqli_fetch_row($rs);
		} elseif($mode=='assoc') {
		  return mysqli_fetch_assoc($rs);
		}
		else {
		  die("Unknown get type ($mode) specified for fetchRow - must be empty, 'assoc', 'num' or 'both'.");
		}
  	}
  
 	public function affectedRows($rs) {
    	return mysqli_affected_rows(self::$dbconn);
  	}
 
	public function quote_si($value) {
		$connection = $this->dbConnect();
		if (is_array($value)) { $value = serialize($value); }
		$value = "'" . mysqli_real_escape_string($connection, $value) . "'";
		return $value;
	}
	
  	public function insertId($rs='') {
    return mysqli_insert_id(self::$dbconn);
  	}
 
  	public function errorNo() {
		$connection = $this->dbConnect();
		return mysqli_errno($connection);
  	}
  
	public function error() {
		$connection = $this->dbConnect();
		return mysqli_error($connection);
	}
	
  	public function freeResult($resultset) {
    	return mysqli_free_result($resultset);
  	}
 
  	public function serverVersion() {
    	return mysqli_get_server_info(self::$dbconn);
  	}
 
  	public function dbClose() {
		if(self::$dbconn) {
		  mysqli_close(self::$dbconn);
		}
  	}
  
  	public function tableStatus($tbname) {
		$sq = "SHOW TABLE STATUS LIKE ".$this->quote_si($tbname)."; ";
		$rs = current($this->dbQueryFetch($sq));
    	return $rs;
  	}
	
	
    /* MySQLi - Field Type to Text */
  	public static function fieldTypeText($type_id)
	{
		static $types;	
		if (!isset($types))
		{
			$types = array();
			$constants = get_defined_constants(true);
			foreach ($constants['mysqli'] as $c => $n) if (preg_match('/^MYSQLI_TYPE_(.*)/', $c, $m)) $types[$n] = $m[1];
		}
	
		return array_key_exists($type_id, $types)? $types[$type_id] : NULL;
	}
 
 
 	/* MySQLi - Field Flag to Text */
	public static function fieldFlagText($flags_num)
	{
		static $flags;
	
		if (!isset($flags))
		{
			$flags = array();
			$constants = get_defined_constants(true);
			foreach ($constants['mysqli'] as $c => $n) if (preg_match('/MYSQLI_(.*)_FLAG$/', $c, $m)) if (!array_key_exists($n, $flags)) $flags[$n] = $m[1];
		}
	
		$result = array();
		foreach ($flags as $n => $t) if ($flags_num & $n) $result[] = $t;
		return implode(' ', $result);
	}



 
/* end class */

}



/*-------------------------------------------------------------------------------------------------------
	@@CLASS : HITS UPDATER
-------------------------------------------------------------------------------------------------------*/

class hitsLog extends master
{
	
	function formsUserLogs($log_type, $log_type_id, $log_desc='New', $notify=0, $notify_id='', $form_type = 'user')
	{
		$l_desc 	   = $log_desc .' '. clean_title($log_type); 
		$log_by       = $_SESSION['sess_pom_member']['u_id'];
		
		$notify_admin = ($form_type == 'user' and $notify == 1)? 1 : 0;
		$notify_user  = ($form_type == 'admin' and $notify == 1)? 1 : 0;
		
		$action_arr = array(
			"log_type"    => "".$log_type."", 
			"log_type_id" => $log_type_id,
			"log_desc"    => "".$l_desc."",			
			"log_by"      => $log_by,
			"notify_admin"=> $notify_admin,
			"notify_user" => $notify_user,
			"notify_member_id" => $notify_id );
			
		/* ----------------------------------------- */	
		$field_title = array(); $field_value = array();
	
		if(is_array($action_arr)) {
			foreach($action_arr as $col=>$value){	
				$field_title[] = " `$col` "; $field_value[] = $this->quote_si($value);
			}
		}
		/* ----------------------------------------- */
	
	}
	
	
	function hitsAdd($h_tb, $h_id, $h_cnt='')
	{
		if($h_id) 
		{
			$query = "update $h_tb set hits=(hits+1) where id = $h_id ; ";
			$result = @$this->dbQuery($query); 
						
		} 
	}
	
	
	function msgOpened($id_record)
	{
		if($id_record) 
		{
			$query = "update `admk_msg_participants` set `viewed`='1' where `id_record` = '$id_record' ; ";
			$result = $this->dbQuery($query);
		} 
	}
	
	
	function posUpdate($h_tb, $h_id, $h_cnt='')
	{
		$newpos = '';
		
		if($h_cnt == 'pos_add') 
		{ $query = "update $h_tb set seq=(seq+1) where id = $h_id ; "; } 
		elseif($h_cnt == 'pos_minus') 
		{ $query = "update $h_tb set seq=(seq-1) where id = $h_id ; "; } 
			
		$result = @$this->dbQuery($query); 
		
		$queryb    = @$this->dbQuery("select seq from $h_tb where id = $h_id ; ");
		$queryb_rs = $this->fetchRow($queryb);
		$newpos    = $queryb_rs[0];
		
		return $newpos;
	}
	
	
	function togglePublished($h_tb, $h_id, $h_val='')
	{
		$pub_res = $h_val;
		
		if(strtolower($h_val) == 'togg_yes') { $pub = 0; $pub_res = 'no'; }
		if(strtolower($h_val) == 'togg_no')  { $pub = 1; $pub_res = 'yes'; }
		
		if($h_id) 
		{
			$col = 'id';
			//if($h_tb == 'admk_dt_content_posts') { $col = 'id_comment'; }
			
			$timeActionLog = "";
			if($h_tb == 'admk_dt_menu') { $timeActionLog = " , `date_update`= '".time()."' "; }
			
			$query = "update $h_tb set published = $pub $timeActionLog where $col = $h_id ; ";
			$result = @$this->dbQuery($query); 	
				
		} 
		return $pub_res;
	}
}





/*-------------------------------------------------------------------------------------------------------
	@@CLASS : ACCOUNTS / POSTS VERIFIER
========================================================================================================== */

class clsVerify extends master
{
	/* Verify Sign-up Account
	/* ****************************** */
	
	function verifySignupAccount($postCode)
	{
		$resArr = array();
		$resArr['result'] = 0;
		
		$sqfind = "SELECT `account_id`, `username` FROM `admk_reg_account_login` WHERE (`userauth`=".quote_smart($postCode).") ";
		$rsfind = $this->dbQuery($sqfind);
	
		if($this->recordCount($rsfind) == 1)
		{
			$cnfind   = $this->fetchRow($rsfind);
			$rec_id   = $cnfind['account_id'];
			$rec_user = $cnfind['username'];
		
			$sqpost = "update `admk_reg_account_login` set `uservalid` = 1, `userauth` = ".quote_smart($postCode.'__')."   where (`account_id` = ".quote_smart($rec_id).") "; //echo $sqpost; exit;
			if($this->dbQuery($sqpost)) { $resArr['result'] = 1; $resArr['user'] = $rec_user; }
			unset($sqpost);
		}
			
		return $resArr;
	}
	
	
	
}




$cndb = new master();
$cndb->dumpSQL = true; /* boolean */





$adminConfig = array(
	'SITE_ALIAS' 	  => "",
	'SITE_FOLDER' 	  => "",
	'SITE_TITLE_LONG'  => "POMAC",	
	'SITE_TITLE_SHORT' => "POMAC",
	'SITE_DOMAIN_URI'  => "pomac.co.ke",
	'SITE_MAIL_SENDER' => "POMAC",
	'SITE_MAIL_TO_BASIC' => "info@pomac.co.ke",
	'SITE_MAIL_FROM_BASIC' => "noreply@pomac.co.ke",
	'SITE_LOGO' => "image/logo.png",
	'COLOR_BG_SITE' => "#FBF2DF",
	'COLOR_BG_HEADER' => "#FFF",
	'upload_max_filesize' => "5",
	'GALLTHMB_WIDTH' => "250",
	'GALLTHMB_HEIGHT' => "150",
	'GALLIMG_WIDTH' => "1200",
	'GALLIMG_HEIGHT' => "900",
	
	'SOCIAL_ID_FACEBOOK' => "admark",
	'SOCIAL_ID_TWITTER' => "admark",
	'SOCIAL_ID_TWITTER_WIDGET' => "774485859802484736",
	'SOCIAL_ID_YOUTUBE' => "#",
	'SOCIAL_ID_LINKEDIN' => "#",
	'SOCIAL_ID_GOOGLE' => "#",
	
	'_lists_date_format' => "%b %e %Y",
	'_lists_time_format' => "%l:%i %p",
	'MySQLDateFormat' => "%m/%d/%Y",
	'PHPDateFormat' => "n/j/Y",
	'PHPDateTimeFormat' => "m/d/Y, h:i a"
	
	,'ADM_STYLE_BG' => '#00C0CC'
);

if($_SERVER['HTTP_HOST'] == "localhost:8080") { 
	$adminConfig['SITE_ALIAS'] = "/web2";
	$adminConfig['SITE_FOLDER'] = "oi_lanetnew";
}


if($_SERVER['HTTP_HOST'] == "localhost:8080") { 
	$GLOBALS['SOCIAL_CONNECT']  = false; 
	$GLOBALS['NOTIFY_DEBUG']    = '1';
	$GLOBALS['NOTIFY_SUPPLIER'] = false;
	
	define('SITE_FOLDER', $adminConfig['SITE_FOLDER'].'/'  );	
	$domain_url 	 = $_SERVER['HTTP_HOST'].$adminConfig['SITE_ALIAS'].'/'; 	
	$domain_root    = $_SERVER['CONTEXT_DOCUMENT_ROOT'].SITE_FOLDER; //$_SERVER['DOCUMENT_ROOT']
} 
else{
	$GLOBALS['SOCIAL_CONNECT']  = true; 
	$GLOBALS['NOTIFY_DEBUG']    = '';
	$GLOBALS['NOTIFY_SUPPLIER'] = false;
	
	$domain_folder = ($adminConfig['SITE_FOLDER'] <> "") ? $adminConfig['SITE_FOLDER'].'/' : $adminConfig['SITE_FOLDER'];
	define('SITE_FOLDER', '/'.$domain_folder  );	
	$domain_url 	 = $_SERVER['HTTP_HOST']; 	
	$domain_root    = $_SERVER['DOCUMENT_ROOT'].SITE_FOLDER; 
}

$GLOBALS['PAGE_HAS_TABS'] 	 	    = false;
$GLOBALS['CONTENT_HAS_GALL'] 	 	 = false;
$GLOBALS['CONTENT_HAS_TABLE'] 		= false;
$GLOBALS['FORM_HAS_MASK'] 			= false;
$GLOBALS['EXISTS_MAILING_ACCOUNT']   = false;

$GLOBALS['FORM_MULTISELECT'] 		 = false;
$GLOBALS['FORM_MULTISELECT_LABEL']   = "";
$GLOBALS['FORM_JWYSWYG'] 		     = false;
$GLOBALS['CONTENT_SHOW_CALENDAR'] 	= false;

$adm_portal_id = 1; $pdb_prefix = 'admk_';
$GLOBALS['ADM_PT_PREFIX'] 	  = $pdb_prefix;
$GLOBALS['SYS_CONF'] 		   = $adminConfig;



$my_page_head=''; $my_alias_h1=''; $my_alias_h2=''; $cont_alias=''; $showContent='';
		
$ref_path  	= 	$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$ref_path  	= 	substr($ref_path,0,strrpos($ref_path,"/")); 
$ref_page  	= 	substr($_SERVER['REQUEST_URI'],strripos($_SERVER['REQUEST_URI'],"/" )+1);
$ref_ip	  = 	$_SERVER['REMOTE_ADDR'];
$this_page   = 	substr($_SERVER['PHP_SELF'],strripos($_SERVER['PHP_SELF'],"/" )+1);

$ref_qrystr  = "?" . $_SERVER['QUERY_STRING'];				

define('REF_PAGE', $ref_page );
define('REF_QSTR', $ref_qrystr );




$domain_conf['live'] = array();

define('SITE_DOMAIN_LIVE', 	   "http://".$domain_url.SITE_FOLDER );	
define('SITE_PATH',   		  $domain_root);	
//define('THIS_DOMAIN',   		SITE_DOMAIN_LIVE);	


define('SITE_TITLE_LONG', 		$adminConfig['SITE_TITLE_LONG'] ); 
define('SITE_TITLE_SHORT', 	   $adminConfig['SITE_TITLE_SHORT'] );
define('SITE_DOMAIN_URI', 		$adminConfig['SITE_DOMAIN_URI'] ); 
define('SITE_DOMAIN_URI_TWO', 	$adminConfig['SITE_DOMAIN_URI'] ); 
define('DOMAIN_SLOGAN', 	  	  SITE_TITLE_SHORT); 	


define('SITE_MAIL_SENDER', 	   $adminConfig['SITE_MAIL_SENDER'] ); 
define('SITE_MAIL_TO_BASIC', 	 $adminConfig['SITE_MAIL_TO_BASIC'] ); 
define('SITE_MAIL_FROM_BASIC',  $adminConfig['SITE_MAIL_FROM_BASIC'] ); 

define('SITE_LOGO', 			  SITE_DOMAIN_LIVE .$adminConfig['SITE_LOGO']);
define('META_DESC',		      $adminConfig['SITE_TITLE_LONG']); 
define('META_KEYS',		      $adminConfig['SITE_TITLE_LONG']); 


define('GALLTHMB_WIDTH', 		 $adminConfig['GALLTHMB_WIDTH']);	/*250*/
define('GALLTHMB_HEIGHT', 		$adminConfig['GALLTHMB_HEIGHT']);  /*160*/

define('GALLIMG_WIDTH', 		  $adminConfig['GALLIMG_WIDTH']);	/*1200*/
define('GALLIMG_HEIGHT', 		 $adminConfig['GALLIMG_HEIGHT']);	/*768*/



if(isset($_SERVER['HTTP_REFERER']))	{ 
	$ref_refer = str_replace(SITE_DOMAIN_LIVE, "", $_SERVER['HTTP_REFERER']); 
	if($ref_refer == '') { $ref_refer = 'index.php'; }
	$ref_back  = $ref_refer; 
}	else { $ref_back	= '';}

define('PAGE_PREV', "<a href=\"$ref_back\">&laquo;  back </a> ");





define('UPL_IMAGES',		    SITE_PATH ."image/"); 
define('DISP_IMAGES', 		   SITE_DOMAIN_LIVE ."image/");

define('UPL_AVATARS', 	       SITE_PATH ."image/avatars/"); 
define('DISP_AVATARS', 	      SITE_DOMAIN_LIVE ."image/avatars/");

define('UPL_GALLERY', 		   SITE_PATH ."image/gallery/"); 
define('DISP_GALLERY', 		  SITE_DOMAIN_LIVE ."image/gallery/");

define('UPL_FILES', 		     SITE_PATH ."file/");
define('DISP_FILES', 			SITE_DOMAIN_LIVE ."file/");

define('UPL_PRODUCTS', 		 SITE_PATH ."image/products/"); 
define('DISP_PRODUCTS', 		SITE_DOMAIN_LIVE ."image/products/");

define('UPL_PRODUCTS1', 		 SITE_PATH ."image/products1/"); 
define('DISP_PRODUCTS1', 		SITE_DOMAIN_LIVE ."image/products1/");

define('UPL_ADVERT', 		   SITE_PATH ."image/ads/"); 
define('DISP_ADVERT', 		  SITE_DOMAIN_LIVE ."image/ads/");

define('ERR_NO_IMAGE', 		  DISP_IMAGES ."no_image.png");
define('ERR_NO_IMAGE_100', 	  DISP_IMAGES ."no_image_100x100.jpg");

define('CRUMBS_SEP', 	  		" &nbsp; / &nbsp; " );

define('COLOR_GREEN_DARK', 	  "#009538" );
define('COLOR_GREEN_FADE', 	  "#E7E2C5" );


define('CONF_LISTS_DATE',   	$adminConfig['_lists_date_format'] );
define('CONF_LISTS_TIME',   	$adminConfig['_lists_time_format'] );

define('CONF_LINK_DOWNLOAD',   'lib.php' );	//viewer.php
define('CONF_LINK_CART',       'cart/' );


define('SOCIAL_ID_FACEBOOK', 	 $adminConfig['SOCIAL_ID_FACEBOOK'] ); 
define('SOCIAL_ID_TWITTER',  	  $adminConfig['SOCIAL_ID_TWITTER'] ); 
define('SOCIAL_ID_LINKEDIN', 	 $adminConfig['SOCIAL_ID_LINKEDIN'] ); 
define('SOCIAL_ID_GOOGLE',  	   $adminConfig['SOCIAL_ID_GOOGLE'] ); 
define('SOCIAL_ID_YOUTUBE',  	   $adminConfig['SOCIAL_ID_YOUTUBE'] ); 


$sys_gallery_cats = array(
	'type' => '_cont'
	);

$thisSite =  SITE_TITLE_LONG;		
?>
