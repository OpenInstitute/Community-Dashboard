<?php
$uid = $_GET['uid'];
$srAssoc 	= $dispDt->get_registryItem($uid); //displayArray($srAssoc);
$srFollowup = $dispDt->get_registryFollowups($uid); //displayArray($srFollowup);

$status_id 	= $srAssoc['status_id'];
$case_num 	= str_pad($srAssoc['register_id'],4,'0',STR_PAD_LEFT);
$visit_date = date('M d Y', strtotime($srAssoc['visit_date']));


?>
<div class="panel col-md-12">
<div style="padding:10px;" class="clearfix linegray">
	<!--<h3 style="padding-bottom:10px;">Case Details:</h3> -->
	
    <div class="col-md-4"><h4>Case No. <strong>#<?php echo $case_num; ?></strong> </h4></div> 
	<div class="col-md-4"><h4>Type: <strong><?php echo $srAssoc['casetype']; ?></strong> </h4></div>
	 <div class="col-md-4"><h4>Status: <strong class="txtred"><?php echo $srAssoc['status']; ?></strong></h4></div> 
</div>
	
<div class=" topX col-md-12">
		
			<!--Pre filled Form Will come here  -->
<div class="clearfix" style="margin:5px 0;">
	<div class="col-md-2"><strong>Name</strong></div><div class="col-md-4"><?php echo $srAssoc['name']; ?></div>
	<div class="col-md-2"><strong>Location</strong></div><div class="col-md-4"><?php echo $srAssoc['location']; ?></div>
</div>			
<div class="clearfix"></div>

<div class="clearfix" style="margin:5px 0;">
	<div class="col-md-2"><strong>ID Number</strong></div><div class="col-md-4"><?php echo $srAssoc['id_number']; ?></div>
	<div class="col-md-2"><strong>Mobile Number</strong></div><div class="col-md-4"><?php echo $srAssoc['cell']; ?></div>
</div>	
<div class="clearfix"></div>
<div class="clearfix" style="margin:5px 0;">
	<div class="col-md-2"><strong>Visit Date, Time</strong></div><div class="col-md-4"><?php echo $visit_date .' '.$srAssoc['visit_time']; ?></div>
	<!--<div class="col-md-2"><strong>End Time</strong></div><div class="col-md-4"><?php echo $srAssoc['end']; ?></div>-->
</div>	

<div class="clearfix"></div>

<div class="clearfix" style="margin:5px 0;">
	<div class="col-md-2"><strong>Statement / Remark</strong></div><div class="col-md-10"><?php echo $srAssoc['statement']; ?></div>
</div>	
<div class="clearfix"></div>
</div>

			
<div class="panel col-md-12">
<div class="clearfix" style="padding:5px 0;">
	<div class="padd15_t padd10_l"><h4>Case Follow-ups</h4></div> 
</div>

<?php

foreach($srFollowup as $fupArr)	
{ //displayArray($fupArr);
	$fup_date_start = date('M d Y', strtotime($fupArr['followup_date']));
	?>  
	<div class="clearfix" style="margin:5px 0; min-height:45px; background-color:#F5F7F8;">
		<div class="feed-block">
			<div class="feed-avatar"><img src="" width="39" height="39"></div>
			<div>
				<?php echo $fup_date_start; ?>: <b><?php echo $fupArr['name']; ?></b><br>
				<?php echo $fupArr['followup_comments']; ?>
			</div>
		</div>
	</div>	
<?php 
} 

if($status_id == 1){
	$newdate = dateAddDays(7); //echobr($newdate);
?>

<div class="clearfix" style="padding:5px 0;">
	<div class="padd15_t padd10_l"><h4>Add Follow Up / Update Status</h4></div> 
</div>

<div class="clearfix" style="margin:5px 0; min-height:45px; background-color:#F5F7F8;">
	<div class="feed-block">
		<div class="feed-avatar"><img src="" width="39" height="39"></div>
		<div>
			
			<div class="">
			<form name="frm_sr_followup" id="frm_sr_followup" class="rwdvalid" method="post" action="posts.php">
				<input type="hidden" name="formname" value="frm_sr_followup" />
				<input type="hidden" name="register_id" value="<?php echo $uid; ?>" />
				<div id="box_follow_up">
					<div class="col-md-12">
						<label class="col-md-1 control-label">New Date</label>
						<div class="col-md-4">
							<input type="text" value="<?php echo date('Y-m-d', $newdate); ?>" class="form-control required hasDatePicker col-md-7" name="follow_date" id="follow_date" >
							<input type="time" value="<?php echo date('H:i'); ?>" class="form-control hasTimePicker col-md-5 padd0_r" name="follow_time" id="follow_time" >
						</div>

						<label class="col-md-1 control-label padd0_r">Assign To</label>
						<div class="col-md-3">
							<select name="assigned_to" id="assigned_to" class="form-control">
								<?php echo $ddSelect->dropper_select("sublocations", "id", "subchief", "", "Assign to"); ?>
							</select>
						</div>
						
						<label class="col-md-1 control-label">Status</label>
						<div class="col-md-2">
							<select name="status_id" id="status_id" class="form-control">
								<?php echo $ddSelect->dropper_select("sr_casestatus", "status_id", "status", $status_id ); ?>
							</select>
						</div>
					</div>
					<div class="clearfix padd5"></div>
					<div class="col-md-12">
						<label class="col-md-1 control-label">Remarks</label>
						<div class="col-md-9">
							<textarea name="followup_comments" id="followup_comments" placeholder="Please enter statement or remark" rows="2" class="form-control"></textarea>
						</div>
						<div class="col-md-2">
							<button style="padding: 2.5px !important;" id="submitForm" type="submit" class="btn btn-primary form-control" name="submit">Submit </button>
						</div>
					</div>
				</div>
			</form>
			</div>
		
			
		</div>
	</div>
</div>	
	

<?php	
}
?>


</div>
	
</div>