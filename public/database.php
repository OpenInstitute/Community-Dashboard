<?php
include '../inc/conn.inc'; 
include '../inc/sessions.php'; 
$title = "Lanet Umoja Public Dashboard | Database";
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>
	<?php
	if(isset($title)){
		echo $title;
	} else {
		echo "Lanet Umoja Dashboard";
	}
	$colname = array();
	$typ = ($_GET['typ']=="") ? "col" : $_GET['typ'];
	$col0 = ($_GET['col'] == "") ? [] : $_GET['col'];
	//echo count($col0);
	if(count($col0)!=0){
		foreach($col0 as $explore) {
			$colname[] = $explore['value'];
		}
	} else {
		$colname=[];
	}
	//
	//$colname= [substr($coln, 0, -1)];
	$breadwinnername = stripslashes(str_replace ("&quot;", "\"", ($_GET['bw'])));
	$locale = $_GET['loc'];
	
	if($breadwinnername!=''){$val=$breadwinnername;}
	if($locale!=''){$val=$locale;}
	if(count($colname)==0){$val=$colname;}
    ?>

  </title>
 
  <link rel="apple-touch-icon" href="../assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../assets/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="../assets/css/site.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">

  <!-- Plugins -->
  <link rel="stylesheet" href="../assets/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="../assets/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="../assets/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="../assets/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="../assets/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="../assets/vendor/flag-icon-css/flag-icon.css">

  <!-- Plugins For This Page -->
  <link rel="stylesheet" href="../assets/vendor/chartist-js/chartist.css">
  <link rel="stylesheet" href="../assets/vendor/aspieprogress/asPieProgress.css">
  <link rel="stylesheet" href="../assets/css/site.css">
  <!-- Page -->
  <link rel="stylesheet" href="../assets/css/datatable.css">
  <link rel="stylesheet" href="../assets/css/site.min.css">
  <link rel="stylesheet" href="../assets/css/skintools.min.css">


  <!-- Fonts -->
  <link rel="stylesheet" href="../assets/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="../assets/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  <!--[if lt IE 9]>
    <script src="../assets/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

  <!--[if lt IE 10]>
    <script src="../assets/vendor/media-match/media.match.min.js"></script>
    <script src="../assets/vendor/respond/respond.min.js"></script>
    <![endif]-->

  <!-- Scripts -->
  <script src="../assets/vendor/modernizr/modernizr.js"></script>
  <script src="../assets/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>
<body class="dashboard">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<?php include '../inc/public-top-bar.php'; ?>
<?php include '../inc/menu_h.php'; ?>


 <div class="page animsition">
<div class="container">
		<ul class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a class="active" href="#">Household List</a></li>
		</ul>	
  
	<div class="col-md-12">
      <div class="example-wrap">
        
        <!-- Dropdown menu -->
<div class="panel" data-collapsed="0" style="top:10px;"><!-- to apply shadow add class "panel-shadow" -->
    <!-- panel head -->
    <div class="panel-heading" style="display: none;" id="TableList">
      <form method="get" action="">
        <div class="panel-title col-md-10">
          <select class="selectpicker btn btn-color btn-default col-md-12" name="loc" id="area">
            <option value="">All Sub Locations</option>
          <?php
            $sql = "SELECT location FROM  sublocations";
            $result = mysqli_query($conn, $sql);
            while ($data = mysqli_fetch_array($result)) {
              if($locale == $data['location']){ $sel='selected'; }
                echo "<option value='".$data['location']."' ". $sel ."> ". $data['location'] ."</option>";
                $sel='';
            }
          ?>
          </select>
        </div>
        <div class="panel-title col-md-2">
       <input type='hidden' value="col" name="typ">
           <input type='submit' value="Submit">
        </div>
        <?php
       

$raw_row = array('bread_winner_role','bw_age','concat("xxx",SUBSTRING(bw_id,-5),"xx")','bw_reg_to_vote','bw_occupation','concat(SUBSTRING(bw_phone,1,3),"xxxxxx")','sub_location','property_livestock','property_farming','property_farming_other','property_house','property_sanitation_facility','property_source_drinking_water','house_facility_electricity','house_facility_sanitation','security_crime','bw_diseases','bw_health_facility','bw_health_facility_other','health_group_immunization','health_group_mosquito_nets','energy_power_source','energy_cooking_facilities');

