jQuery.noConflict();




jQuery(document).ready(function ($) {
	
	var token = Math.random();

	/*//GENERAL*/
	$('a[href^="out.php"], a[href^="http://"], a[href^="https://"], a[href^="mailto:"], a[href^="tel:"]').attr({ target: "_blank" });	
	
	
	/* @@ equal height */
	if($('div.equalized').length){ boxEqualHeight('equalized'); }
	if($('div.equalizedb').length){ boxEqualHeight('equalizedb'); }
	//if($('div.equalfoot').length){ boxEqualHeight('equalfoot'); }
	
	
	
	/* ============= @@ forms ======================== */
	
	
	$('label.required').append('<span class="rq"> *</span>');	
	
	
	if($('.iframe_call').length){
		var iFrame = $('.iframe_call');
		iFrame.bind('load', function() { 
			var ifrmHeight = iFrame.contents().find(".frameguts").height()+15;
			iFrame.height(ifrmHeight);
		}); 
	}
	
	
    var pathname = window.location.href.split('#')[0];
    $('a[href^="#"]').each(function() {
        var $this = $(this); var alink = $this.attr('href'); $this.attr('href', pathname + alink);
    });
});






function boxEqualHeight(target) {
	jQuery(document).ready(function($) {
		if($("div."+target).length){ 
			var maxHeight = 0;
			$("div."+target).each(function(){ if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }	});
			$("div."+target).height(maxHeight);	
		}
	});	
}

function doAccordion() {
	jQuery(document).ready(function($) {
			
		$('.accordion-box div.accordion-content').hide(); 
		
		$('.accordion-box div.accordion-header a').click(function(){
			if($(this).parent().hasClass('accordion-header-active'))
			{
				$(this).parent().removeClass("accordion-header-active");
				$(this).parent().next().removeClass("accordion-content-active");
				$(this).parent().next().slideUp();
			}
			else
			{
				$(this).parent().addClass("accordion-header-active");
				$(this).parent().next().addClass("accordion-content-active");
				$(this).parent().next().slideDown();
			}
			return false;
		});
		
		$('.accordion-box').prepend('<div class="accd-com"><a class="accd-show">Expand All</a> | <a class="accd-close">Collapse All</a></div>');
		
		$('.accordion-box a.accd-close').click(function(e){
			var kids = $(e.target).parent().parent().attr("id"); 		
			$("#"+kids+" > div.accordion-content").slideUp();
			$("#"+kids+" > div.accordion-header").removeClass("accordion-header-active");
			$("#"+kids+" > div.accordion-content").removeClass("accordion-content-active");							
		});
		
		$('.accordion-box a.accd-show').click(function(e){
			var kids = $(e.target).parent().parent().attr("id"); 			
			$("#"+kids+" > div.accordion-content").slideDown();
			$("#"+kids+" > div.accordion-header").addClass("accordion-header-active");
			$("#"+kids+" > div.accordion-content").addClass("accordion-content-active");							
		});
	});	
}

function doImageDisplays() {
	jQuery(document).ready(function($) {
		
		
		/*//IMAGE FUNCTIONS*/
		if( $('div.page-bits img').length ){ $('div.page-bits img').wrap($("<span class='bitChopaTiny'>")); }
		if( $('div.news-bits img').length ){ $('div.news-bits img').wrap($("<span class='listChopa'>")); }
		
		if( $('div.eq33_cols img').length ){ $('div.eq33_cols img').wrap($("<span class='bitChopa'>")); }
		if( $('div.home-bits img').length ){ $('div.home-bits img').wrap($("<span class='listChopa'>")); }	
		if( $('div.long-bits img').length ){ $('div.long-bits img').wrap($("<span class='bitChopa'>")); }	
		
		if( $('div.main-guts img').length ) {
			$('div.main-guts').addCaptions();
			var fncytitle;
			$('div.main-guts img').not(".midSize").each(function () {
				fncytitle = "E-platform";
				if ( $(this).attr("title") !== undefined ) { fncytitle = $(this).attr("title"); }
				$(this).wrap($('<div class="gutChopa"><a href="'+$(this).attr("src")+'" class="fncy" title="'+fncytitle+'">'));
			});
		}
	
		if( jQuery('.bitChopaWrap').length ){ jQuery('.bitChopaWrap').show(); 	
			if( jQuery('.menu-column').length ){ jQuery('.menu-column .carChopa').addClass("menuborder").show(); } }	
		if( jQuery('.bitChopa').length ){ jQuery('.bitChopa').show(); }
		//if( jQuery('.gutChopa').length ){ jQuery('.gutChopa').show(); }
		if( jQuery('div.main-guts img').length ) { jQuery('div.main-guts img').show(); }
		
	});	
}




