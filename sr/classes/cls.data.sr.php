<?php

class data_sr extends master
{



/* ============================================================================== 
/*	@ REGISTRY ENTRY
/* ------------------------------------------------------------------------------ */		

	function get_registryItem($id)
	{
		$result = array();
		if($id){
		$sq_qry = "SELECT 
sr_serviceregister.*,
sr_casetype.*,
sr_casestatus.*,
public_login.name as `post_by_name`
	
FROM
	sr_serviceregister 
LEFT JOIN sr_casetype ON sr_serviceregister.casetype = sr_casetype.casetype_id 
left JOIN sr_casestatus ON sr_serviceregister.status_id = sr_casestatus.status_id
LEFT JOIN sr_followup ON sr_serviceregister.register_id = sr_followup.register_id  
LEFT JOIN public_login ON sr_serviceregister.post_by = public_login.id  	
WHERE (`sr_serviceregister`.`register_id`  = ".$this->quote_si($id).");";		
		$result = current($this->dbQueryFetch($sq_qry));	
		
		}
		return $result;
	}

	
	
/* ============================================================================== 
/*	@ REGISTRY ENTRY FOLLOW-UPS
/* ------------------------------------------------------------------------------ */		

	function get_registryFollowups($id)
	{
		$result = array();
		if($id){
		$sq_qry = "SELECT `sr_followup`.*, sublocations.subchief as `name` FROM `sr_followup`
		LEFT JOIN sublocations ON sr_followup.assigned_to = sublocations.id  	
		WHERE `sr_followup`.`published` = 1 and (`sr_followup`.`register_id`  = ".$this->quote_si($id).") 
		ORDER BY `sr_followup`.`followup_id`;";		
		$result = $this->dbQueryFetch($sq_qry);	
		
		}
		return $result;
	}
	

/* ============================================================================== 
/*	@BUILD: PETITION LONG LIST
/* ------------------------------------------------------------------------------ */		

	function get_petitionLongList($category, $status = 12)
	{
		$result = array();
		
		//if($category <> '')
		//{
			
		$sq_qry = "SELECT `pom_petition_applicants`.*, `pom_petition_details`.*, `pom_representatives`.*, `pom_status`.`status` FROM`pom_petition_details` INNER JOIN `pom_petition_applicants` ON (`pom_petition_details`.`petitioner_id` = `pom_petition_applicants`.`petitioner_id`) LEFT JOIN `pom_representatives` ON (`pom_petition_details`.`representative_id` = `pom_representatives`.`representative_id`) LEFT JOIN `pom_status` ON (`pom_petition_details`.`status_id` = `pom_status`.`status_id`) WHERE (`pom_petition_details`.`petition_category`  = ".$this->quote_si($category)." and `pom_petition_details`.`status_id` >= ".$this->quote_si($status).");";		
		//echobr($sq_qry); exit;
		$rs_qry = $this->dbQuery($sq_qry);			
		$rs_count =  $this->recordCount($rs_qry);

		if($rs_count > 0)
		{
			$current_time = time();

 /*Prisoner's No. and Name Age at Conviction (Years) Current Age (Years) Offence(s) Date of Conviction  Sentence Custody Period including remand (Years) Remarks */

			while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$petition_number   	= $cn_qry['petition_number'];
				$prison_no 	  		= $cn_qry['prison_no'];
				$petitioner   		= clean_output($cn_qry['petitioner_fname'].' '.$cn_qry['petitioner_sname'].' '.$cn_qry['petitioner_lname']);
				
				$date_conviction   	= $cn_qry['date_conviction'];
				$date_custody      	= $cn_qry['date_custody'];
				
				$age_conviction    	= $cn_qry['age_conviction'];
				$age_current       	= $age_conviction + (date('Y', $current_time) - date('Y', strtotime($date_conviction)));
				
				$offence   			= $cn_qry['offence_particulars'];
				$sentence   		= $cn_qry['sentence_imposed'];
				$custody_period		= date('Y', $current_time) - date('Y', strtotime($date_custody));
				$remarks   			= strip_tags(clean_output($cn_qry['admissible_comments']));
				
				if($category == 1){
					$result[] = array 
					(
						'petition_number'	=> ''.$petition_number.'',
						'prison_no'    		=> ''.$prison_no.'',
						'petitioner'     	=> ''.$petitioner.'',
						'age_conviction'   	=> ''.$age_conviction.'',
						'age_current'   	=> ''.$age_current.'',
						'offence'     		=> ''.$offence.'',
						'date_conviction'	=> ''.$date_conviction.'',
						'sentence'     		=> ''.$sentence.'',
						'custody_period'	=> ''.$custody_period.'',
						'remarks'     		=> ''.$remarks.''
					);
				}
				elseif($category == 2){
					$result[] = array 
					(
						'petition_number'	=> ''.$petition_number.'',
						'patient_no'    	=> ''.$prison_no.'',
						'petitioner'     	=> ''.$petitioner.'',
						'diagnosis'   		=> ''.$sentence.'',
						'age_current'   	=> ''.$age_current.'',
						'offence'     		=> ''.$offence.'',
						'date_commission'	=> ''.$date_conviction.'',
						'custody_period'	=> ''.$custody_period.'',
						'remarks'     		=> ''.$remarks.''
					);
				}
			}
		}
			
