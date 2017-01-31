<?php require_once('classes/conn.inc');
    //if(!isset($_SESSION['user_session'])){ header("location: login.php"); }
	//if($_SESSION['RoleId'] <> 1) { header("location: index.php"); }
 ?>
<!DOCTYPE html> 
<html  lang="en"> 
<head>
<meta charset="utf-8">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Service Register</title>

<link rel="shortcut icon" href="images/favicon.ico" type="image/ico" />	
<link rel="stylesheet" type="text/css" href="scripts/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styes/default.css">
<link rel="stylesheet" type="text/css" href="styes/tile-box.css">
<link rel="stylesheet" type="text/css" href="styes/colors.css">
<link rel="stylesheet" type="text/css" href="styes/sr_custom.css">

<link rel="stylesheet" type="text/css" href="styes/base_overrides.css">

<script type="text/javascript" src="scripts/jquery-1.12.3.js"></script> 
		
</head>

<body>


    <div id="page-wrapper">
  <!-- Top bar here -->
  <?php //include 'inc/topbar.php'; ?>
    <div id="page-sidebar">
    <div class="scroll-sidebar">
        <?php //include 'inc/menu.php'; ?>
    </div>
    </div>
        <div id="page-content-wrapper">
            <div id="page-content">   
                    <div ng-view></div>
                    <!-- Everything that appears on the website goes here -->
                        <div class="panel col-md-12">
                            <div class=" top col-md-12">
                                <center><h3>Chief's Service Register</h3></center>
                                    <ul class="top nav nav-tabs" id="srTabs">
									
                                      <li class="col-md-3 active"><a data-toggle="tab" id="nv_reports" href="#reports">Reports</a></li>
									  <li class="col-md-3"><a data-toggle="tab" id="nv_search" href="#search"> Search</a></li>
									  <li class="col-md-3"><a data-toggle="tab" id="nv_apply" href="#apply">Apply</a></li>
									  
                                    </ul>

                                    <div class="top tab-content">
                                      
									  <div id="reports" class="tab-pane fade in active">
                                        <div id="report" >
                                        <center>
                                            <h3>Report</h3>
                                            <div class="col-md-offset-9 col-md-3">Date: <?php echo date("d-M-Y"); ?></div>
                                            <p>Report for Chief's Service Register</p> 
                                            <?php include 'includes/reports.php'; ?>
                                        </center>
                                        </div> 
                                      </div>
                                    
									
									  <div id="search" class="tab-pane fade">
                                        <center>
                                            <h3>Search</h3>
                                            <p>Search for Names, Cases in the service register</p>
                                        </center>
                                           <?php include("includes/sr_list_register.php"); ?>
                                      </div>
									  
									  
									  <div id="apply" class="tab-pane fade">                                        
                                        <div class="col-md-10 col-md-offset-2X">
                                            <?php include("includes/frm_serviceregister.php"); ?>
                                        </div>                                        
                                      </div>
									  
									  
                                     
                                      
									
									</div>
                               
                            </div>
                        </div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
    <!-- WIDGETS -->
<script type="text/javascript">
$(".bReport").click(function(){

    /*var k = $(this).attr("name");
    $.ajax({url: "includes/sr_ajax.php?param="+k, success: function(result){
        $("#report").html(result);
    }});*/
});
</script>
<script type="text/javascript" src="scripts/bootstrap/js/bootstrap.min.js"></script>



<?php include("_scripts.php"); ?>


</body>
</html>