/*//DYNAMIC LOADERS BASE*/
jQuery(document).ready(function($){ 
	jQuery.cachedScript = function( url, options ) { 
	  options = $.extend( options || {}, { dataType: "script", cache: true, url: url }); 
	  return jQuery.ajax( options );
	};	
});

function loadcssfile(filename){  
  var fileref=document.createElement("link");
  fileref.setAttribute("rel", "stylesheet");
  fileref.setAttribute("type", "text/css");
  fileref.setAttribute("href", filename) ;
  //if (typeof fileref!="undefined") document.getElementsByTagName("head")[0].appendChild(fileref)
  if (typeof fileref!="undefined") { document.getElementById("dynaScript").appendChild(fileref); }
}

function loadjsfile(filename){
  var fileref=document.createElement('script');
  fileref.setAttribute("type","text/javascript");
  fileref.setAttribute("src", filename); 
 if (typeof fileref!="undefined") { document.getElementById("dynaScript").appendChild(fileref); }
}





/*// DYNAMIC LOADERS ACTUAL */
jQuery(document).ready(function($){ 
	
	
	//if (!$.isFunction($.fn.<functionName>) ) { <functionCall>(); }
	
	/*//INLINE TABS*/
	if( $('.tabs-nav li').length ) { 
		$.cachedScript( "scripts/misc/cust.tabsnav.js" ).done(function( script, textStatus ) { /*tabsInit();*/ });
	}
	
	/*//JSCRIPT TRUNCATE/EXPAND*/
	if($('[class^="trunc"]').length) {
	  $.cachedScript( "scripts/misc/jquery.truncator.js" ).done(function( script, textStatus ) { 
		$('.trunc400').show().truncate({max_length: 250});
		$('.trunc1200').show().truncate({max_length: 100});
	  });
	}
	
	/*//DATA TABLE*/
	  zul_DataTable();
	
	
	/*//DATE PICKER*/
	  zul_DatePick()
	
	/*//NANO SCROLLER*/
	  nanoScroll();
	
	/*//WYSIWYG*/
	  doWysiwyg();
	
	
	
	/*//MASKED INPUTS*/
	if( $('input[class*="mask_"]').length ) { 
	  $.cachedScript( "scripts/validate/jquery.inputmask.js" ).done(function( script, textStatus ) { 
		if( $('.mask_date').length ) { $('.mask_date').inputmask( 'mm/dd/yyyy' ); }
		if( $('.mask_time').length ) { $('.mask_time').inputmask( 'h:s t' ); }
		if( $('.mask_phone').length ) { $('.mask_phone').inputmask('+999 999 999999'); }
	  });
	}
	
	
	
	/*//MULTI SELECT*/
	doMultipleSelect();
	
	
	
	
	/*//INTERNATIONAL PHONE*/
	if( $('.intl_phone').length ) {
	  loadcssfile("scripts/intlphone/intlTelInput.css"); 
	  $.cachedScript("scripts/intlphone/intlTelInput.js" ).done(function( script, textStatus ) { 
			
			$(".intl_phone").intlTelInput({utilsScript: "scripts/intlphone/utils.js" });
			var intlCode = $(".intl_phone").intlTelInput("getSelectedCountryData").iso2;
			$(".country-list").on("click", function() {
			  intlCode = $(".intl_phone").intlTelInput("getSelectedCountryData").iso2; 
			});
			$(".intl_phone").on("blur", function() {
				$("input#intl_country").attr("value", intlCode);
			});			
	  });
	}
	
	
	
	/*//PAGED FORM*/
	if( $('form.form-paged').length ) { 
	  loadcssfile("scripts/formpager/formToWizard.css");
	  $.cachedScript("scripts/formpager/formToWizard.js" ).done(function( script, textStatus ) { 
	  	$("form.form-paged").formToWizard({ submitButton: 'frm_submit' })
	  });
	}
	
	
	/*//FLEXSLIDER*/
	//if( $('.flexslider').length ) { 
	if( $('#banner_flex, #banner_side').length ) { 
		
		loadcssfile("scripts/flex/jquery.flexslider.gallery.css");
		$.cachedScript( "scripts/flex/jquery.flexslider.js" ).done(function( script, textStatus ) {
			
			/* @home banner*/
			/*if( $('#flxslider').length ){ 
				$('#flxslider').flexslider({ controlNav: true, directionNav: true, slideshowSpeed: 10000 }); 
			}*/
			
			if( $('#banner_flex').length ) {
				$.get('includes/wrap_banner_flex.php').done(function(data) {
				  $('#banner_flex').html(data);
				  var getBanFlex = $('#flxslider').flexslider({ controlNav: true, directionNav: true, slideshowSpeed: 10000 }); 
				});
			}
			
			/* @home caroousel*/
			/*if( $('#flxcarousel').length ){
				$('#flxcarousel').flexslider({ animation: "slide", animationLoop: true, itemWidth: 530, itemMargin: 0, slideshowSpeed: 10000, maxItems: 1, controlNav: true, directionNav: false });
			}*/
			
			if( $('#banner_side').length ) {
				$.get('includes/wrap_banner_side_car.php').done(function(data) {
				  $('#banner_side').html(data);
				  var getBanSide = $('#flxcarousel').flexslider({ animation: "slide", animationLoop: true, itemWidth: 530, itemMargin: 0, slideshowSpeed: 10000, maxItems: 1, controlNav: true, directionNav: false });
				});
			}
			
			
			/* @content gallery*/
			if( $('.flexslideshow').length ){ 
				$('#carousel').flexslider({ animation: "slide",controlNav: false,animationLoop: false,slideshow: false,itemWidth: 100,itemMargin: 5,asNavFor: '#slider'      });
				$('#slider').flexslider({animation: "slide",controlNav: false,animationLoop: false,slideshow: false,sync: "#carousel",start: function(slider){ $('body').removeClass('loading'); }      });
				$('.flexslideshow').show(); 
			}
			
			
			/* @project gallery*/
			if( $('.vidfeed').length ){ 
				$('#vidfeed_carousel').flexslider({ animation: "slide", controlNav: false, animationLoop: false, slideshow: false, itemWidth: 75, itemMargin: 5, asNavFor: '#vidfeed_slider' });

$('#vidfeed_slider').flexslider({ animation: "slide", controlNav: false, animationLoop: false, slideshow: false, sync: "#vidfeed_carousel", start: function(slider){ $('body').removeClass('loading'); } });
				$('.vidfeed').show(); 
			}
			
			
			
			/* @carousels*/
			/*if( $('.flxcarousel').length ){
				$(' #flxcarousel_prog, #flxcarousel_news, #flxcarousel_event, #flxcarousel_forums').flexslider({
					animation: "slide", slideshowSpeed: 3000, maxItems: 2, directionNav: true
				});		
			}*/

		});
	}
	
});




