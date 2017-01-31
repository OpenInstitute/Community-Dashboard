<div>
<center>
	<h3>Application Follow-up</h3>
	<p>Schedule Calendar</p>
</center>

<div class="table-responsive">
  <table class="table table-striped tabledata">
	<thead>
	  <tr>
		<th>Case Id</th>
		<th>Time</th>
		<th>Case Type</th>
		<th>Venue</th>
		<th>Name</th>
		<th>Detail</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td>1</td>
		<td>5:45 AM</td>
		<td>Arson</td>
		<td>Kiamunyeki</td>
		<td>Kamundia</td>
		<td>Resolve dispute and contact police</td>
	  </tr>
	  <tr>
		<td>2</td>
		<td>6:54 PM</td>
		<td>ID application</td>
		<td>Umoja</td>
		<td>Chief Kariuki</td>
		<th>Send to huduma</th>
	  </tr>
	</tbody>
  </table>
  </div>
  <div class="top divider"></div>
  <div class="divider"></div>
  <div class="topX col-md-12X">
	<center><h4>Set Schedule with Chief</h4></center>
	  <form method="post" action="_posts.php"> 
	  <input type="hidden" name="formname" value="frm_serviceregister_followup" />
	  <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>" />
		  <div class="top form-group">
				<label class="col-md-3 control-label">Select Date and Time</label>
				
				<div class="col-md-3">
					<input type="date" class="form-control required" placeholder="date" name="date" id="date">
				</div>
				<div class="col-md-3">
					<input type="time" value="<?php echo date('H:i'); ?>" class="form-control" name="start" id="start">
				</div>
		
				<?php /*?><div class="col-md-9">
				<input type="time" class="form-control" name="followuptime" value="06:00:00" />
				</div><?php */?>
			</div>
			<div class="clearfix"></div>
			<div class="top form-group">
				<label class="col-md-3 control-label">Chief Referred</label>
				<div class="col-md-9">
				<select name="chief" id="chief" placeholder="Select Chief">
					<?php
						$subq = "SELECT * FROM `sublocations` where 1";
						$subres = mysqli_query($conn, $subq);
						while($schief = mysqli_fetch_array($subres)){
					?>
					<option><?php echo $schief['subchief']; ?></option>
					   <?php } ?>
				</select>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="top form-group">
				<label class="col-md-3 control-label">Select Venue</label>
				<div class="col-md-8">
					<select name="location" id="location" placeholder="Select Venue">
						<?php
						$subq = "SELECT * FROM `sublocations` where 1";
						$subres = mysqli_query($conn, $subq);
						while($schief = mysqli_fetch_array($subres)){
					?>
					<option><?php echo $schief['location']; ?></option>
					   <?php } ?>
					</select>
				</div>
			</div>
			<div class="clearfix"></div>
				<div class="top form-group">
				<label class="col-md-3 control-label">More Detail</label>
				<div class="col-md-8">
				<textarea name="statement" id="statement" placeholder="Please enter detail" rows="3" class="form-control"></textarea>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="top form-group">
				<div class="top col-md-offset-3 col-md-8">
				<input type="submit" class="btn btn-primary" name="fsubmit" value="Submit Follow Up">
				</div>
			</div>
	  </form>
  </div>
</div>