		//}
		return $result;
	}	
	
	

/* ============================================================================== 
/*	@BUILD: COMMITTEE MEMBERS
/* ------------------------------------------------------------------------------ */		

	function get_accountsCommittee()
	{
		$result = array();
		$out = '<option value=""></option>';
		$sq_qry = "SELECT
				`pom_reg_accounts`.`account_id`
				, `pom_reg_accounts`.`account_name`
				, `pom_reg_accounts`.`account_email`
				, `pom_reg_accounts_to_levels`.`level_id`
			FROM
				`pom_reg_accounts`
				INNER JOIN `pom_reg_accounts_to_levels` 
					ON (`pom_reg_accounts`.`account_id` = `pom_reg_accounts_to_levels`.`account_id`)
				INNER JOIN `pom_reg_levels` 
					ON (`pom_reg_accounts_to_levels`.`level_id` = `pom_reg_levels`.`level_id`)
			WHERE (`pom_reg_accounts`.`published` =1
				AND `pom_reg_accounts_to_levels`.`level_id` =3);";		
		$result = $this->dbQueryFetch($sq_qry);	
		foreach($result as $k => $arr){
			$rec_id = $arr['account_id'];
			$rec_title = $arr['account_name'];
			$rec_email = $arr['account_email'];
			$out .=  '<label class="col-md-6 nopadd "><input type="checkbox" name="invite['.$rec_id.']" checked value="'.$rec_email.'" class="require-one" /> '.$rec_title.'</label>';
		}
		return $out;
	}


/* ============================================================================== 
/*	@BUILD: PRISONS / VENUES ARRAY
/* ------------------------------------------------------------------------------ */		

	function get_prisonList($venue_id)
	{
		$result = '';
		$sq_qry = "SELECT `prison_name` FROM `pom_prisons` WHERE (`prison_id` =".q_si($venue_id).") ;";		
		$cn_qry = current($this->dbQueryFetch($sq_qry));		
		return $cn_qry['prison_name'];
	}



/* ============================================================================== 
/*	@BUILD: PRISONS
/* ------------------------------------------------------------------------------ */		

	function get_prisons($crit = '', $select = 1)
	{
		$result = array();
		$out = '<option value=""></option>';
		$sq_qry = "SELECT * FROM `pom_prisons` WHERE (`published` =1) and `prison_prefix` <>'' order by `prison_name`;";		
		$result = $this->dbQueryFetch($sq_qry);	
		foreach($result as $k => $arr){
			$ptitle = $arr['prison_name'];
			$pcode =  $arr['prison_prefix'];
			
			if($pcode == '') { $pcode = substr($ptitle,0,3); }
			
			$isSelected = ($crit == $ptitle) ? " selected " : "";
			
			$out .=  '<option value="'.$ptitle.'" data-id="'.strtoupper($pcode).'" '.$isSelected.'>'.$ptitle.'</option>';
		}
		return $out;
	}

	
	