function zul_DataTable() {
	jQuery(document).ready(function($) {		
		
	/*//DATA TABLE*/
	
		if( $('table.display').length ){ 

			loadcssfile("scripts/datatable/jquery.dataTables.css");
			loadcssfile("scripts/datatable/jquery.dataTables.override.css");
			$.cachedScript("scripts/datatable/stringMonthYear.js" ).done(function( script, textStatus ) {});
			//jquery.dataTables-1.9.1
			$.cachedScript( "scripts/datatable/jquery.dataTables-1.10.12.min.js" ).done(function( script, textStatus ) {
				//var oTable = 
				//alert(pageDir);
			$('table.display').dataTable({
				"bProcessing": true
				, "bJQueryUI": true
				, "sPaginationType": "full_numbers"
				, "bStateSave": true 
				, "iDisplayLength": 10 
				//, "ordering": false
				, "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
				, "footerCallback": function ( row, data, start, end, display ) {
					var api = this.api(),
						intVal = function (i) { return typeof i === 'string' ?    i.replace(/[, Rs]|(\.\d{2})/g,"")* 1 :    typeof i === 'number' ?    i : 0; }; 
				}
				, initComplete: function () {
					this.api().columns().every( function (i) {
						//member_allowance
						if(pageDir=='allowances' && i == 0 || pageDir=='allowances' && i == 1 || pageDir=='sitting_allowances' && i == 0 || pageDir=='sitting_allowances' && i == 1)
						{
						var column = this;
						var select = $('<select><option value=""></option></select>')
							.appendTo( $(column.footer()).empty() )
							.on( 'change', function () {
								var val = $.fn.dataTable.util.escapeRegex(
									$(this).val()
								);

								column
									.search( val ? '^'+val+'$' : '', true, false )
									.draw();
							} );

						column.data().unique().sort().each( function ( d, j ) {
							if(column.search() === '^'+d+'$'){
								select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
							} else {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							}
						} );
						}

					} );
				}


			});

				/*$("tfoot th").each( function ( i ) {
					if(i==2) {		
						this.innerHTML = fnCreateSelect( oTable.fnGetColumnData(i) );
						$('select', this).change( function () { oTable.fnFilter( $(this).val(), i ); } );
					}
				});*/
		
			});
		}
	});	
}


