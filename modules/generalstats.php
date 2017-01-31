<?php
  $nhquery = mysqli_query($conn,"SELECT * FROM `households` WHERE 1");
  $secquery = mysqli_query($conn,"SELECT * FROM `households` WHERE `security_crime` = 'yes'");
  $mosquery = mysqli_query($conn,"SELECT * FROM `households` WHERE `health_group_mosquito_nets` = 'yes'");
  $regquery = mysqli_query($conn,"SELECT COUNT(bw_reg_to_vote) as bw_voters FROM `households`  WHERE bw_reg_to_vote = 'YES'");
  
  //$hhreg = mysqli_query($conn,"SELECT * FROM `households` WHERE `bw_reg_to_vote` = 'yes'");
  //$fmreg = mysqli_query($conn,"SELECT * FROM `household_members` WHERE `group_member_reg` = 'yes'");
  $landQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE `property_farming` = 'yes'");
  $livestockQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE`property_livestock` = 'yes'");
  $elecQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE `house_facility_electricity` = 'yes'");
  $healthQuery = mysqli_query($conn,"SELECT * FROM `households` WHERE `bw_health_facility` = 'yes'");

  $schoolchildrenQuery = mysqli_query($conn,"SELECT SUM(`number_of_children_in_household`) as ChildrenInSch FROM `households` where `children_school_facilities` is not null");

  $totHH = mysqli_num_rows($nhquery);
  $secIncidence = mysqli_num_rows($secquery);
  $mosqnets = mysqli_num_rows($mosquery);

  //$hhregv = mysqli_num_rows($hhreg);
  //$fmregv = mysqli_num_rows($fmreg);
  $totReg_SQL = mysqli_fetch_assoc($regquery);
  $totReg = $totReg_SQL['bw_voters'];
  
  $totSchCh_SQL = mysqli_fetch_assoc($schoolchildrenQuery);
  $totSchCh = $totSchCh_SQL['ChildrenInSch'];
  
  $landOwners = mysqli_num_rows($landQuery);
  $electricity = mysqli_num_rows($elecQuery);
  $livestock = mysqli_num_rows($livestockQuery);
  $healthVisit = mysqli_num_rows($healthQuery);

  $usersq = mysqli_query($conn,"SELECT * FROM `public_login` WHERE 1");
  $usersR = mysqli_num_rows($usersq);


/* ============================================================================== 
/*  STATISTICS
/* ------------------------------------------------------------------------------ */  
$sq_total = "SELECT count(*) as `total_posts` FROM `mob_form_posts` where `form_source` <> '';";    
$rs_total = current($cndb->dbQueryFetch($sq_total));  
//displayArray($rs_total);

$sq_locs = "SELECT sublocation, COUNT(form_source) as `loc_posts` FROM mob_form_posts_sdg_gender WHERE form_source <> '' GROUP BY sublocation";   
$rs_locs = $cndb->dbQueryFetch($sq_locs);
$arrLocNum = array();
foreach($rs_locs as $ak => $aloc){
  $loc_name = (trim($aloc['sublocation'])=='' or trim($aloc['sublocation'])=='-') ? 'Unspecified' : $aloc['sublocation'];
  $arrLocNum[$loc_name] = $aloc['loc_posts'];
}
//displayArray($arrLocNum);
  
$sq_grps = "SELECT COUNT(form_source) as `num_posts`, DATE_FORMAT(sync_date, '%Y-%b-%d') as sync_date, group_1name, sublocation FROM mob_form_posts_sdg_gender WHERE group_1name <> '' GROUP BY DATE_FORMAT(sync_date, '%Y-%b-%d'), group_1name, sublocation ORDER BY num_posts DESC limit 0,4";
  
