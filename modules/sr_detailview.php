<?php
$uid = $_GET['uid'];
$srQ = "SELECT * FROM serviceregister where id='$uid'";
$srR = $cndb->dbQueryFetch($srQ);
//$srAssoc = $cndb->fetchRow($srR, 'assoc'); 
$srAssoc = current($srR);
$case_num = str_pad($srAssoc['id'],4,'0',STR_PAD_LEFT);
$date_start = date('M d Y', strtotime($srAssoc['date']));
//displayArray($srAssoc);
?>
<div class="panel col-md-12">
<div style="padding:10px;">
	<h3 style="padding-bottom:10px;">Service Register Details:</h3> 
	<h4>Case No. #<?php echo $case_num; ?></h4> 
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
	<div class="col-md-2"><strong>Start Date, Time</strong></div><div class="col-md-4"><?php echo $date_start .' '.$srAssoc['start']; ?></div>
	<div class="col-md-2"><strong>End Time</strong></div><div class="col-md-4"><?php echo $srAssoc['end']; ?></div>
</div>	
<div class="clearfix"></div>

<div class="clearfix" style="margin:5px 0;">
	<div class="col-md-2"><strong>Case Type</strong></div><div class="col-md-10"><?php echo $srAssoc['casetype']; ?></div>
</div>	
<div class="clearfix"></div>

<div class="clearfix" style="margin:5px 0;">
	<div class="col-md-2"><strong>Statement / Remark</strong></div><div class="col-md-10"><?php echo $srAssoc['statement']; ?></div>
</div>	
<div class="clearfix"></div>
</div>


<?php /*?>			
<form name="frm_serviceregister" id="frm_serviceregister" class="rwdvalid" method="post" action="_posts.php">
<input type="hidden" name="formname" value="frm_serviceregister" />
<div class="top form-group">
<label class="col-md-3 control-labelX">Name</label>
<div class="col-md-9">
<input type="text" class="form-control required" name="name" id="name" value="<?php echo $srAssoc['name']; ?>" />
</div>
</div>
<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">ID Number</label>
<div class="col-md-9">
<input type="text" class="form-control" name="idNumber" id="idNumber" value="<?php echo $srAssoc['id_number']; ?>" />
</div>
</div>
<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">Mobile Number</label>
<div class="col-md-9">
<input type="text" class="form-control required" name="cell" id="cell" value="<?php echo $srAssoc['cell']; ?>" />
</div>
</div>
<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">Location</label>
<div class="col-md-9">
<select name="location" class="form-control required" id="location">
<option name="umoja">Umoja</option>
<option name="umoja">Kiamunyeki</option>
<option name="murunyu">Murunyu</option>
<option name="other">Other Visit</option>
</select>
</div>
</div>
<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">Case Type</label>
<div class="col-md-9">
<input type="text" class="form-control required" name="casetype" id="casetype" placeholder="Please indicate the purpose of visit/case" />
</div>
</div>
<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">Statement/Remark</label>
<div class="col-md-9">
<textarea name="statement" id="statement" placeholder="Please enter statement or remark" rows="3" class="form-control textarea-smX required"></textarea>
</div>
</div>
<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">Date, Start & End Time</label>
<div class="col-md-3">
<input type="date" value="<?php echo date('d-M-Y'); ?>" class="form-control required" placeholder="date" name="date" id="date" >
</div>
<div class="col-md-3">
<input type="time" value="<?php echo date('H:i'); ?>" class="form-control" placeholder="start time" title="start time" name="start" id="start">
</div>
<div class="col-md-3">
<input type="time" value="" class="form-control" title="end time" placeholder="end time" name="end" id="end">
</div>
</div>


<div class="clearfix"></div>
<div class="top form-group">
<label class="col-md-3 control-label">Add Follow-up?</label>
<div class="col-md-9">
<label><input type="radio" name="followup"  id="followup_y" value="1" /> &nbsp; Yes</label> &nbsp; 
<label><input type="radio" name="followup" id="followup_n" value="0" checked /> &nbsp; No</label>
</div>
</div>

<div class="clearfix"></div>
<?php /*?><div class="col-md-offset-3 col-md-8">
<div class="col-md-4">
<div class="form-group">
<label class="control-label">Start Time</label>
<input type="time" value="<?php echo date('H:i'); ?>" class="form-control" placeholder="start time" name="start" id="start">
</div> 
</div>
<div class="col-md-6">
<div class="form-group">
<label class="control-label">End Time</label>
<input type="time" value="<?php echo date('H:i'); ?>" class="form-control" placeholder="end time" name="end" id="end">
</div> 
</div>

</div>
<div class="clearfix"></div>

<div class="top col-md-offset-3 col-md-8 form-group">
<div class="col-md-6" style="padding: 2.5px !important;">
<button style="padding: 2.5px !important;" id="submitForm" type="submit" class="btn btn-primary form-control" name="submit">Submit </button>
</div>

</div>
</form><?php */?>
			<!-- Pre filled form ends here -->
			
<div class="col-md-12">
<?php
$fupQ = "SELECT * FROM serviceregister where parent_id='$uid' ORDER BY date_record";
$fupR = $cndb->dbQuery($fupQ);
if($cndb->recordCount($fupR) >= 1){
?>
<h4>Case Follow-ups</h4>
<table class="panelX panel-bodyX table display">

<tbody>
<?php

while($fupArr = $cndb->fetchRow($fupR,'assoc') )
{ //displayArray($fupArr);

$fup_date_start = date('M d Y', strtotime($fupArr['date']));
?>  
<tr>
<td><label>Date: </label> &nbsp; <?php echo $fup_date_start; ?></td>
<td><label>Location: </label> &nbsp; <?php echo $fupArr['location']; ?></td>
<td><label>Referred: </label> &nbsp; <?php echo $fupArr['name']; ?></td>
</tr>
<tr>
<td colspan="3"><label>Statement: </label><br/><?php echo $fupArr['statement']; ?></td>
</tr>
<tr style=" background:#FFE7E6">
<td><label>Status: </label> &nbsp; <?php echo '//TODO'; ?></td>
<td colspan="2"><label>Comments: </label> &nbsp; <?php echo '//TODO'; ?></td>
</tr>

<?php } ?>
</tbody>
</table>
<?php } ?>

</div>
	
</div>