function zul_DatePick() {
	jQuery(document).ready(function($) {		
		
	if( $('.hasDatePicker, .timePick').length ) { 
		
	  $('#dynaScript').append('<div style="display: none;"><img id="calimg" src="scripts/datepick/calendar-green.gif" alt="Popup" class="triggerX padd5X"></div>');
	  //loadcssfile("scripts/datepick/jquery.timepicker.css");
	  loadcssfile("scripts/datepick/jquery.ui.timepicker.css");
	  loadcssfile("scripts/datepick/jquery.datepick.css");
	  $.cachedScript( "scripts/datepick/jquery.plugin.js" ).done(function( script, textStatus ) {});
	  //$.cachedScript( "scripts/datepick/jquery.timepicker.js" ).done(function( script, textStatus ) {});
	  $.cachedScript( "scripts/datepick/jquery.ui.timepicker.js" ).done(function( script, textStatus ) {});
	  $.cachedScript( "scripts/datepick/jquery.datepick.js" ).done(function( script, textStatus ) { 
		
		if( $('#date_start_imprest').length ) { 
			var f;
			$('#date_start_imprest').datepick({
				onSelect: function(dates) {
					imprest_date_end(dates);
					f = new Date(dates); 
				
				if( $('#date_due_imprest').length ) { 
					$('#date_due_imprest').live('click', function() {
						$(this).datepick('destroy').datepick({showOn:'focus', minDate: f}).focus();
					});
				}
			}});
		}
		
		if( $('.dateOne').length ) { 
			var f;
			$('.dateOne').datepick({
			onSelect: function(dates) { //alert(dates);
				f = new Date(dates); 
				
				if( $('.dateTwo').length ) { 
					$('.dateTwo').live('click', function() {
						$(this).datepick('destroy').datepick({showOn:'focus', minDate: f}).focus();
					});
				}
			}});
		}
		$('.hasDatePicker').datepick();
		//$('.hasTimePicker').timepicker({ 'timeFormat': 'H:i:s' });
		$('.timePick').timepicker({showPeriodLabels: false });
		
	  });
	}
		
	});	
}

