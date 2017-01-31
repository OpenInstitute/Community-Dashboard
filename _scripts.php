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

<!--
<script type="text/javascript" src="scripts/autocomplete/jquery.auto-complete.min.js"></script>
<link rel="stylesheet" type="text/css" href="scripts/autocomplete/jquery.auto-complete.css" />
-->


<script type="text/javascript" src="scripts/validate/jquery.validate-1.14.min.js"></script>
<script type="text/javascript" src="scripts/validate/jquery.validate-1.14.additional.min.js"></script>

<!-- Datatable -->
<link rel="stylesheet" type="text/css" href="scripts/datatable/smoothness/jquery-ui-1.10.3.css">
<link rel="stylesheet" type="text/css" href="scripts/datatable/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="scripts/datatable/jquery.dataTables.override.css">
<link rel="stylesheet" type="text/css" href="scripts/datatable/buttons.dataTables.min.css">

<script type="text/javascript" src="scripts/datatable/jquery.dataTables-1.10.12.min.js"></script>
<script type="text/javascript" src="scripts/datatable/dataTables.buttons.min.js"></script>

<!--<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"></script>-->
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.3/js/buttons.colVis.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.3/js/buttons.print.min.js"></script>


<?php if($dbClass == 'household'){ ?> <script> var tbColsHide = {"dta0" :[-1,-2,-3,-4,-5,-6,-7,-8,-9,-10,-11,-12,-13,-14]}; </script> <?php }
elseif($dbClass == 'gender'){ ?> <script> var tbColsHide = {"dta0" :[-1,-2,-3,-4,-5,-6,-7]}; </script> <?php } ?>

<script type="text/javascript">
	
function resizeIframe(iframe) {
    iframe.height = iframe.contentWindow.document.body.scrollHeight + "px";
  }
	
jQuery(document).ready(function($)
{
	
	$(".rwdvalid").validate({errorContainer: ".errorBox" , errorPlacement: function(error, element) { } });
	
	if($('table.display').length){
		var table = $('#tb_gender').dataTable({
			"bProcessing": true, "bJQueryUI": true , "sPaginationType": "full_numbers" , "bStateSave": true, "iDisplayLength": 10 
			, "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
			, dom: 'Blfrtip'
			, buttons: [ 'print','csvHtml5', 
					<?php if($_SESSION['sess_lanet_account']['us_role'] == 1){ ?>	{
					text: '<i class="glyph-icon icon-file-excel-o"></i> Excel - Full Database',
					action: function ( e, dt, node, config ) { window.open('dtalanet/export.php?dta=<?php echo $dbClass; ?>', '_blank'); }},
					<?php } ?>	
					{ extend: 'colvis', text: 'Select Columns', postfixButtons: [ 'colvisRestore' ] }
				 ] 
			, columnDefs: [
				{ targets: tbColsHide.dta0, visible: false }
			]
		});
		
		
		var otable = $('#tb_household').dataTable( {
			"bProcessing": true, "bJQueryUI": true, "sPaginationType": "full_numbers", "bServerSide": true, "sAjaxSource": "dtalanet/household_ajx.php", "bStateSave": true, "iDisplayLength": 10	
			, dom: 'Blfrtip'
			//, dom: "B<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-4'i>><'row'p>"
			, buttons: [ 'print','csvHtml5', 
					<?php if($_SESSION['sess_lanet_account']['us_role'] == 1){ ?>	{
					text: '<i class="glyph-icon icon-file-excel-o"></i> Excel - Full Database',
					action: function ( e, dt, node, config ) { window.open('dtalanet/export.php?dta=<?php echo $dbClass; ?>', '_blank'); }},
					<?php } ?>							
					{ extend: 'colvis', text: 'Select Columns', postfixButtons: [ 'colvisRestore' ] }
				 ] 
			, columnDefs: [
				{ targets: tbColsHide.dta0, visible: false }
			]
		});
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
		
		
		
	});
}
</script>