/* ============================================================================== 
/*	@BUILD: HEARING VENUES
/* ------------------------------------------------------------------------------ */		

	function get_prisonHearing($pt)
	{
		$pris = $_SESSION['sess_pom_pet'][$pt]['prison_held']; //echo $pris; exit;
		$result = array();
		$out = '<option value=""></option>';
		$sq_qry = "SELECT * FROM `pom_prisons` WHERE (`published` =1) and `prison_prefix` = '' or (`published` =1) and `prison_name` = ".q_si($pris)." order by `prison_prefix`;";		
		$result = $this->dbQueryFetch($sq_qry);	
		foreach($result as $k => $arr){
			$pid = $arr['prison_id'];
			$ptitle = $arr['prison_name'];
			$pcode =  $arr['prison_prefix'];
			
			//if($pcode == '') { $pcode = substr($ptitle,0,3); }
			//$isSelected = ($crit == $ptitle) ? " selected " : "";
			
			$out .=  '<option value="'.$pid.'">'.$ptitle.'</option>';
		}
		return $out;
	}
	

	

/* ============================================================================== 
/*	@BUILD: STATUS ARRAY
/* ------------------------------------------------------------------------------ */		

	function get_statusList($status_id)
	{
		$result = '';
		$sq_qry = "SELECT `status` FROM `pom_status` WHERE (`status_id` =".q_si($status_id).") ;";		
		$cn_qry = current($this->dbQueryFetch($sq_qry));		
		return $cn_qry['status'];
	}

	


/* ============================================================================== 
/*	@BUILD: STATUS SELECTABLE
/* ------------------------------------------------------------------------------ */		

	function get_statusSelectable($crit = '')
	{
		$result = array();
		$out = '<option value=""></option>';
		$sq_qry = "SELECT `status_id` , `status` FROM `pom_status` WHERE (`published` =1 AND `selectable` =1) order by `status`;";		
		$result = $this->dbQueryFetch($sq_qry);	
		foreach($result as $k => $arr){
			$title = $arr['status'];
			$id 	= $arr['status_id'];
			
			$isSelected = ($crit == $id) ? " selected " : "";
			
			$out .=  '<option value="'.$id.'" '.$isSelected.'>'.$title.'</option>';
		}
		return $out;
	}

	



/* ============================================================================== 
/*	@BUILD: COUNTIES
/* ------------------------------------------------------------------------------ */		

	function get_county($county = '', $select = 1)
	{
		$result = array();
		$out = '<option value=""></option>';
		$sq_qry = "SELECT `region_code` , `region_title` FROM `pom_counties` WHERE (`region_type_id` =1);";		
		$result = $this->dbQueryFetch($sq_qry);	
		foreach($result as $k => $arr){
			$ctitle = $arr['region_title'];
			
			$isSelected = ($county == $ctitle) ? " selected " : "";
			
			$out .=  '<option value="'.$ctitle.'" '.$isSelected.'>'.$ctitle.'</option>';
		}
		return $out;
	}


/* ============================================================================== 
/*	@BUILD: SUB-COUNTIES
/* ------------------------------------------------------------------------------ */		

	function get_county_sub($county)
	{
		$result = array();
		$out = '<option value=""></option>';
		$sq_qry = "SELECT `pom_counties`.`region_code` , `pom_counties`.`region_title` FROM `pom_counties` INNER JOIN `pom_counties` AS `pom_counties_1` ON (`pom_counties`.`region_parent_code` = `pom_counties_1`.`region_code`) WHERE (`pom_counties`.`region_type_id` =2 AND `pom_counties_1`.`region_title` =".$this->quote_si($county).");";		
		$result = $this->dbQueryFetch($sq_qry);	
		foreach($result as $k => $arr){
			$ctitle = $arr['region_title'];
			$out .=  '<option value="'.$ctitle.'">'.$ctitle.'</option>';
		}
		return $out;
	}



