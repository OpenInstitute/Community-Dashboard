<!-- Validation -->
<style type="text/css">
/*-------------------------------------------------------------------------------------------------------
@ FORMS - VALIDATION
-------------------------------------------------------------------------------------------------------*/

input.error, textarea.error, select.error { border:1px solid #FF0000 !important;  background:url("../image/icons/invalid.png") no-repeat 100% 7px #FEF7F7 !important; }
select.error, input.txtright.error { background-position: 3px 50% !important; padding-left: 17px; }
input[type=checkbox].error {  padding-left:80px !important; width:30px !important; margin:0 !important; display:inline-block !important;  }
input[type=checkbox].error:after{content:"!";display:block; color:#f00; }
label.label-checkbox input.error { color: #f00 !important;}


div.errorBox {
	background-color: #fee; color: #400; border: 1px #844 dashed; padding: 5px; 
	margin: 0 0 10px; text-align:center; display: none; font-size: 95%;
}

</style>

<script type="text/javascript" src="scripts/autocomplete/jquery.auto-complete.min.js"></script>
<link rel="stylesheet" type="text/css" href="scripts/autocomplete/jquery.auto-complete.css" />

<?php /*?><script type="text/javascript" src="scripts/autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="scripts/autocomplete/jquery.autocomplete.css" /><?php */?>

<script type="text/javascript" src="scripts/validate/jquery.validate-1.14.min.js"></script>
<script type="text/javascript" src="scripts/validate/jquery.validate-1.14.additional.min.js"></script>

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="scripts/datatable/smoothness/jquery-ui-1.10.3.css">
<link rel="stylesheet" type="text/css" href="scripts/datatable/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="scripts/datatable/jquery.dataTables.override.css">
<script type="text/javascript" src="scripts/datatable/jquery.dataTables-1.10.12.min.js"></script>


<!-- Datepick -->
<link rel="stylesheet" type="text/css" href="scripts/datepick/jquery.ui.timepicker.css">
<link rel="stylesheet" type="text/css" href="scripts/datepick/jquery.datepick.css">
<script type="text/javascript" src="scripts/datepick/jquery.plugin.js"></script>
<script type="text/javascript" src="scripts/datepick/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="scripts/datepick/jquery.datepick.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($)
{
	var hash = window.location.hash.substr(1);
	$('#srTabs a[href="#'+hash+'"]').tab('show');
	
	
	
	$(".rwdvalid").validate({errorContainer: ".errorBox" , errorPlacement: function(error, element) { } });
	
	$('table.display').dataTable({
		"bProcessing": true, "bJQueryUI": true
		, "sPaginationType": "full_numbers"
		, "bStateSave": true 
		, "iDisplayLength": 10 
		//, "ordering": false
		, "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
	});
	
	
	var jxhr;
	$('#bw_name').autoComplete({
		source: function(term, response){
			try { jxhr.abort(); } catch(e){}
			jxhr = $.getJSON('includes/sr_breadwinners_b.php', { q: term }, function(data){  response(data); });
		},
		renderItem: function (item, search){
			search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			var dlist = 'ID: '+item[0]+' | Name: '+item[1]+' | Phone: '+item[2];				
			return '<div class="autocomplete-suggestion" data-id="'+item[0]+'" data-name="'+item[1]+'" data-phone="'+item[2]+'" data-val="'+search+'">'+dlist.replace(re, "<b>$1</b>")+'</div>';
		},
		onSelect: function(e, term, item){
			$('#bw_id').val(item.data('id'));
			$('#bw_name').val(item.data('name'));
			$('#bw_phone').val(item.data('phone'));
		}
	});
	
	
	
	if($('#sr_casetype').length)
	{
		var ac_casetypes;
		<?php include('includes/sr_casetypes.php'); ?>	
		$('#sr_casetype').autoComplete({
			minChars: 1,
			source: function(term, suggest){
				term = term.toLowerCase();
				var choices = ac_casetypes;
				var suggestions = [];
				for (i=0;i<choices.length;i++)
					if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
				suggest(suggestions);
			}
		});
	}
	
	if( $('.hasDatePicker, .hasTimePicker').length ) { 
		$('.hasDatePicker').datepick();
		$('.hasTimePicker').timepicker({showPeriodLabels: false });
	}
	
});	



//function formatItem(row) {	return row[0] + " (<strong>id: " + row[1] + "</strong>)"; }
function formatResult(row) { return row[1].replace(/(<.+?>)/gi, '');  }
function formatResultb(row) { return row[0].replace(/(<.+?>)/gi, '');  }

/*	@casetype autofill */
function callPopCode(theField, theForm) 
{
	jQuery(document).ready(function($){
		var itemFieldID = theField.id; 
		var itemCat = itemFieldID.substr(0,4); 
		var itemForm = theForm;
		var itemFormName = theForm;
		
		
		if(itemFormName == "_ct") 
		{
			jQuery("#"+itemFieldID+"").autocomplete('includes/sr_casetypes.php', {
				matchContains: true, //width: 280, //
				formatItem: function(data, i, n, value) {return data[1]; },
				formatResult: formatResultb
			});
		}
		
		if(itemFormName == "_bw_name") 
		{
			jQuery("#"+itemFieldID+"").autocomplete('includes/sr_breadwinners.php', {
				matchContains: true, //width: 280, //
				formatItem: function(data, i, n, value) {return data[0] + " ............. " + data[1] + ""; },
				formatResult: formatResult
			});
		}
		
		if(itemFormName == "_bw_id") 
		{
			jQuery("#"+itemFieldID+"").autocomplete('includes/sr_breadwinners.php', {
				matchContains: true, //width: 280, //
				formatItem: function(data, i, n, value) {return data[0] + " ............. " + data[1] + ""; },
				formatResult: formatResultb
			});
		}
		
		jQuery("#"+itemFieldID+"").result(function(event, data, formatted) {
			//alert(data);
			var hidden_name = $("#"+itemCat+"_fullname"+itemForm+""); hidden_name.val(data[1]);
			var hidden_code = $("#"+itemCat+"_code"+itemForm+""); hidden_code.val(data[0]);
		});
		
	});
}
</script>