$rs_grps = $cndb->dbQueryFetch($sq_grps); 
// displayArray($rs_grps); exit;
?>
<div class="panel panel-body">
        
        <div class="example-box-wrapper">
            <div class="row">
              <h3 class="title-hero">
                General Overview
              </h3>
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-primary">
                        <div class="tile-header">
                            Households in Lanet Umoja
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-database"></i>
                            <div class="tile-content">
                                <?php echo $totHH; ?>
                            </div>
                            <small>
                                <i class="glyph-icon icon-caret-up"></i>
                                Total number of households in our database
                            </small><br/><br/>
                        </div>
                        
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-red">
                        <div class="tile-header">
                            SDG Goals
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon font-white icon-check-square-o"></i>
                            <div class="tile-content">
                                5 Goals
                            </div>
                            <small>
                                Number of goals set to achieve <br/><br/>
                            </small><br/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-blue">
                        <div class="tile-header">
                            Downloads
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-download"></i>
                            <div class="tile-content">
                              <?php
                                $dq = mysqli_query($conn, "SELECT * FROM `downloads`");
                                $dr = mysqli_num_rows($dq);

                                echo $dr." Files"
                              ?>
                            </div>
                            <small>
                                download forms from the dashboard
                            </small><br/><br/>
                        </div>
                    </div>
                </div>
                <!-- Second class row for logged in users -->
                <div class="clearfix"></div>
                <?php if($_SESSION['RoleId'] == 1){ ?>
                <h3 class="title-hero">
                  Users Overview
                </h3>
                <a href="manage-users.php">
                  <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-black">
                        <div class="tile-header">
                            Registered Users
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-users"></i>
                            <div class="tile-content">
                               <?php echo $usersR; ?> Users
                            </div>
                            <small>
                                Number of users in the dashboard
                            </small><br/><br/>
                        </div>
                    </div>

                </div>
              </a>

                <a href="manage-users.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-blue-alt">
                        <div class="tile-header">
                            Users Logged in Today
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-unlock-alt"></i>
                            <div class="tile-content">
                              <?php
                                $today = date("Y-m-d");
                                $ltq = "SELECT * FROM public_login where lastLogin ='$today'";
                                $ltr = mysqli_query($conn, $ltq);
                                $nlt = mysqli_num_rows($ltr);

                                if($nlt == 0){
                                  $lu = "0 users";
                                }elseif($nlt == 1){
                                  $lu = "1 user";
                                }else{
                                  $lu = $nlt." Users";
                                }
                                echo $lu;
                               ?>
                            </div>
                            <small>
                                Number of users logged in today
                            </small><br/><br/>
                        </div>
                    </div>
                </div>
              </a>

              <a href="manage-users.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-blue">
                        <div class="tile-header">
                            Number of Admins
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-unlock-alt"></i>
                            <div class="tile-content">
                              <?php
                                $today = date("Y-m-d");
                                $admq = "SELECT * FROM public_login where RoleId ='1'";
                                $admr = mysqli_query($conn, $ltq);
                                $nadm = mysqli_num_rows($ltr);

                                echo $nadm." Admins";
                               ?>
                            </div>
                            <small>
                                Number of dashboard administrators
                            </small><br/><br/>
                        </div>
                    </div>
                </div>
              </a>

                <?php } ?>
                <!-- End of second class row for logged in users -->
                <!-- SDG 5 Gender Data -->
                <div class="clearfix"></div>
                <h3 class="title-hero">
                  Lanet SDG 5 Gender Data Stats
                </h3>
                <a href="gender-database.php">
                  <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-yellow">
                        <div class="tile-header">
                            Submissions
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-mobile-phone"></i>
                            <div class="tile-content">
                               <?php echo $rs_total['total_posts']; ?> Entries
                            </div>
                            <small>
                                Number of Submissions using mobile app
                            </small><br/><br/>
                        </div>
                    </div>

                </div>
              </a>

                <a href="gender-database.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-red">
                        <div class="tile-header">
                            Number of Unique Groups
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-tags"></i>
                            <div class="tile-content">     
                                <?php
                                  $numQ = "SELECT DISTINCT group_1name as grp FROM `mob_form_posts_sdg_gender` group by group_1name";
                                  $numR = $cndb->dbQuery($numQ);
                                  $numC = $cndb->recordCount($numR);
                                  echo $numC." Groups";
                                ?>
                            </div>
                            <small>In the three sub-locations</small><br/><br/>
                        </div>
                    </div>
                </div>
              </a>

              <a href="gender-database.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-purple">
                        <div class="tile-header">
                            Top Group in Submissions
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-sitemap"></i>
                            <div class="tile-content">
                                <div style="font-size:22px;"><?php echo ucwords($rs_grps[0]['group_1name']); ?> (<?php echo $rs_grps[0]['sublocation']; ?>): <?php echo $rs_grps[0]['num_posts']; ?></div>
                            </div>
                            <small>Top group in submissions so far</small><br/><br/>
                        </div>
                    </div>
                </div>
              </a>
              <div class="clearfix"></div>
              <a href="gender-database.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-green">
                        <div class="tile-header">
                            Submissions by Location: Kiamunyeki
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-pie-chart"></i>
                            <div class="tile-content">     
                                Kiamunyeki: <?php echo $arrLocNum['Kiamunyeki']; ?>
                            </div>
                            <small>Number of submissions by gender groups in Kiamunyeki</small><br/><br/>
                        </div>
                    </div>
                </div>
              </a><a href="gender-database.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-green">
                        <div class="tile-header">
                            Submissions by Location: Murunyu
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-pie-chart"></i>
                            <div class="tile-content">     
                                Murunyu: <?php echo $arrLocNum['Murunyu']; ?>
                            </div>
                            <small>Number of submissions by gender groups in Murunyu</small><br/><br/>
                        </div>
                    </div>
                </div>
              </a><a href="gender-database.php">
                <div class="col-md-4">
                    <div class="tile-box tile-box-alt bg-green">
                        <div class="tile-header">
                            Submissions by Location: Umoja
                        </div>
                        <div class="tile-content-wrapper">
                            <i class="glyph-icon icon-pie-chart"></i>
                            <div class="tile-content">     
                                Umoja: <?php echo $arrLocNum['Umoja']; ?>
                            </div>
                            <small>Number of submissions by gender groups in Umoja</small><br/><br/>
                        </div>
                    </div>
                </div>
              </a>

                <!-- End of SDG 5 Gender Data -->
            </div>
        </div>
    </div>