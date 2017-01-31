<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>

<div id="wrap_serviceregister">

<center><h3>Apply</h3><p>Schedule a visit to the chief's office</p></center>

<form name="frm_serviceregister" id="frm_serviceregister" class="rwdvalid" method="post" action="_posts.php">
	<input type="hidden" name="formname" value="frm_serviceregister" />
	<div class="top form-group">
		<label class="col-md-3 control-label">Name</label>
		<div class="col-md-9">
		<input type="text" class="form-control required" name="name" id="bw_name" placeholder="Please enter your name/ group name" /> <?php /*?>  onfocus="javascript: callPopCode(this, '_bw_name');"<?php */?>
		</div>
	</div>
	
	<div class="clearfix"></div>
	<div class="top form-group">
		<label class="col-md-3 control-label" for="id_number">ID Number</label>
		<div class="col-md-9">
		<input type="text" class="form-control" name="id_number" id="bw_id" placeholder="Please enter your ID Number" maxlength="20" minlength="6" /> <?php /*?> onfocus="javascript: callPopCode(this, '_bw_id');"<?php */?>
		</div>
	</div>
	
	<div class="clearfix"></div>
	<div class="top form-group">
		<label class="col-md-3 control-label">Mobile Number</label>
		<div class="col-md-9">
		<input type="text" class="form-control required" name="cell" id="bw_phone" maxlength="50" placeholder="Please enter your mobile number" />
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="top form-group">
		<label class="col-md-3 control-label">Location</label>
		<div class="col-md-9">
		<select name="location" class="form-control required" id="location">
			<option name=""></option>
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
		<input type="text" class="form-control required" name="casetype" id="sr_casetype" placeholder="Please indicate the purpose of visit/case" />
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
	<div class="clearfix"></div><?php */?>
	
	<div class="top col-md-offset-3 col-md-8 form-group">
		<div class="col-md-6" style="padding: 2.5px !important;">
			<button style="padding: 2.5px !important;" id="submitForm" type="submit" class="btn btn-primary form-control" name="submit">Submit </button>
		</div>
		<?php /*?><div class="col-md-6" style="padding:2.5px !important;">
			<button style="padding: 2.5px !important;" class="btn btn-success" id="followUp" name="followupbtn" data-toggle="modal" data-target="#myModal">Submit &amp; Follow Up</button>
		</div><?php */?>
	</div>
</form>

</div>
<div id="result" class="warning"></div>

<script language="javascript">

jQuery(document).ready(function($)
{
	var v = $("#frm_serviceregisterXXX").validate({
		errorPlacement: function(error, element) { },
		submitHandler: function(form) {			
			//var form = $(this);
			var followup = $("input:checked").val(); 
			
			$.ajax( {
			  type: "POST",
			  url: form.attr('action'),
			  data: form.serialize(),
			  processData: false, 
		  	  contentType: false,
			  beforeSend: function() { $('#wrap_serviceregister').html('<center><h3>Apply</h3><p>Schedule a visit to the chief\'s office</p></center> <br><br>Processing...'); },
			  success: function( response ) {
				  if(followup === '1') {
					  /*$.get('_ajmod.php?fcall=servreg_fu&p_id='+response, function(resp) {
						$(resp).appendTo('body').modal();
					  });*/
					  $.get('_ajmod.php?fcall=servreg_form&p_id='+response, function(resp) {
						$('#wrap_serviceregister').html(resp);
					  });
				  } else {
					  location.href="ServiceRegister.php?qst=1"; /*location.reload();*/ 
				  }
				  return false;
			  }
			});
			
			//
		}
	}); 
	
	
	$('#frm_serviceregister').submit( function() {
		
		var v = $("#frm_serviceregister").validate({errorPlacement: function(error, element) { }});
		
		var form = $(this);
		var followup = $("input:checked").val(); 
		
		if(v.form()){
		$.ajax( {
		  type: "POST",
		  url: form.attr('action'),
		  data: form.serialize(),		  
		  beforeSend: function() { $('#wrap_serviceregister').html('<center><h3>Apply</h3><p>Schedule a visit to the chief\'s office</p></center> <br><br>Processing...'); },
		  success: function( response ) {
			  if(followup === '1') {
				  $('#wrap_serviceregister').html('<p>Enter follow-up details. <a href="ServiceRegister.php">New Application.</a></p>');
				  $.get('_ajmod.php?fcall=servreg_fu&p_id='+response, function(resp) {
					$(resp).appendTo('body').modal();
				  });
				  /*$.get('_ajmod.php?fcall=servreg_form&p_id='+response, function(resp) {
					$('#wrap_serviceregister').html(resp);
				  });*/
			  } else {
				  location.href="ServiceRegister.php?qst=1"; 
			  }
		  }
		});
		}
		
    	return false;
    });
	
});
</script>