function responsiveMenu() {	
  jQuery(document).ready(function($) {
	
	if( $("#search-bar").length ) {   	
		var wd = window.innerWidth; 
		if(wd < 901){ 
			var searchBox = $("#search-bar").clone().end().html(); 
			$(".canvas-search").html(searchBox);
		}
	}
  });	
}


function nanoScroll() {	
  /*jQuery(document).ready(function($) {
	  loadcssfile("scripts/scroll/jquery.nanoscroller.css");
	  $.cachedScript("scripts/scroll/jquery.nanoscroller.min.js" ).done(function( script, textStatus ) { 
		$(".nano").nanoScroller();
	  });
  });*/	
}


function doMultipleSelect(){
	jQuery(document).ready(function($){
		if( $('select.multiple').length ) { 
		  //loadcssfile("styles/smoothness/jquery-ui-1.8.4.custom.css");
		  loadcssfile("scripts/multiselect/jquery.multiselect.css");
		  $.cachedScript("scripts/multiselect/jquery.multiselect.filter.js" ).done(function( script, textStatus ) {});
		  $.cachedScript("scripts/multiselect/jquery.multiselect.js" ).done(function( script, textStatus ) { 
			$("select.multiple").multiselect(); 
		  });
		}
	});
}
	
function doWysiwyg(){
	jQuery(document).ready(function($){
		if( $('.wysiwyg').length ) { 
			loadcssfile("apps/jwysiwyg/jquery.wysiwyg.css");
			$.cachedScript( "apps/jwysiwyg/jquery.wysiwyg.js" ).done(function( script, textStatus ) {
				$('.wysiwyg').wysiwyg(); 
			});
		}
	});
}


function doPageTabs() {
	jQuery(document).ready(function($) 
	{
		var hash; 
		if($('#dept_nav li a.current').length === 0) 
		{ hash = $('#dept_nav li a:first').attr('data-id'); } else 
		{ hash = $('#dept_nav li a.current').attr('data-id'); }
		
		jQuery(".pgtabsloader").show();		
		
		var href = $('#dept_nav li a').each(function(){		
			var tabId = $(this).attr('data-id');	
			var token = Math.random();		
			if(hash === tabId){
				jQuery("#dept_nav li a").removeClass("active");
				jQuery(this).addClass("active");
				var tabUr = $(this).attr('data-url')+'&token='+token+' #content';
				jQuery(".pgtabscontent").load(tabUr, function(){ doAjaxPageStyling(); });
				jQuery(".pgtabsloader").hide();	
			}											
		});
		
		
		jQuery("#dept_nav li a").click(function()
		{	
			jQuery(".pgtabsloader").show();	
			var tabId = jQuery(this).attr("data-id");
			var token = Math.random();				
			jQuery("#dept_nav li a").removeClass("active");
			jQuery(this).addClass("active");		
			
			var tabUr = jQuery(this).attr('data-url')+'&token='+token+' #content';
			jQuery(".pgtabscontent").load(tabUr, function(){ doAjaxPageStyling(); });		
			jQuery(".pgtabsloader").hide();	
			return false;
		});
	
	});
}

function doAjaxPageLoad(tabWrapper, tabUrl, tabReq){
	jQuery(document).ready(function($){
		//$("#preloader").show();
		jQuery.ajax({
			type: 'GET',
			url: tabUrl, 
			cache: false,
			data: tabReq,
			dataType: 'html',
			beforeSend: function() { $(tabWrapper).html('loading...'); },
			success: function(response) { $(tabWrapper).html(response); doAjaxPageStyling(); }
		});
	});
}

