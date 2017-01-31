<?php
 if ('http://'.$_SERVER['HTTP_HOST'] == 'http://localhost'){
	require_once("classes/cls.formats.php"); 
	require_once("classes/cls.config.php"); 
} else { require_once("../inc/conn.inc"); }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lanet SDG5 Data</title>
<link rel="stylesheet" type="text/css" href="styles/style.css" /> 
<script type="text/javascript" src="scripts/jquery-1.12.3.js"></script>
</head>

<body class="padd20">
<script>var pageOp = 'new';var pageDir = 'dashboard'; var aLoader = '...loading...';</script>
<h1 class="" style="border-bottom:1px solid #ccc;">Lanet SDG5 Data</h1>

<?php
/* ============================================================================== 
/*	STATISTICS
/* ------------------------------------------------------------------------------ */	
$sq_total = "SELECT count(*) as `total_posts` FROM `mob_form_posts` where `form_source` <> '';";		
$rs_total = current($cndb->dbQueryFetch($sq_total));	
//displayArray($rs_total);

$sq_locs = "SELECT sublocation, COUNT(form_source) as `loc_posts` FROM mob_form_posts_sdg_gender WHERE form_source <> '' GROUP BY sublocation";		
$rs_locs = $cndb->dbQueryFetch($sq_locs);
$arrLocNum = array();
foreach($rs_locs as $ak => $aloc){
	$loc_name = (trim($aloc['sublocation'])=='' or trim($aloc['sublocation'])=='-') ? 'Unspecified' : $aloc['sublocation'];
	$arrLocNum[$loc_name] = $aloc['loc_posts'];
}
//displayArray($arrLocNum);
	
$sq_grps = "SELECT COUNT(form_source) as `num_posts`, DATE_FORMAT(sync_date, '%Y-%b-%d') as sync_date, group_1name, sublocation FROM mob_form_posts_sdg_gender WHERE group_1name <> '' GROUP BY DATE_FORMAT(sync_date, '%Y-%b-%d'), group_1name, sublocation ORDER BY num_posts DESC limit 0,2";
	
$rs_grps = $cndb->dbQueryFetch($sq_grps); 
//displayArray($rs_grps);
	
	
	
?>



	
	<div style="padding:10px;overflow:hidden">
		
		<div class="subcolumns">
		
		<div class="col-md-4">
			<div style="width:90%; height:110px;margin:5px auto;background:#849C3E;">
				<div class="txtwhite txtcenter" style="padding:10px;">
						<div style="font-size:40px; text-align:center; line-height:50px;height:55px;">
						<?php echo $rs_total['total_posts']; ?></div>
						<div style="font-size:13px; text-align:center; line-height:13px;">Number of Submissions</div>
				</div>
			</div>
		</div>	
		
		
		<div class="col-md-4">	
			<div style="width:90%; height:110px;margin:5px auto;background:#E05F4C;">
				<div class="txtwhite txtcenter" style="padding:10px;">
						
					<div class="txt14 bold">Posts Per Sub-Location</div>				
					<div class="col-md-6">		
					<div class="txt13" style="line-height:30px;"><span class="txt19"><?php echo $arrLocNum['Unspecified']; ?></span> Unspecified</div>
					<div class="txt13" style="line-height:30px;"><span class="txt19"><?php echo $arrLocNum['Kiamunyeki']; ?></span> Kiamunyeki</div>
					</div>
					
					<div class="col-md-6">	
					<div class="txt13" style="line-height:30px;"><span class="txt19"><?php echo $arrLocNum['Murunyu']; ?></span> Murunyu</div>
					<div class="txt13" style="line-height:30px;"><span class="txt19"><?php echo $arrLocNum['Umoja']; ?></span> Umoja</div>
					</div>
					
				</div>
			</div>
		</div>	
		
		
		<div class="col-md-4">	
			<div style="width:90%; height:110px;margin:5px auto;background:#0083C4;">
				<div class="txtwhite txtcenter" style="padding:10px 10px 10px;">	
					<div class="txt14 bold">Posts Per Group <em class="txt12">(Top 2) - <a href="grp_totals.php" target="_blank" class="txtyellow">More</a></em></div>				
						
					<div class="txt13" style="line-height:30px;"><span class="txt19"><?php echo $rs_grps[0]['num_posts']; ?></span> <?php echo ucwords($rs_grps[0]['group_1name']); ?> (<?php echo $rs_grps[0]['sublocation']; ?>)</div>
					<div class="txt13" style="line-height:30px;"><span class="txt19"><?php echo $rs_grps[1]['num_posts']; ?></span> <?php echo ucwords($rs_grps[1]['group_1name']); ?> (<?php echo $rs_grps[1]['sublocation']; ?>)</div>
					
				</div>
			</div>
		</div>		
		
		
		</div>
		
		</div>