/* ============================================================================== 
/*	@CREATE MILESTONES
/* ------------------------------------------------------------------------------ */		

	function sys_createMilestones($pet_id, $app_date)
	{
		$post_by = $_SESSION['sess_pom_member']['u_id'];
		$result = array();
		$sq_qry = "SELECT * FROM `pom_milestones` WHERE (`published` =1) ORDER BY `step_position` ASC;";		
		$result = $this->dbQueryFetch($sq_qry);	
		
		$due_date = $app_date;
		foreach($result as $k => $arr){
			$milestone_id 	= $arr['milestone_id'];
			$milestone_hr 	= $arr['step_hours'];
			$milestone_func  = $arr['step_function'];
			
			if($milestone_hr > 0) { $milestone_hr = $milestone_hr * 60 * 60; }
			$due_date = $due_date + $milestone_hr;
			
			if($milestone_func == 'func_pet_save') 
			{ $mstone_status = 7; $mstone_done = 1; } else 
			{ $mstone_status = 8; $mstone_done = 0; }
			
			$setup_miles[] = "INSERT IGNORE INTO `pom_milestones_to_petitions` (`petition_id` , `milestone_id` , `date_due` , `status_id` , `update_by` , `complete` , `step_function`) VALUES (".$this->quote_si($pet_id).", ".$this->quote_si($milestone_id).", ".$this->quote_si($due_date).", ".$this->quote_si($mstone_status).", ".$this->quote_si($post_by).", ".$this->quote_si($mstone_done).", ".$this->quote_si($milestone_func).")";			
		}
		
		$this->dbQueryMulti($setup_miles);
	}
	


/* ============================================================================== 
/*	UPDATE PETITION MILESTONE
/* ------------------------------------------------------------------------------ */	
	
	function sys_statusMilestone($pet_id, $mst_id, $status_id = 7)
	{
		$post_by = $_SESSION['sess_pom_member']['u_id'];
		if($status_id == '') { $status_id = 8; }
		$sq_qry = "UPDATE `pom_milestones_to_petitions` set `status_id`=".$this->quote_si($status_id).", `complete`='1', `update_by` =".$this->quote_si($post_by)."  WHERE`petition_id`= ".$this->quote_si($pet_id)." and `milestone_id`= ".$this->quote_si($mst_id)."; ";			
		
		$this->dbQuery($sq_qry);
	}
	