function doAjaxPageStyling() {  /*alert('styling called');*/
	jQuery(document).ready(function($) {		
		boxEqualHeight('equalized'); 
		if( $('.accmenu').length )  {  $('.accmenu').initMenu(); }
		doImageDisplays();
		zul_DataTable();
		zul_DatePick();
		doFormsLock();
		doMultipleSelect();
		doWysiwyg();
		doFormsValidate();
	});
}


function doFeedTabs(sf_feed) {
	var sf_title = sf_feed;
	if(sf_title === undefined) { sf_title = 'sf_facebook'; }	
	
	jQuery(document).ready(function($) {
		if( $('#sf_social_media').length ) 
		{ 
		$(".tabsloader").show();
		
		var feed_twitter_script = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';	
	
		$("#feed_sf_twitter").html(feed_sf_twitter + feed_twitter_script);
		$("#feed_sf_facebook").append(feed_sf_facebook);
		
		$(".tabscontent .content:first").css("display", "block");
		$(".tabsloader").hide();	
		}
	});
}


function doFormsLock()
{
	jQuery(document).ready(function($){
		$(".frmnoborder :input").not(".btn").css({"border-width":"0px 0px 1px", "background":"none"});
		$(".frmnoborder :input").not(".btn").each(function(index) {
		   $(this).on("focusin", function(){ $(this).css({"background":"#fafafa"}); });
		   $(this).on("focusout", function(){ $(this).css({"background":"none"}); });
		});
		
		$(".frmNoEdit :input").prop("disabled", true).css({"border":"none", "background":"none", "border-bottom":"1px solid #efefef"});
		$(".frmNoEdit").prop("action", "#");
		$(".frmNoEdit").find(":submit, .hideable").css("display", "none");
	});
}


function doFormsValidate() { 
	jQuery(document).ready(function($) {		
				
		if($('.rwdvalid').length) 
		{   /* Multiselect - require one*/
			$.validator.addMethod("needsSelection", function (value, element) { var count = $(element).find('option:selected').length; return count > 0; });
			
			/* Multicheckbox - require one*/
			$.validator.addMethod("require-one", function (value, element) { return $('.require-one:checked').size() > 0; })
			
			/* WYSIWYG - required */
			$.validator.addMethod("wysi_required", function (value, element) { return $('.wysi-required').val() !== ''; })
			
			$(".rwdvalid").validate({errorContainer: ".errorBox" , errorPlacement: function(error, element) { } });
		}
	});
}


function doAjaxCheckAll() { 
	jQuery(document).ready(function($) {		
		if( $('#check_all').length )  { 
			$('#check_all').click(function() {
				var n = $('#check_all:checked').length; 
				if( n == 1) { $(":checkbox").attr("checked", true); } else { $(":checkbox").attr("checked", false); }
			});
		}
	});
}


function kbModalLoaded() {
	jQuery(document).ready(function($) {		
		
		$('a[href^="out.php"], a[href^="http://"], a[href^="https://"], a[href^="mailto:"]').attr({ target: "_blank" });	
		
		if( $('.modal-body').length ) { 
			var _self = $('.modal-body'); if (_self.outerHeight() > 400){  _self.addClass('modal-scroll'); }
		}
		if( $('.rwdvalid').length ) { 
			$(".rwdvalid").validate({errorPlacement: function(error, element) { }}); }
				
		if( $('#fm_showcase').length ) 	{
			var template = $.validator.format($("#party_filler").val());
			function addRow_ed() { if(j<10){ j= i++;  $(template(j)).appendTo("#party tbody"); } }
			function delRow_ed() { $(".tr_party_"+j).remove(); j= j-1; }
			var j = 1; 	var i = 1; 	addRow_ed(); 
			$("#add_party").click(addRow_ed); $("#del_party").click(delRow_ed); 
			
			$("#fm_showcase").validate({errorPlacement: function(error, element) { }});
		}
			
		zul_DatePick();
	
	});
}



jQuery(window).load(function () {   
	
	doImageDisplays();
	responsiveMenu();
	
	doFeedTabs();
	doPageTabs();
	
});