$clean_row = array('Role In The Family','Age','ID Number','Registered Voter','Occupation','Phone Number','Location','Has Livestock?','Does Farming?','Farming Detail','House Type','Sanitation Facility','Source of Drinking Water?','Is Electricity Installed?','Is There Sanitation Facility?','Have There Been Any Crime?','Health Category','Visited Health Facility?','Which Health Facility?','Are Children Immunized?','Are Mosquito Nets Available?','What Is The Power Source','Energy Source For Cooking');
?>
        <div class="container">
          <div class="col-md-12">
        
<?php
//echo count($colname[0]);
if(count($colname)==0) { $colname=[1,2,3,4,5,6,7];}

  for($i=0; $i< count($clean_row); $i++){
    if(in_array($i,$colname)){$checked='checked';}
            echo '<input type="checkbox" '.$checked.' value='. $i .' name="col[]"><label>'. $clean_row[$i] .'</label>&nbsp;';
          $checked=''; 
    }
 //$colids=implode(",",$colname);
 
 $k= 'bread_winner_role';
 $t= '<th>No. </th><th>Role in the Family</th>';
 for($j=0; $j < count($colname); $j++){
   $l=$colname[$j];
   $k .= ','. $raw_row[$l];
   $t .= '<th>'. $clean_row[$l] .'</th>';
 }

?>
          </div>
        </div>
        
      </form>
    </div>
 
    <div class="panel-heading" style="display: none;" id="SearchForm">
      <form method="get" action="">
       <div class="container">         

      <div class="panel-title col-md-10">
        <input class="btn btn-color btn-default col-md-12" name="bw" id="breadwinner"/>
      </div>
      <div class="panel-title col-md-2">
         <input type='hidden' value="bw" name="typ">
         <input type='submit' value="Submit">
      </div>
      </div>
      </form>
    </div> 
  </div>
  <!--//End of dropdown menu -->
        <div class="example table-responsive">
          <table id="paged" class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
            <thead>
              <tr>
                <?php echo $t; ?>
              </tr>
            </thead>
            <tbody>
            
<?php
$start=0;
$limit=50;
 
if(isset($_GET['page']))
{
    $page=$_GET['page'];
    $start=($page-1)*$limit;
}
else{
    $id=1;
}
	if (($locale == "") && ($breadwinnername == "")) {
          $subloc = "";
        } 
        elseif (($locale != "") && ($breadwinnername == "")) {
          $subloc = " WHERE location ='". $locale ."'" ;
        }
        elseif (($locale == "") && ($breadwinnername != "")) {
          $subloc = " WHERE MATCH(bread_winner_name) AGAINST('$breadwinnername' IN BOOLEAN MODE)";
        }
//Fetch from database first 10 items which is its limit. For that when page open you can see first 10 items.
$query=mysqli_query($conn,"SELECT id, $k FROM households $subloc ORDER BY bread_winner_name AND bread_winner_name !=''  LIMIT $start, $limit");


			//print 10 items
			while($result=mysqli_fetch_array($query))
			{
			   $z++;
      ?>
              <tr>
                <td><?php echo $z; ?></td>
                <td><?php echo $result['bread_winner_role']; ?></td>
                <?php  
                for($j=0; $j < count($colname); $j++){
				  $col_=$colname[$j];
				  echo '<td>'. $result[$raw_row[$col_]] .'</td>';
				}
				?>
              </tr>
       <?php } ?>
              
            </tbody>
        </table>
          <div>
			<nav>
			  <ul class="pagination pagination-sm">
				
				  
				
<?php 


