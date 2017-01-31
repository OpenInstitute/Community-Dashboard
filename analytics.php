<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
    // error_reporting(0);
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Analytics';
    $description = 'Welcome to Lanet Umoja Location Dashboard. View analytics from different sectors in Lanet location';
}
 include 'inc/head.php'; ?>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" integrity="sha256-AIodEDkC8V/bHBkfyxzolUMw57jeQ9CauwhVW6YJ9CA=" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="assets/css/site.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<body>
    <div id="page-wrapper">
  <!-- Top bar here -->
  <?php include 'inc/topbar.php'; ?>
    <div id="page-sidebar">
    <div class="scroll-sidebar">
        <?php include 'inc/menu.php'; ?>
    </div>
    </div>
        <div id="page-content-wrapper">
            <div id="page-content">   
                    <div ng-view></div>
                    <!-- Everything that appears on the website goes here -->
                    <div class="panel panel-body col-md-12">
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
                            <div class="col-lg-12">
                                <h1 class="page-head">Health</h1>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- health cards -->
                          <div class="row">
                          <?php include 'modules/healthcard.php'; ?>
                          </div>
                        <!-- end of health cards -->
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
                          <?php if($_SESSION['RoleId'] == 1){ ?>
                          <th>Name</th>
                          <?php } ?>
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
                          <?php if($_SESSION['RoleId'] == 1){ ?>
                            <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                            <?php } ?>
                            <td><?php echo $contact10['bread_winner_role']; ?></td>
                            <td><?php echo $contact10['sub_location']; ?></td>
                            <td><?php 
                                if(!empty($contact10['bw_phone'])){
                                  echo $contact10['bw_phone'];
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
                          <?php if($_SESSION['RoleId'] == 1){ ?>
                          <th>Name</th>
                          <?php } ?>
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
                            <?php if($_SESSION['RoleId'] == 1){ ?>
                            <td><a href='household.php?id=<?php echo $contact11['id']; ?>'><?php echo $contact11['bread_winner_name']; ?></a></td>
                            <?php } ?>
                            <td><?php echo $contact11['bread_winner_role']; ?></td>
                            <td><?php echo $contact11['sub_location']; ?></td>
                            <td><?php 
                                if(!empty($contact11['bw_phone'])){
                                  echo $contact11['bw_phone'];
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
                            <td><?php echo $percNetsYes."%"; ?></td>
                            <td>Yes</td>
                            <td><a href="javascript:void()" id="yes2">Households with Mosquito Nets</a></td>
                          </tr>
                          <tr>
                            <td><?php echo $percNetsNo."%"; ?></td>
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
                          <?php if($_SESSION['RoleId'] == 1){ ?>
                          <th>Name</th>
                          <?php } ?>
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
                            <?php if($_SESSION['RoleId'] == 1){ ?>
                            <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                            <?php } ?>
                            <td><?php echo $contact10['bread_winner_role']; ?></td>
                            <td><?php echo $contact10['sub_location']; ?></td>
                            <td><?php 
                                if(!empty($contact10['bw_phone'])){
                                  echo "0".$contact10['bw_phone'];
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
                          <?php if($_SESSION['RoleId'] == 1){ ?>
                          <th>Name</th>
                          <?php } ?>
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
                            <?php if($_SESSION['RoleId'] == 1){ ?>
                            <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                            <?php } ?>
                            <td><?php echo $contact10['bread_winner_role']; ?></td>
                            <td><?php echo $contact10['sub_location']; ?></td>
                            <td><?php 
                                if(!empty($contact10['bw_phone'])){
                                  echo "0".$contact10['bw_phone'];
                                  }else{
                                    echo "";
                                    } ?>
                            </td>
                          </tr>
                          <?php } ?>
                          </tbody>
                          </table>
            <?php }
            if($cat == 1){
              ?>
               <!--Agriculture-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Agriculture</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!--Agriculture cards -->
            <div class="row">
            <?php include 'modules/agriculturecard.php'; ?>
            </div>
            <!-- end of agriculture cards -->
           
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo $contact10['bw_phone'];
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact11['id']; ?>'><?php echo $contact11['bread_winner_name']; ?></a></td>
                        <?php } ?>
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo $contact11['bw_phone'];
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
                <div class="col-lg-12">
                    <h1 class="page-head">Security</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- security cards -->
            <div class="row">
            <?php include 'modules/securitycard.php'; ?>
            </div>
            <!-- end of security cards -->
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo $contact10['bw_phone'];
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact11['id']; ?>'><?php echo $contact11['bread_winner_name']; ?></a></td>
                        <?php } ?>
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo $contact11['bw_phone'];
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
                <div class="col-lg-12">
                    <h1 class="page-head">Education</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!--education cards -->
            <div class="row">
            <?php include 'modules/educationcard.php'; ?>
            </div>
            <!--end of education cards-->
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
                <div class="col-lg-12">
                    <h1 class="page-head">Energy</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- energy cards -->
            <div class="row">
            <?php include 'modules/energycard.php'; ?>
            </div>
            <!--end of energy cards -->
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
                        <td><?php echo $contact10['bread_winner_role']; ?></td>
                        <td><?php echo $contact10['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact10['bw_phone'])){
                              echo $contact10['bw_phone'];
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact11['id']; ?>'><?php echo $contact11['bread_winner_name']; ?></a></td>
                        <?php } ?>
                        <td><?php echo $contact11['bread_winner_role']; ?></td>
                        <td><?php echo $contact11['sub_location']; ?></td>
                        <td><?php 
                            if(!empty($contact11['bw_phone'])){
                              echo $contact11['bw_phone'];
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-head">Water and Sanitation</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- water and sanitation-->
            <!--water and sanitation cards-->
            <div class="row">
            <?php include 'modules/watercard.php'; ?>
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
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
                      <?php if($_SESSION['RoleId'] == 1){ ?>
                      <th>Name</th>
                      <?php } ?>
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
                        <?php if($_SESSION['RoleId'] == 1){ ?>
                        <td><a href='household.php?id=<?php echo $contact10['id']; ?>'><?php echo $contact10['bread_winner_name']; ?></a></td>
                        <?php } ?>
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
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>

 <!-- <script src="assets/vendor/chart-js/Chart.js"></script> -->
    <!-- WIDGETS -->
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.js"></script>
<!-- Bootstrap Dropdown -->
<!-- <script type="text/javascript" src="assets/widgets/dropdown/dropdown.js"></script> -->
<!-- Bootstrap Tooltip -->
<!-- <script type="text/javascript" src="assets/widgets/tooltip/tooltip.js"></script> -->
<!-- Bootstrap Popover -->
<!-- <script type="text/javascript" src="assets/widgets/popover/popover.js"></script> -->
<!-- Bootstrap Progress Bar -->
<script type="text/javascript" src="assets/widgets/progressbar/progressbar.js"></script>
<!-- Bootstrap Buttons -->
<!-- <script type="text/javascript" src="assets/widgets/button/button.js"></script> -->
<!-- Bootstrap Collapse -->
<!-- <script type="text/javascript" src="assets/widgets/collapse/collapse.js"></script> -->
<!-- Superclick -->
<script type="text/javascript" src="assets/widgets/superclick/superclick.js"></script>
<!-- Input switch alternate -->
<script type="text/javascript" src="assets/widgets/input-switch/inputswitch-alt.js"></script>
<!-- Slim scroll -->
<script type="text/javascript" src="assets/widgets/slimscroll/slimscroll.js"></script>
<!-- Slidebars -->
<script type="text/javascript" src="assets/widgets/slidebars/slidebars.js"></script>
<script type="text/javascript" src="assets/widgets/slidebars/slidebars-demo.js"></script>
<!-- PieGage -->
<script type="text/javascript" src="assets/widgets/charts/piegage/piegage.js"></script>
<script type="text/javascript" src="assets/widgets/charts/piegage/piegage-demo.js"></script>
<!-- Screenfull -->
<script type="text/javascript" src="assets/widgets/screenfull/screenfull.js"></script>
<!-- Content box -->
<script type="text/javascript" src="assets/widgets/content-box/contentbox.js"></script>
<!-- Overlay -->
<script type="text/javascript" src="assets/widgets/overlay/overlay.js"></script>
<!-- Widgets init for demo -->
<script type="text/javascript" src="assets/js-init/widgets-init.js"></script>
<!-- Theme layout -->
<script type="text/javascript" src="assets/themes/admin/layout.js"></script>
<!-- Theme switcher -->
<script type="text/javascript" src="assets/widgets/theme-switcher/themeswitcher.js"></script>
 

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!--  <script src="assets/js/chartjs.js"></script> -->

</div>
  <script>

$(function(){
// My jquery methods start here
<?php if($cat == 3){ ?>

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
        colors: ["#25C4BC", "#C4252D"]
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
        colors: ['#25C4BC','#C4252D']
      });

  <?php } if($cat == 1){ ?>

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
        colors: ["#829621", "#BF773A"]
      });

  <?php } if($cat == 5){ ?>

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
        colors: ["yellow","black"]
      });

  <?php } if($cat == 4){ ?>

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
        colors: ["red","#337ab7"]
      });

  <?php } if($cat == 2){ ?>

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
        //colors: [$.colors("green", 500), $.colors("yellow", 500)]
      });

  <?php } if($cat == 6){ ?>

       Morris.Donut({
        element: 'drinkWater',
        data: [{
          label: "Borehole/Well(%)",
          value: <?php echo $percWb; ?>
        }, {
          label: "Rain Water (%)",
          value: <?php echo $percWr; ?>
        }, {
          label: "Piped Water (%)",
          value: <?php echo $percWp; ?>
        }, {
          label: "Community Water (%)",
          value: <?php echo $percWc; ?>
        }, {
          label: "Water Delivery (%)",
          value: <?php echo $percWd; ?>
        }, {
          label: "Other (%)",
          value: <?php echo $percOther; ?>
        }
        ],
        // barSizeRatio: 0.35,
        resize: true,
        colors: ["#855705","blue","grey","yellow","yellow","#337ab7"] 
      });

  <?php } ?>

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



// My jquery methods end here
});
  
  </script>
</body>
</html>