<?php

	
/* ============================================================================== 
/*	PETITIONS! 
/* ------------------------------------------------------------------------------ */
	
	
$sq_qry = "SELECT * FROM `mob_form_posts` WHERE `form_source` <> '' ORDER BY `sync_date` DESC;";		
$rs_qry = $cndb->dbQuery($sq_qry);	

$rs_qry_count = $cndb->recordCount($rs_qry);
		
	if($rs_qry_count)
	{
		$result    = '';
		$i = 1;
		while($cn_qry_a = $cndb->fetchRow($rs_qry, 'assoc')) 
		{
			//displayArray($cn_qry_a); exit;
			
			$cn_qry 	   = array_map("clean_output", $cn_qry_a); 
			$post_id      = $cn_qry['post_id']; 
			$form_source  = $cn_qry['form_source'];
			$psource      = substr($cn_qry['form_source'],-15); //echobr($psource);
			$pdate        = $cn_qry['sync_date'];
			$form_id      = $cn_qry['form_id'];
			$form_data    = (array) json_decode($cn_qry['form_detail']);
			$post_group   = array($form_data['group_1name'], $form_data['group_2name'], $form_data['group_3name'], $form_data['group_4name'], $form_data['group_5name']);
			$post_group   = array($form_data['group_1name'], $form_data['group_2name'], $form_data['group_3name'], $form_data['group_4name'], $form_data['group_5name']);
			//displayArray($form_data); exit;
			
			
			$sq_gender[] = "INSERT IGNORE INTO `mob_form_posts_sdg_subcats`(`post_id`, `form_source`, `form_id`, `sync_date`, `violence_physical`, `violence_physical_slapped`, `violence_physical_slapped_by`, `violence_physical_whipped`, `violence_physical_whipped_by`, `violence_physical_roughed`, `violence_physical_roughed_by`, `violence_physical_threatened`, `violence_physical_threatened_by`, `violence_physical_FGM`, `violence_physical_FGM_by`, `violence_physical_other`, `violence_physical_other_by`, `violence_sexual`, `violence_sexual_rape`, `violence_sexual_rape_by`, `violence_sexual_grope`, `violence_sexual_grope_by`, `violence_sexual_verbal`, `violence_sexual_verbal_by`, `violence_psych`, `violence_psych_emotion`, `violence_psych_emotion_by`, `violence_psych_verbal`, `violence_psych_verbal_by`, `violence_report`, `violence_report_to`, `violence_report_to_other`, `violence_report_none`, `violence_report_none_other`, `violence_report_action`, `violence_report_action_other`) VALUES ( ".q_si($post_id).", ".q_si($form_source).", ".q_si($form_id).", ".q_si($pdate).", ".q_si($form_data['violence_physical']).", ".q_si($form_data['violence_physical_slapped']).", ".q_si($form_data['violence_physical_slapped_by']).", ".q_si($form_data['violence_physical_whipped']).", ".q_si($form_data['violence_physical_whipped_by']).", ".q_si($form_data['violence_physical_roughed']).", ".q_si($form_data['violence_physical_roughed_by']).", ".q_si($form_data['violence_physical_threatened']).", ".q_si($form_data['violence_physical_threatened_by']).", ".q_si($form_data['violence_physical_FGM']).", ".q_si($form_data['violence_physical_FGM_by']).", ".q_si($form_data['violence_physical_other']).", ".q_si($form_data['violence_physical_other_by']).", ".q_si($form_data['violence_sexual']).", ".q_si($form_data['violence_sexual_rape']).", ".q_si($form_data['violence_sexual_rape_by']).", ".q_si($form_data['violence_sexual_grope']).", ".q_si($form_data['violence_sexual_grope_by']).", ".q_si($form_data['violence_sexual_verbal']).", ".q_si($form_data['violence_sexual_verbal_by']).", ".q_si($form_data['violence_psych']).", ".q_si($form_data['violence_psych_emotion']).", ".q_si($form_data['violence_psych_emotion_by']).", ".q_si($form_data['violence_psych_verbal']).",".q_si($form_data['violence_psych_verbal_by']).", ".q_si($form_data['violence_report']).", ".q_si($form_data['violence_report_to']).", ".q_si($form_data['violence_report_to_other']).", ".q_si($form_data['violence_report_none']).", ".q_si($form_data['violence_report_none_other']).", ".q_si($form_data['violence_report_action']).", ".q_si($form_data['violence_report_action_other'])."); ";
			
			
			
			
			
			
			
			$sq_gender[] = "INSERT IGNORE INTO `mob_form_posts_sdg_gender`
			(`post_id`, `form_source`, `form_id`, `sync_date`, `sublocation`, `cluster`, `age`, `gender`, `profession`, `employment`, `group_number`, `group_1name`, `group_1purpose`, `group_1gender`, `group_1contribution`, `group_2name`, `group_2purpose`, `group_2gender`, `group_2contribution`, `group_3name`, `group_3purpose`, `group_3gender`, `group_3contribution`, `group_4name`, `group_4purpose`, `group_4gender`, `group_4contribution`, `group_5name`, `group_5purpose`, `group_5gender`, `group_5contribution`, `violence_physical`, `violence_sexual`, `violence_psych`, `leadership_held`, `leadership_position`, `women_equality`, `skilled_delivery`, `skilled_delivery_location`, `child_death`, `child_death_cause`, `family_planning`, `family_planning_method`, `family_planning_spouse_support`, `family_planning_care_support`, `family_planning_care_support_type`, `security_enough`, `security_suggestion`, `married`, `married_age`, `gov_deliver_a`, `gov_deliver_b`, `gov_deliver_c`) VALUES 			(".q_si($post_id).",".q_si($form_source).",".q_si($form_id).",".q_si($pdate).",".q_si($form_data['sublocation']).",".q_si($form_data['cluster']).",".q_si($form_data['age']).",".q_si($form_data['gender']).",".q_si($form_data['profession']).",".q_si($form_data['employment']).",".q_si($form_data['group_number']).",".q_si($form_data['group_1name']).",".q_si($form_data['group_1purpose']).",".q_si($form_data['group_1gender']).",".q_si($form_data['group_1contribution']).",".q_si($form_data['group_2name']).",".q_si($form_data['group_2purpose']).",".q_si($form_data['group_2gender']).",".q_si($form_data['group_2contribution']).",".q_si($form_data['group_3name']).",".q_si($form_data['group_3purpose']).",".q_si($form_data['group_3gender']).",".q_si($form_data['group_3contribution']).",".q_si($form_data['group_4name']).",".q_si($form_data['group_4purpose']).",".q_si($form_data['group_4gender']).",".q_si($form_data['group_4contribution']).",".q_si($form_data['group_5name']).",".q_si($form_data['group_5purpose']).",".q_si($form_data['group_5gender']).",".q_si($form_data['group_5contribution']).",".q_si($form_data['violence_physical']).",".q_si($form_data['violence_sexual']).",".q_si($form_data['violence_psych']).", ".q_si($form_data['leadership_held']).",".q_si($form_data['leadership_position']).",".q_si($form_data['women_equality']).",".q_si($form_data['skilled_delivery']).",".q_si($form_data['skilled_delivery_location']).",".q_si($form_data['child_death']).",".q_si($form_data['child_death_cause']).",".q_si($form_data['family_planning']).",".q_si($form_data['family_planning_method']).",".q_si($form_data['family_planning_spouse_support']).",".q_si($form_data['family_planning_care_support']).",".q_si($form_data['family_planning_care_support_type']).",".q_si($form_data['security_enough']).",".q_si($form_data['security_suggestion']).",".q_si($form_data['married']).",".q_si($form_data['married_age']).",".q_si($form_data['gov_deliver_a']).",".q_si($form_data['gov_deliver_b']).",".q_si($form_data['gov_deliver_c'])."); ";
			
			//displayArray($form_data);exit;
			$result .= '<tr>
					<td>'.$i.'</td>
					<td>'.$pdate.'</td>
					<td>'.$psource.'</td>
					<td>'.$form_data['sublocation'].'</td>
					<td>'.$form_data['cluster'].'</td>
					<td>'.$form_data['age'].'</td>
					<td>'.$form_data['gender'].'</td>
					<td>'.implode(',', $post_group).'</td> 
					<td><a href="genderb.php?id='.$post_id.'" target="_blank">More </a></td>
				</tr>';
			//displayArray($form_data);
			$i += 1;	
		}
		
	}

?>
<table class="table display">
	<thead>
		<tr>
			<th>#</th>
			<th>Date</th>
			<th>Source IMEI</th>
			<th>Sub Location</th>
			<th>Cluster</th>
			<th>Age</th>
			<th>Gender</th>
			<th>Groups</th>
			<th>...</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $result; ?>
	</tbody>
</table>

<?php
//displayArray($sq_gender);exit;
		$rs_gender = $cndb->dbQueryMulti($sq_gender);	
?>




<?php include("zscript_vary.php"); ?>

</body>
</html>