//fetch all the data from database.
$rows=mysqli_num_rows(mysqli_query($conn,"SELECT id, $k FROM households $subloc ORDER BY bread_winner_name"));
//calculate total page number for the given table in the database
$total=ceil($rows/$limit);
			if($page>1)
			{
			//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
				echo "<li ><a class='page-link' href='database.php?MID=". $_GET['MID'] ."&$typ=$val&page=1' aria-label='First'>First</a></li>";
			
				//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
				echo "<li class='page-item'><a class='page-link' href='database.php?MID=". $_GET['MID'] ."&$typ=$val&page=". ($page-1) ."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
			}

				$y=0;
				if ($page<11){ $p=$page;} else { $p = $page-10;}
				//show all the page link with page number. When click on these numbers go to particular page.
				for($i=$p;$i<=$total;$i++)
				{
					if($i==$page) { 
						echo '<li class="page-item active"><a class="page-link" href="#">'.$i.' <span class="sr-only">(current)</span></a></li>'; 
					} else {
						if($y==50) { break; }
						 echo "<li class='page-item'><a class='page-link' href='database.php?MID=". $_GET['MID'] ."&$typ=$val&page=". $i ."'>". $i ."</a></li>"; 
					}
					$y++;
				}

				if($page!=$total)
					{
						////Go to previous page to show next 10 items.
						echo "<li class='page-item'><a class='page-link' href='database.php?MID=". $_GET['MID']."&$typ=$val&page=". ($page+1) ."' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span>
						</a></li>";
					
					
					////Go to end page to sitems.
						echo "<li><a class='page-link' href='database.php?MID=". $_GET['MID']."&$typ=$val&page=". $total ."' aria-label='Last'>Last</a></li>";
					}
				?>
				
				
			  </ul>
			</nav>
		  </div>
		 
        </div>
      </div>
    </div>
</div>
<!--footer section-->
</div>

  <!-- Footer -->
 <?php include '../inc/footer.php'; ?>
 
  <!-- Core  -->
  <script src="../assets/vendor/jquery/jquery.js"></script>
  <script src="../assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="../assets/vendor/animsition/jquery.animsition.js"></script>
  <script src="../assets/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="../assets/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="../assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="../assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

  <!-- Plugins -->
  <script src="../assets/vendor/switchery/switchery.min.js"></script>
  <script src="../assets/vendor/intro-js/intro.js"></script>
  <script src="../assets/vendor/screenfull/screenfull.js"></script>
  <script src="../assets/vendor/slidepanel/jquery-slidePanel.js"></script>

  <!-- Plugins For This Page -->
  <script src="../assets/vendor/chartist-js/chartist.min.js"></script>
  <script src="../assets/vendor/gmaps/gmaps.js"></script>
  <script src="../assets/vendor/matchheight/jquery.matchHeight-min.js"></script>
  <script src="../assets/vendor/chart-js/Chart.js"></script>
  <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="../assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="../assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="../assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="../assets/vendor/asrange/jquery-asRange.min.js"></script>
  <script src="../assets/vendor/bootbox/bootbox.js"></script>

  <!-- Scripts -->
  <script src="../assets/js/core.js"></script>
  <script src="../assets/js/site.js"></script>
  <script src="../assets/js/skintools.min.js"></script>

  <script src="../assets/js/sections/menu.js"></script>
  <script src="../assets/js/sections/menubar.js"></script>
  <script src="../assets/js/sections/gridmenu.js"></script>
  <script src="../assets/js/sections/sidebar.js"></script>

  <script src="../assets/js/configs/config-colors.js"></script>
  <script src="../assets/js/configs/config-tour.js"></script>

  <script src="../assets/js/components/asscrollable.js"></script>
  <script src="../assets/js/components/animsition.js"></script>
  <script src="../assets/js/components/slidepanel.js"></script>
  <script src="../assets/js/components/switchery.js"></script>

  <!-- Scripts For This Page -->
  <script src="../assets/js/components/gmaps.js"></script>
  <script src="../assets/js/components/matchheight.js"></script>
 <script src="../assets/js/chartjs.js"></script>

<div class="site-skintools">
	<div class="site-skintools-inner">
		<div class="site-skintools-toggle">
			<i class="icon wb-settings primary-600"></i>
		</div>
		<div class="site-skintools-content">
			<div class="nav-tabs-horizontal">
				<ul role="tablist" data-plugin="nav-tabs" class="nav nav-tabs nav-tabs-line">
					<li role="presentation" class="active">
						<a role="tab" aria-controls="skintoolsList" href="#skintoolsList" data-toggle="tab" aria-expanded="true">List</a>
					</li>
					<li role="presentation" class="">
						<a role="tab" aria-controls="skintoolsNavbar" href="#skintoolsSearch" data-toggle="tab" aria-expanded="false">Search</a>
					</li>
					<li role="presentation" class="">
						<a role="tab" aria-controls="skintoolsPrimary" href="#skintoolsPrint" data-toggle="tab" aria-expanded="false">Print</a>
					</li>
				</ul>
				<div class="tab-content">

				</div>
			</div>
		</div>
	</div>
</div>



</body>

</html>