/* ============================================================================== 
/*	CALL PETITION MILESTONE
/* ------------------------------------------------------------------------------ */	
	function sys_petMilestones($pet_id)
	{
		$milestones_arr	  = array();
		//$res_m	  = array();
		
	/*-----------------------------------------------------------------------------------*/
	/*	Milestones
	/*-----------------------------------------------------------------------------------*/	
	//$sq_mstones = "SELECT * FROM `pom_milestones_to_petitions` WHERE (`petition_id` = ".$this->quote_si($pet_id).") ;";
	$sq_mstones = "SELECT
    `pom_milestones_to_petitions`.`id`
    , `pom_milestones`.`step_title`
    , `pom_milestones_to_petitions`.`date_due`
    , `pom_milestones_to_petitions`.`status_id`
    , `pom_status`.`status`
    , `pom_milestones_to_petitions`.`complete`
    , `pom_milestones`.`step_function`
    , `pom_milestones_to_petitions`.`petition_id`
	, `pom_milestones`.`milestone_id`
FROM
    `pom_milestones`
    INNER JOIN `pom_milestones_to_petitions` 
        ON (`pom_milestones`.`milestone_id` = `pom_milestones_to_petitions`.`milestone_id`)
    INNER JOIN `pom_status` 
        ON (`pom_milestones_to_petitions`.`status_id` = `pom_status`.`status_id`)
WHERE (`pom_milestones`.`published` =1
    AND `pom_milestones_to_petitions`.`petition_id` = ".$this->quote_si($pet_id).") ORDER BY `pom_milestones`.`step_position` ASC ;";
	$rs_mstones = $this->dbQuery($sq_mstones);
	$rs_count =  $this->recordCount($rs_mstones);
	
	if($rs_count > 0)
	{
		$current_time = time();
		
		while($cn_query = $this->fetchRow($rs_mstones, 'assoc'))
		{
			$step_id 	  = $cn_query['milestone_id'];
			$step_title   = clean_output($cn_query['step_title']);
			$step_status_id   = $cn_query['status_id'];
			$step_status   = $cn_query['status'];
			$step_function   = $cn_query['step_function'];
			$step_complete   = $cn_query['complete'];
			$date_due   = $cn_query['date_due'];
			
			$overdue = 0;
			if($step_complete == 0 and ($date_due < $current_time)) { $overdue = 1; }
			
			//[$pet_id]
			$milestones_arr['full'][$step_id] = array 
			(
				'step_id' 	 => ''.$step_id.'',
				'step_title'    => ''.$step_title.'',
				'step_date_due'     => ''.$date_due.'',
				'step_status_id'   => ''.$step_status_id.'',
				'step_status'   => ''.$step_status.'',
				'step_complete'     => ''.$step_complete.'',
				'overdue'      	=> ''.$overdue.'',
				'step_function'     => ''.$step_function.''
			);
			
			$milestones_arr['stats'][$step_function]['complete'] = $step_complete;
		}
		
		master::$mstoneStats  = $milestones_arr['stats'];
	}
		return $milestones_arr;
	}




/* ============================================================================== 
/*	CALL PETITION SINGLE MILESTONE STATUS
/* ------------------------------------------------------------------------------ */	
	function sys_petMilestoneStatus($pet_id, $step_function = '')
	{
		$result	  = array();
		// AND `step_function` =".$this->quote_si($step_function)."
		$sq_mstones = "SELECT `milestone_id` , `date_due` , `status_id` , `complete` , `step_function` FROM `pom_milestones_to_petitions` WHERE (`petition_id` =".$this->quote_si($pet_id).") ;";
		
		$sq_mstones = "SELECT `pom_milestones_to_petitions`.*, `pom_milestones`.* FROM `pom_milestones_to_petitions` INNER JOIN `pom_milestones` 
        ON (`pom_milestones_to_petitions`.`milestone_id` = `pom_milestones`.`milestone_id`) WHERE (`pom_milestones`.`published` =1 and `pom_milestones_to_petitions`.`petition_id` =".$this->quote_si($pet_id).") ;"; 
		$rs_mstones = $this->dbQuery($sq_mstones);
		$rs_count =  $this->recordCount($rs_mstones);
		
		if($rs_count > 0) 
		{
			//$result = $this->fetchRow($rs_mstones, 'assoc');	
			while($cn_query = $this->fetchRow($rs_mstones, 'assoc'))
			{
				$step_id 	  = $cn_query['milestone_id'];
				$step_status_id   = $cn_query['status_id'];
				$step_function   = $cn_query['step_function'];
				$step_complete   = $cn_query['complete'];
				
				$result[$step_function]['complete'] = $step_complete;
			}/**/	
		}
		return $result;
	}



/* ============================================================================== 
/*	MEMBER EXIST
/* ------------------------------------------------------------------------------ */	
	
	function account_checkExist($account_email)
	{
		$result = 0;
		$sq_check = "SELECT * FROM `pom_reg_accounts` WHERE (`account_email` = ".$this->quote_si($account_email).")";
		$rs_check = $this->dbQuery($sq_check);
	
		if($this->recordCount($rs_check)>=1) { 
			$result = 1;
		}
		return $result;
	}

