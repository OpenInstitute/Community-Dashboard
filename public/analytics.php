<?php include '../inc/conn.inc'; 
include '../inc/sessions.php'; 
$title = "Lanet Umoja | Analytics";

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Admin Analytics">
  <meta name="author" content="Open Institute">

  <title>
    <?php
if(isset($title)){
    echo $title;
} else{
  echo "Lanet Umoja Dashboard";
}

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

  <!-- Page -->
  <link rel="stylesheet" href="../assets/css/datatable.css">
  <link rel="stylesheet" href="../assets/css/site.min.css">
   <link rel="stylesheet" href="../assets/css/site.css">

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
<?php include_once("../inc/analyticstracking.php") ?>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<?php include '../inc/public-top-bar.php'; ?>
<?php include '../inc/menu.php'; ?>
 <div class="page animsition">
<div class="container">

    <div class="page-content">
    <ul class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <?php
    $cat=(int)base64_decode($_GET['SMID']);
  
           if($cat!=0){
       $query_Contents2 = mysqli_query($conn,"select submenuname from submenu where submenuid = $cat");
       $Contents2 = mysqli_fetch_assoc($query_Contents2);
         ?>
          <li><a href="analytics_home.php">Analytics</a></li>
          <li><a class="active" href="#"><?php echo $Contents2['submenuname'];?></a></li>
          <?php } else {?>
          <li><a href="analytics_home.php">Analytics</a></li>
          <?php }?>
    </ul>
      <div class="panel">
        <div class="panel-body container-fluid">
       
          <div class="row row-lg">
     <?php
     $qry =  "SELECT * FROM households";
     $res1 = mysqli_query($conn,$qry);
     $totalRows = mysqli_num_rows($res1);

      $qry0 =  "SELECT * FROM household_members";
      $res2 = mysqli_query($conn,$qry0);
      $totalRows0 = mysqli_num_rows($res2);

    $sec = "SELECT * FROM households WHERE `security_crime`='no'";
    $res = mysqli_query($conn,$sec);
    $rows_no = mysqli_num_rows($res);
    $rows_yes = $totalRows - $rows_no;

    $percNo = number_format(($rows_no/$totalRows)*100 , 2);
    $percYes = 100 - $percNo;


    $health = "SELECT * FROM households WHERE `bw_health_facility`='no'";
    $resh = mysqli_query($conn,$health);
    $rows_noh = mysqli_num_rows($resh);
    $rows_yesh = $totalRows - $rows_noh;

    $percNoh = number_format(($rows_noh/$totalRows)*100, 2);
    $percYesh = 100 - $percNoh;

    $netQuery = "SELECT * FROM households WHERE `health_group_mosquito_nets`='no'";
    $netQ = mysqli_query($conn,$netQuery);
    $nets_no = mysqli_num_rows($netQ);
    $nets_yes = $totalRows - $nets_no;

    $percNetsNo = number_format(($nets_no/$totalRows)*100, 2);
    $percNetsYes = 100 - $percNetsNo;

    $livestockQuery = "SELECT * FROM households WHERE `property_livestock`='no'";
    $livestockQ = mysqli_query($conn,$livestockQuery);
    $livestock_no = mysqli_num_rows($livestockQ);
    $livestock_yes = $totalRows - $livestock_no;

    $percLivestockNo = number_format(($livestock_no/$totalRows)*100, 2);
    $percLivestockYes = 100 - $percLivestockNo;

    $elecQuery = "SELECT * FROM households WHERE `house_facility_electricity`='no'";
    $elecQ = mysqli_query($conn,$elecQuery);
    $elec_no = mysqli_num_rows($elecQ);
    $elec_yes = $totalRows - $elec_no;

    $percElecNo = number_format(($elec_no/$totalRows)*100, 2);
    $percElecYes = 100 - $percElecNo;

    $eduQuery = "SELECT * FROM `household_members` WHERE group_member_age <=18";
    $eduQ = mysqli_query($conn,$eduQuery);
    $eduAge = mysqli_num_rows($eduQ);
    $workAge = $totalRows0 - $eduAge;

    $percEduAge = number_format(($eduAge/$totalRows0)*100, 2);
    $percEduWork = 100 - $percEduAge;

    $farmerQ = "SELECT * FROM households WHERE `bw_occupation` LIKE '%Farm%'";
    $farmerQuery = mysqli_query($conn,$farmerQ);
    $noFarmers = mysqli_num_rows($farmerQuery);

    $farmingQuery = "SELECT * FROM households WHERE `property_farming`='yes'";
    $farmingQ = mysqli_query($conn,$farmingQuery);
    $farming_no = mysqli_num_rows($farmingQ);

    $waterbQuery = "SELECT * FROM `households` where `property_source_drinking_water` like '%borehole_well'";
    $waterbQ = mysqli_query($conn, $waterbQuery);
    $waterbNo = mysqli_num_rows($waterbQ);

    $waterpQuery = "SELECT * FROM `households` where `property_source_drinking_water` like '%piped_water'";
    $waterpQ = mysqli_query($conn, $waterpQuery);
    $waterpNo = mysqli_num_rows($waterpQ);

    $waterrQuery = "SELECT * FROM `households` where `property_source_drinking_water` like '%rain_water'";
    $waterrQ = mysqli_query($conn, $waterrQuery);
    $waterrNo = mysqli_num_rows($waterrQ);

    $waterdQuery = "SELECT * FROM `households` where `property_source_drinking_water` like '%Delivery%'";
    $waterdQ = mysqli_query($conn, $waterdQuery);
    $waterdNo = mysqli_num_rows($waterdQ);

    $watercQuery = "SELECT * FROM `households` where `property_source_drinking_water` like '%community'";
    $watercQ = mysqli_query($conn, $watercQuery);
    $watercNo = mysqli_num_rows($watercQ);

    $other = $totalRows - ($waterbNo+$watercNo+$waterpNo+$waterdNo);

    $percWb = number_format(($waterbNo/$totalRows)*100,2);
    $percWp = number_format(($waterpNo/$totalRows)*100,2);
    $percWr = number_format(($waterrNo/$totalRows)*100,2);
    $percWd = number_format(($waterdNo/$totalRows)*100,2);
    $percWc = number_format(($watercNo/$totalRows)*100,2);
    $percOther = number_format(($other/$totalRows)*100,2);

    $ecdQuery = mysqli_query($conn, "SELECT * FROM `households` where `bw_other_ecd` > 0");
    $ecd = mysqli_num_rows($ecdQuery);

     $cat=base64_decode($_GET['SMID']);
     
     if ($cat==3){
      ?>
      <div class="row">
        <?php include '../inc/healthcard.php'; ?>
      </div>
      <!-- Panel -->
            <div class="col-md-6 col-lg-6">
                  <h4>Number of People who visited a Health Facility</h4>
                  <p>Question: Have you visited a health facility in the last year?</p>
                  <div id="health"></div>
            </div>
            <div class="col-md-6 col-lg-6">
               <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
                    <thead>
                      <tr>
                      <th>Percentage</th>
                      <th>Yes/No</th>
                      <th>Meaning(Click to reveal table)</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo  $percYesh."%"; ?></td>
                        <td>Yes</td>
                        <td><a href="javascript:void()" id="yes">Households that have visited a health facility</a></td>
                      </tr>
                      <tr>
                        <td><?php echo  $percNoh."%"; ?></td>
                        <td>No</td>
                        <td><a href="javascript:void()" id="no"> Households that have not visited a health facility</td>
                      </tr>
                      </tbody>
              </table>
            </div>
            <div class="col-md-12 col-lg-12">
              <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrTable">
                    <thead>
                      <tr><td colspan="4"><center><strong>Households that have visited a health facility</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        $sql10 =  "SELECT * FROM households WHERE `bw_health_facility`='yes'";
                        $cont10 = mysqli_query($conn,$sql10) or die();
                        $totalRows_Contents0 = mysqli_num_rows($cont10);
                         
                      while($contact10 = mysqli_fetch_array($cont10)){ ?>
                      <tr>
                        
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo substr($contact10['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>

                      </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrnTable">

                    <thead>
                     <tr><td colspan="4"><center><strong>Households that have not visited a health facility</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql11 =  "SELECT * FROM households WHERE `bw_health_facility`='no'";
                        $cont11 = mysqli_query($conn,$sql11) or die();
                          
                      while($contact11 = mysqli_fetch_array($cont11)){ ?>
                      <tr>
                        
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo substr($contact11['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>
            </div>

            <div class="col-md-6 col-lg-6">
                 <h4>Number of Households with Mosquito nets</h4>
                 <p>Question: Do you have mosquito nets in your household??</p>
                 <div id="healthNets"></div>
            </div>
            <div class="col-md-6 col-lg-6">
                 <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
                    <thead>
                      <tr>
                      
                      <th>Percentage</th>
                      <th>Yes/No</th>
                      <th>Meaning(Click to reveal table)</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $percElecYes."%"; ?></td>
                        <td>Yes</td>
                        <td><a href="javascript:void()" id="yes2">Households with Mosquito Nets</a></td>
                      </tr>
                      <tr>
                        <td><?php echo $percElecNo."%"; ?></td>
                        <td>No</td>
                        <td><a href="javascript:void()" id="no2"> Households without Mosquito Nets</td>
                      </tr>
                    </tbody>
              </table>
              </div>
               <div class="col-md-12 col-lg-12">
              <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agr2Table">
                    <thead>
                      <tr><td colspan="4"><center><strong>Households with Mosquito Nets</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        $sql10 =  "SELECT * FROM households WHERE `health_group_mosquito_nets`='yes'";
                        $cont10 = mysqli_query($conn,$sql10) or die();
                       
                         
                      while($contact10 = mysqli_fetch_array($cont10)){ ?>
                      <tr>
                       
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo "0".substr($contact10['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                                } ?>
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                      </table>
              <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrn2Table">
                    <thead>
                      <tr><td colspan="4"><center><strong>Households without Mosquito Nets</strong></center></td></tr>
                      <tr>
                     
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        $sql10 =  "SELECT * FROM households WHERE `health_group_mosquito_nets`='no'";
                        $cont10 = mysqli_query($conn,$sql10) or die();
                       
                         
                      while($contact10 = mysqli_fetch_array($cont10)){ ?>
                      <tr>
                        
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo "0".substr($contact10['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                                } ?>
                        </td>
                      </tr>
                      <?php } ?>
                      </tbody>
                      </table>

            <?php } ?>

            <?php
            if($cat == 1){
              ?>
               <!--Agriculture-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Agriculture</h1>
            </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <?php include '../inc/agriculturecard.php'; ?>
            </div>
        <!--end of Agriculture-->
              <div class="col-md-6 col-lg-6">
                  <h4>Livestock: Number of households keeping livestock</h4>
                  <p>Question: Do you keep livestock in your household?</p>
                  <div id="livestock" ></div>
              </div>

              <div class="col-md-6 col-lg-6">

               <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
                    <thead>
                      <tr>
                      
                      <th>Percentage</th>
                      <th>Yes/No</th>
                      <th>Meaning(Click to reveal table)</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $percLivestockYes."%"; ?></td>
                        <td>Yes</td>
                        <td><a href="#agrtbl" id="yes">Households with livestock</a></td>
                      </tr>
                      <tr>
                        <td><?php echo $percLivestockNo."%"; ?></td>
                        <td>No</td>
                        <td><a href="#agrntbl" id="no"> Households without livestock</td>
                      </tr>

                     
                    
                      </tbody>
              </table>


              </div>
              <a id="agrtbl"></a>
              <a id="agrntbl"></a>
              <div class="col-md-12 col-lg-12">
              <a id="agrtbl"></a>
                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrTable">
                    <thead>
                      <tr><td colspan="4"><center><strong>Residents with Livestock</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        $sql10 = "SELECT * FROM households WHERE property_livestock = 'yes'";
                        $cont10 = mysqli_query($conn,$sql10) or die();
                        $totalRows_Contents0 = mysqli_num_rows($cont10);
                         
                      while($contact10 = mysqli_fetch_array($cont10)){ ?>
                      <tr>
                        
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo substr($contact10['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrnTable">
                    
                    <thead>
                     <tr><td colspan="4"><center><strong>Residents without Livestock</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql11 = "SELECT * FROM households WHERE property_livestock = 'no'";
                        $cont11 = mysqli_query($conn,$sql11) or die();
                          
                      while($contact11 = mysqli_fetch_array($cont11)){ ?>
                      <tr>
                        
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo substr($contact11['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>
     
              </div>
            <?php } ?>
            <?php 
           if($cat == 4){
            ?>
              <div class="row">
                <?php include '../inc/securitycard.php'; ?>
              </div>
              <div class="col-md-6 col-lg-6">
                  <h4>Security: Insecurity Incidences</h4>
                  <p>Question: Have you been affected by crime in the last year?</p>
                  <div id="security" ></div>
              </div>
              <div class="col-md-6 col-lg-6">
                  <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
                    <thead>
                      <tr>
                      
                      <th>Percentage</th>
                      <th>Yes/No</th>
                      <th>Meaning(Click to reveal table)</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $percYes."%"; ?></td>
                        <td>Yes</td>
                        <td><a href="javascript:void()" id="yes">Households affected by insecurity/crime</a></td>
                      </tr>
                      <tr>
                        <td><?php echo $percNo."%"; ?></td>
                        <td>No</td>
                        <td><a href="javascript:void()" id="no"> Households not affected by insecurity/crime</td>
                      </tr>

                     
                    
                      </tbody>
              </table>
              </div>
              <div class="col-md-12 col-lg-12">
              <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrTable">
                    <thead>
                      <tr><td colspan="4"><center><strong>Households affected by insecurity/crime</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        $sql10 =  "SELECT * FROM households WHERE `security_crime`='yes'";
                        $cont10 = mysqli_query($conn,$sql10) or die();
                        $totalRows_Contents0 = mysqli_num_rows($cont10);
                         
                      while($contact10 = mysqli_fetch_array($cont10)){ ?>
                      <tr>
                       
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo substr($contact10['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrnTable">

                    <thead>
                     <tr><td colspan="4"><center><strong> Households not affected by insecurity/crime</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql11 =  "SELECT * FROM households WHERE `security_crime`='no'";
                        $cont11 = mysqli_query($conn,$sql11) or die();
                          
                      while($contact11 = mysqli_fetch_array($cont11)){ ?>
                      <tr>
                        
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo substr($contact11['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>
            </div>
           <?php } 
           
           if($cat == 2){
            ?>
            <div class="row">
              <?php include '../inc/educationcard.php'; ?>
            </div>
            <div class="col-md-6 col-lg-6">
              <h4>Education: Percentage of Household Members in School</h4>
                <p> Working Age to School going age Household Members</p>
                <div id="education"></div>
              </div>
              <div class="col-md-6 col-lg-6">
                
              </div>
           <?php } 
           
           if($cat == 5){
            ?>
            <div class="row">
              <?php include '../inc/energycard.php'; ?>
            </div>
            <div class="col-md-6 col-lg-6">
                <h4>Number of Households with Electricity</h4>
                <p>Question: Do you have electricity in your household?</p>
                <div id="energy"></div>
            </div>
              <div class="col-md-6 col-lg-6">
                 <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
                    <thead>
                      <tr>
                      
                      <th>Percentage</th>
                      <th>Yes/No</th>
                      <th>Meaning(Click to reveal table)</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo $percElecYes."%"; ?></td>
                        <td>Yes</td>
                        <td><a href="javascript:void()" id="yes">Households with Electricity</a></td>
                      </tr>
                      <tr>
                        <td><?php echo $percElecNo."%"; ?></td>
                        <td>No</td>
                        <td><a href="javascript:void()" id="no"> Households without Electricity</td>
                      </tr>

                     
                    
                      </tbody>
              </table>
              </div>
               <div class="col-md-12 col-lg-12">
              <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrTable">
                    <thead>
                      <tr><td colspan="4"><center><strong>Households with Electricity</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php
                        $sql10 =  "SELECT * FROM households WHERE `house_facility_electricity`='yes'";
                        $cont10 = mysqli_query($conn,$sql10) or die();
                        $totalRows_Contents0 = mysqli_num_rows($cont10);
                         
                      while($contact10 = mysqli_fetch_array($cont10)){ ?>
                      <tr>
                        
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo substr($contact10['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="agrnTable">

                    <thead>
                     <tr><td colspan="4"><center><strong>Households without Electricity</strong></center></td></tr>
                      <tr>
                      
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php

                        $sql11 =  "SELECT * FROM households WHERE `house_facility_electricity`='no'";
                        $cont11 = mysqli_query($conn,$sql11) or die();
                          
                      while($contact11 = mysqli_fetch_array($cont11)){ ?>
                      <tr>
                        
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo substr($contact11['bw_phone'], 0, 3) . 'xxxxxx';
                              }else{
                                echo "";
                              } ?>
                        </td>
                      </tr>
                    <?php
                      }
                        
                    ?>
                      </tbody>
                    </table>
            </div>
           <?php } 
           
           if($cat == 6){
            ?>
            <!-- water and sanitation-->
            <!--water and sanitation cards-->
            <div class="row">
            <?php include '../inc/watercard.php'; ?>
            </div>
            <!-- end of water and sanitation cards -->
                                  <!--water-->
            <div class="col-md-12 col-lg-12 height center">
              <h4>Source of Drinking/Washing water</h4>
              <p>Where do you get drinking/Washing water?</p>
            </div>
            <div class="col-md-6 col-lg-6 topspace">
              <div id="drinkWater"></div>
            </div>
            <div class="col-md-6 col-lg-6 topspace">
                 <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
                    <thead>
                      <tr>
                     
                      <th>Percentage</th>
                      <th>Source</th>
                      <th>Click to View Table</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                     
                        <td><?php echo $percWd."%"; ?></td>
                        <td>Delivery</td>
                        <td><a href="javascript:void()" id="delivery">Water Delivery</a></td>
                      </tr>
                      <tr>
                        <td><?php echo $percWp."%"; ?></td>
                        <td>Piped Water</td>
                        <td><a href="javascript:void()" id="piped"> Piped Water</td>
                      </tr>
                      <tr>
                        <td><?php echo $percWr."%"; ?></td>
                        <td>Rain Water</td>
                        <td><a href="javascript:void()" id="rain"> Rain Water</td>
                      </tr>
                      <tr>
                        <td><?php echo $percWb."%"; ?></td>
                        <td>Borehole/Well water</td>
                        <td><a href="javascript:void()" id="borehole"> Borehole/ Well Water</td>
                      </tr>
                      <tr>
                        <td><?php echo $percWc."%"; ?></td>
                        <td>Community Water</td>
                        <td><a href="javascript:void()" id="community"> Community Water</td>
                      </tr>
                    </tbody>
                 </table>
              </div>
              <div class="col-md-12 col-lg-12 height">
                <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="dlvry">
                    <thead>
                      <tr><td colspan="6"><center><strong>Households Drinking Water Source (Delvery)</strong></center></td></tr>
                      <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      <th>Source</th>

                      </tr>
                    </thead>
                    <tbody>
                     <?php
                      $i = 1;                     
                      while($contact10 = mysqli_fetch_array($waterdQ)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a href='map.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(($contact10['bw_phone']) !== 00){
                              echo $contact10['bw_phone'];
                              }else{
                                echo "";
                                } ?>
                        </td>
                        <td><?php echo $contact10['property_source_drinking_water']; ?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                  </table>

                  <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="ppd">
                    <thead>
                      <tr><td colspan="6"><center><strong>Households Drinking Water Source (Piped Water)</strong></center></td></tr>
                      <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      <th>Source</th>

                      </tr>
                    </thead>
                    <tbody>
                     <?php
                      $i = 1;                     
                      while($contact10 = mysqli_fetch_array($waterpQ)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a href='map.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(($contact10['bw_phone']) !== 00){
                              echo $contact10['bw_phone'];
                              }else{
                                echo "";
                                } ?>
                        </td>
                        <td><?php echo $contact10['property_source_drinking_water']; ?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="rn">
                    <thead>
                      <tr><td colspan="6"><center><strong>Households Drinking Water Source(Rain Water)</strong></center></td></tr>
                      <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      <th>Source</th>

                      </tr>
                    </thead>
                    <tbody>
                     <?php
                      $i = 1;                         
                      while($contact10 = mysqli_fetch_array($waterrQ)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a href='map.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(($contact10['bw_phone']) !== 0){
                              echo $contact10['bw_phone'];
                              }else{
                                echo "";
                                } ?>
                        </td>
                        <td><?php echo $contact10['property_source_drinking_water']; ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="cmnty">
                    <thead>
                      <tr><td colspan="6"><center><strong>Households Drinking Water Source (Community Water)</strong></center></td></tr>
                      <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      <th>Source</th>

                      </tr>
                    </thead>
                    <tbody>
                     <?php
                      $i = 1;                     
                      while($contact10 = mysqli_fetch_array($watercQ)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a href='map.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(($contact10['bw_phone']) !== 0){
                              echo $contact10['bw_phone'];
                              }else{
                                echo "";
                                } ?>
                        </td>
                        <td><?php echo $contact10['property_source_drinking_water']; ?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>

                    <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable" id="bhole">
                    <thead>
                      <tr><td colspan="6"><center><strong>Households Drinking Water Source (Borehole Water)</strong></center></td></tr>
                      <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Breadwinner Role</th>
                      <th>Location</th>
                      <th>Phone Number</th>
                      <th>Source</th>

                      </tr>
                    </thead>
                    <tbody>
                     <?php
                      $i = 1;                       
                      while($contact10 = mysqli_fetch_array($waterbQ)){ ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a href='map.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(($contact10['bw_phone']) !== 0){
                              echo $contact10['bw_phone'];
                              }else{
                                echo "";
                                } ?>
                        </td>
                        <td><?php echo $contact10['property_source_drinking_water']; ?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                      </table>
                </div>
              
                <div class="clearfix line"></div>
                      <!--water-->
            <!-- end of water and sanitation -->
            <?php } ?>       
                        
          </div>
        </div>
      </div>
      <!-- End Panel -->
    </div>
  </div>
  <!-- End Page -->
    

</div>

  <!-- Footer -->
 <?php include '../inc/footer.php'; ?>

  <!-- Core  -->
  <script src="../assets/vendor/jquery/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
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
  <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="../assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="../assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="../assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="../assets/vendor/asrange/jquery-asRange.min.js"></script>
  <script src="../assets/vendor/bootbox/bootbox.js"></script>




  <script src="../assets/vendor/raphael/raphael-min.js"></script>
  <script src="../assets/vendor/morris-js/morris.min.js"></script>

  <!-- Scripts -->
  <script src="../assets/js/core.js"></script>
  <script src="../assets/js/site.js"></script>

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





<script>

    $(document).ready(function () {

  (function() {
    <?php
           if($cat == 3){
            ?>
    Morris.Donut({
      element: 'health',
      data: [{
        label: "Visited Health Facility(%)",
        value: <?php echo $percYesh; ?>
      }, {
        label: "Did Not Visit Health Facility(%)",
        value: <?php echo $percNoh; ?>
      },
      ],
      // barSizeRatio: 0.35,
      resize: true,
      colors: [$.colors("blue", 500), $.colors("red", 500)]
    });

    Morris.Donut({
      element: 'healthNets',
      data: [{
        label: "Households with Mosquito Nets(%)",
        value: <?php echo $percNetsYes; ?>
      }, {
        label: "Households without Mosquito Nets (%)",
        value: <?php echo $percNetsNo; ?>
      }
      ],
      // barSizeRatio: 0.35,
      resize: true,
      colors: [$.colors("blue", 500), $.colors("red", 300)]
    });
<?php }
           if($cat == 1){
     ?>
    Morris.Donut({
      element: 'livestock',
      data: [{
        label: "Households with Livestock(%)",
        value: <?php echo $percLivestockYes; ?>
      }, {
        label: "Households without Livestock (%)",
        value: <?php echo $percLivestockNo; ?>
      }
      ],
      // barSizeRatio: 0.35,
      resize: true,
      colors: [$.colors("green", 500), $.colors("brown", 300)]
    });
<?php
}
           if($cat == 5){
            ?>
     Morris.Donut({
      element: 'energy',
      data: [{
        label: "Households with Electricity(%)",
        value: <?php echo $percElecYes; ?>
      }, {
        label: "Households without Electricity(%)",
        value: <?php echo $percElecNo; ?>
      }
      ],
      // barSizeRatio: 0.35,
      resize: true,
      colors: [$.colors("yellow", 500), $.colors("blue-grey", 500)]
    });
<?php
}
           if($cat == 4){
            ?>
     Morris.Donut({
      element: 'security',
      data: [{
        label: "Households affected by Insecurity(%)",
        value: <?php echo $percYes; ?>
      }, {
        label: "Households not affected by Insecurity(%)",
        value: <?php echo $percNo; ?>
      }
      ],
      // barSizeRatio: 0.35,
      resize: true,
      colors: [$.colors("red", 500), $.colors("blue", 500)]
    });
<?php
}
           if($cat == 2){
            ?>

Morris.Donut({
      element: 'education',
      data: [{
        label: "School Going Household Members(%)",
        value: <?php echo round($percEduAge, 2); ?>
      }, {
        label: "Working Household Members(%)",
        value: <?php echo round($percEduWork, 2); ?>
      }
      ],
      // barSizeRatio: 0.35,
      resize: true,
      colors: [$.colors("green", 500), $.colors("yellow", 500)]
    });
<?php
} ?>
  })(); 


    $('#yes').click(function(){
      $('#agrnTable').hide();
      $('#agrTable').slideToggle();
    });
     $('#no').click(function(){
      $('#agrTable').hide();
      $('#agrnTable').slideToggle();
    });

    $('#yes2').click(function(){
      $('#agrn2Table').hide();
      $('#agr2Table').slideToggle();
    });
     $('#no2').click(function(){
      $('#agr2Table').hide();
      $('#agrn2Table').slideToggle();
    });

    $('yes').scrollTo('#agrtbl',{duration:'slow', offsetTop : '200'});

 });
  
</script>


</body>

</html>
