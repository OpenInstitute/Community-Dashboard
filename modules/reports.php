<?php
$Nocq = mysqli_query($conn, "SELECT * FROM `serviceregister` WHERE 1");
$Noc = mysqli_num_rows($Nocq);

?>
<div class="row">
  <h3 class="title-hero">
    General Overview
  </h3>
    <div class="col-md-4 bReport" name="all">
        <div class="tile-box tile-box-alt bg-primary">
            <div class="tile-header">
                Total Number of Cases
            </div>
            <div class="tile-content-wrapper">
                <i class="glyph-icon icon-gavel"></i>
                <div class="tile-content">
                    <?php echo $Noc; ?> Cases
                </div>
                <small>
                    In the Service Register
                </small><br/><br/>
            </div>
            
        </div>
    </div>

    <div class="col-md-4 bReport" name="nxtW">
        <div class="tile-box tile-box-alt bg-red">
            <div class="tile-header">
                Scheduled For Next Week
            </div>
            <div class="tile-content-wrapper">
                <i class="glyph-icon font-white icon-calendar"></i>
                <div class="tile-content">
                    <?php
                        $nxtwk = date("Y-m-d", strtotime("+1 Week"));
                        $schedQ = mysqli_query($conn, "SELECT * FROM `serviceregister` WHERE week(`date`) = week(DATE_ADD(NOW(), INTERVAL 1 WEEK))");
                        $schedR = mysqli_num_rows($schedQ);
                        if($schedR == 0){
                            $nocnxt = "No Cases";
                        }elseif($schedR == 1){
                         $nocnxt = $schedR." Case";
                        }else{
                          $nocnxt = $schedR." Cases";  
                        }
                        echo $nocnxt;
                    ?>
                </div>
                <small>
                    Scheduled for next week <br/><br/>
                </small><br/>
            </div>
        </div>
    </div>
    <div class="col-md-4 bReport" name="nxtM">
        <div class="tile-box tile-box-alt bg-blue">
            <div class="tile-header">
                Scheduled For Next Month
            </div>
            <div class="tile-content-wrapper">
                <i class="glyph-icon font-white icon-calendar"></i>
                <div class="tile-content">
                    <?php
                        $nxtmth = date("Y-m-d", strtotime("+1 month"));
                        // echo $nxtmth;
                        // echo "SELECT * FROM `serviceregister` WHERE `date` = $nxtmth";
                        $schedmQ = mysqli_query($conn, "SELECT * FROM `serviceregister` WHERE month(`date`) = month(DATE_ADD(NOW(), INTERVAL 1 MONTH))");
                        $schedmR = mysqli_num_rows($schedmQ);
                        if($schedmR == 0){
                            $nocnxtm = "No Cases";
                        }elseif($schedmR == 1){
                         $nocnxtm = $schedmR." Case";
                        }else{
                          $nocnxtm = $schedmR." Cases";  
                        }
                        echo $nocnxtm;
                    ?>
                </div>
                <small>
                    Scheduled for next month <br/><br/>
                </small><br/>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
<?php
    // function sublocation($conn,$subloc){
    //     $cndb = new master;
    //     $sublocQ = "SELECT * FROM `serviceregister` WHERE location = '$subloc'";
    //     $sublocCon = $cndb->dbQuery($sublocQ)
    //     $sublocR = $cndb->recordCount($sublocCon)
        
    //         if($sublocR == 0){
    //             $sbcases = "No Cases";
    //         }elseif($sublocR == 1){
    //             $sbcases = $sublocR." Case";
    //         }else{
    //             $sbcases = $sublocR." Cases";  
    //         }
    //         return $sbcases;
    // }
?>
    <h3 class="title-hero top">
      Case Per Location
    </h3>
  <div class="col-md-4 bReport" name="umoja">
    <div class="tile-box tile-box-alt bg-blue-alt">
        <div class="tile-header">
            Cases in Umoja
        </div>
        <div class="tile-content-wrapper">
            <i class="glyph-icon icon-users"></i>
            <div class="tile-content">
               <?php 
              $sbQ = $cndb->dbQuery("SELECT * FROM `serviceregister` WHERE location = 'Umoja'");
              echo $cndb->recordCount($sbQ)." Cases";
               ?>
            </div>
            <small>
                Number of cases in Umoja
            </small><br/><br/>
        </div>
    </div>

</div>

      <div class="col-md-4 bReport" name="murunyu">
        <div class="tile-box tile-box-alt bg-blue-alt">
            <div class="tile-header">
                Cases in Murunyu
            </div>
            <div class="tile-content-wrapper">
                <i class="glyph-icon icon-users"></i>
                <div class="tile-content">
                   <?php 
              $sbQ = $cndb->dbQuery("SELECT * FROM `serviceregister` WHERE location = 'Murunyu'");
              echo $cndb->recordCount($sbQ)." Cases";
               ?>
                </div>
                <small>
                    Number of cases in Murunyu
                </small><br/><br/>
            </div>
        </div>

    </div>

      <div class="col-md-4 bReport" name="kiamunyeki">
        <div class="tile-box tile-box-alt bg-blue-alt">
            <div class="tile-header">
                Cases in Kiamunyeki
            </div>
            <div class="tile-content-wrapper">
                <i class="glyph-icon icon-users"></i>
                <div class="tile-content">
                   <?php 
              $sbQ = $cndb->dbQuery("SELECT * FROM `serviceregister` WHERE location = 'Kiamunyeki'");
              echo $cndb->recordCount($sbQ)." Cases";
               ?>
                </div>
                <small>
                    Number of cases in Kiamunyeki
                </small><br/><br/>
            </div>
        </div>

    </div>


</div>