/* ============================================================================== 
/*	MEMBER LEVELS
/* ------------------------------------------------------------------------------ */	
	
	function account_saveLevel($account_id, $levels)
	{
		$sq_qry = array();
		$sq_del = "delete from `pom_reg_accounts_to_levels` WHERE `account_id`= ".$this->quote_si($account_id)." ; ";
		$this->dbQuery($sq_del);
		
		foreach($levels as $level_id)
		{
			$sq_qry[] = "INSERT INTO `pom_reg_accounts_to_levels` (`level_id`, `account_id`) values (".$this->quote_si($level_id).", ".$this->quote_si($account_id)."); ";	
		}
		//displayArray($sq_qry); exit;
		if(count($sq_qry)) { $this->dbQueryMulti($sq_qry); }
	}


/* ============================================================================== 
/*	@BUILD: BREADCRUMBS
/* ------------------------------------------------------------------------------ */	

	function get_breadcrumb($cat, $cat_id = '')
	{
		$parent = '';
		$parent_ref = '#';
		$current_ref = '';
		
		$refs['pet_list'] = array('lbl' => 'petitions', 'ref' => 'index.php?tab=petitions', 'pgt' => 'petition details');
		$refs['members'] = array('lbl' => 'member accounts', 'ref' => 'index.php?tab='.$cat.'', 'pgt' => 'account details');
		$refs['profile'] = array('lbl' => 'member accounts', 'ref' => 'index.php?tab='.$cat.'', 'pgt' => 'account details');
		$refs['courts'] = array('lbl' => 'court list', 'ref' => 'index.php?tab='.$cat.'', 'pgt' => 'court details');
		$refs['prisons'] = array('lbl' => 'prisons list', 'ref' => 'index.php?tab='.$cat.'', 'pgt' => 'prison details');
		
		$refs['tasks'] = array('lbl' => 'pending tasks', 'ref' => 'index.php?tab='.$cat.'', 'pgt' => '');
		$refs['notifications'] = array('lbl' => 'notification list', 'ref' => 'index.php?tab='.$cat.'', 'pgt' => '');
		
		switch($cat)
		{ 
			case "petitions":
			case "viewpetition":
			case "comments":
			$parent 	 = $refs['pet_list']['lbl'];
			$parent_ref = $refs['pet_list']['ref'];
			if($cat_id <> ''){
				$current_ref = $refs['pet_list']['pgt'] . '&nbsp; <b>&rsaquo;</b>';
			}
			break;
			
			case "members":
			case "courts":
			case "prisons":
			case "tasks":
			case "notifications":
			$parent 	 = $refs[$cat]['lbl'];
			$parent_ref = $refs[$cat]['ref'];
			if($cat_id <> ''){
				$current_ref = '<b>&rsaquo;</b> &nbsp;'. $refs[$cat]['pgt'] . '&nbsp; <b>&rsaquo;</b>';
			}
			break;
		}
		
		
		echo '<!-- @beg:: bcrumbs -->
<div class="breadcrumbs">
	<div class="subcolumnsX breadcrumbpadd"><a href="./">dashboard</a>&nbsp; <b>&rsaquo;</b> &nbsp;
		<a href="'.$parent_ref.'">'.$parent.'</a>&nbsp; 
		'.$current_ref.' 	
	</div>
</div>
<!-- @end:: bcrumbs -->	
';
	}
		
		
/* ============================================================================== 
/*	@BUILD: STATS
/* ------------------------------------------------------------------------------ */		

	function stat_records($tb, $crit = '')
	{
		$us_id	 	= $_SESSION['sess_pom_member']['u_id'];
		$us_level_id  = $_SESSION['sess_pom_member']['u_level_id'];
		
		$user_crit 	= ($us_level_id <> 1 and $us_level_id <> 3) ? " and `account_id` = ".$this->quote_si($us_id)." " : "";
		 
		$result  = 0;
		$tb_name = '';
		
		if($tb == 'pet_new'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_details` WHERE (`published` = 1) and (`status_id` = 1) $user_crit;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		elseif($tb == 'pet_open'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_details` WHERE (`published` = 1) and (`admissible` = 1) $user_crit;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		elseif($tb == 'pet_approved'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_details` WHERE (`published` = 1) and (`approved` = 1) $user_crit;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		elseif($tb == 'pet_recommendXXX'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_details` WHERE (`published` = 1) and (`approved` = 1) $user_crit;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		
		elseif($tb == 'pet_comments'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_comments` WHERE (`petition_id` = ".$this->quote_si($crit).")  and `parent_id` = 0 ;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		
		
		
		elseif($tb == 'pet_votes')
		{
			$out = array();
			
			/*$sq_votes = "SELECT count(*) FROM `pom_petition_committee` WHERE (`petition_id` =".$this->quote_si($crit).") ; ";		
			$rs_votes = $this->dbQuery($sq_votes);	
			$cn_votes = $this->fetchRow($rs_votes);			
			$out['sum'] = $cn_votes[0];	*/
			
			$sq_qry = "SELECT `petition_id` , `vote` , COUNT(`vote`) AS `vote_num` FROM `pom_petition_committee` WHERE (`petition_id` =".$this->quote_si($crit).") GROUP BY `petition_id`, `vote`; ";		
			$rs_qry = $this->dbQuery($sq_qry);	
			
			$vnum = 0;
			if($this->recordCount($rs_qry) > 0) 
			{
				while($cn_qry = $this->fetchRow($rs_qry, 'assoc')) {
					$vnum = $vnum + $cn_qry['vote_num'];
					$out[$cn_qry['vote']] = $cn_qry['vote_num'];
				}
			}
			$out['sum'] = $vnum;
			$result = $out;
					
		}
		
		
		
		elseif($tb == 'pet_votes_yes'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_comments` WHERE (`petition_id` = ".$this->quote_si($crit).")  and `vote` = 1 ;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		elseif($tb == 'pet_votes_no'){
			$sq_qry = "SELECT count(*) FROM `pom_petition_comments` WHERE (`petition_id` = ".$this->quote_si($crit).")  and `vote` = 2 ;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = $cn_qry[0];		
		}
		
		
		elseif($tb == 'pet_rating'){
			//$sq_qry = "SELECT AVG(`rating`) AS `rating`, `petition_id` FROM `pom_petition_comments` WHERE (`petition_id` =".$this->quote_si($crit)." AND `parent_id` =0 AND `published` =1) GROUP BY `petition_id`;";
			$sq_qry = "SELECT AVG(`rating`) AS `rating`, `petition_id` FROM `pom_petition_committee` WHERE (`petition_id` =".$this->quote_si($crit)."  and rating <> '0') GROUP BY `petition_id`;";		
			$rs_qry = $this->dbQuery($sq_qry);	
			$cn_qry = $this->fetchRow($rs_qry);			
			$result = floor($cn_qry[0]).'/10';		
		}
		else
		{
			$crit = "";
			if($tb == 'members') { $tb_name = '`casft_member`'; }
			if($tb == 'committees') { $tb_name = '`casft_committee`'; }
			if($tb == 'imprests') { $tb_name = '`casft_imprest`'; $crit = " and `approved` = 0 "; }// and `submit_status` = 0
			
			
			
			if($tb_name <> '') {
				$sq_qry = "SELECT count(*) FROM $tb_name WHERE (`published` = 1 $crit) ;";		
				$rs_qry = $this->dbQuery($sq_qry);	
				$cn_qry = $this->fetchRow($rs_qry);
				
				$result = $cn_qry[0];
			}
		}
		return $result;
	}

	
	

/*
* END CLASS
*/	
}


$dispDt = new data_sr;
//$dispCa->build_committees();
?>