<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-lock fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $rows_yes; ?></div>
                    <div>Households affected by crime</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-venus fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $crbwQ = mysqli_query($conn, "SELECT COUNT(security_crime) as crime FROM `households` where bread_winner_role = 'Mother' and security_crime = 'Yes'");
                      $crbwR = mysqli_fetch_assoc($crbwQ);
                      $crbw = $crbwR['crime'];
                    ?>
                    <div class="huge"><?php echo $crbw; ?></div>
                    <div>Cases reported by women</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-commenting-o fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $crQ = mysqli_query($conn, "SELECT COUNT(security_crime_reported) as response FROM `households` where security_crime='yes' and security_crime_response = 'Within one week'");
                      $crR = mysqli_fetch_assoc($crQ);
                      $cr = $crR['response'];
                    ?>
                    <div class="huge"><?php echo $cr; ?></div>
                    <div>Cases responded to within a week</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-check-square-o fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $crhelpedQ = mysqli_query($conn, "SELECT COUNT(security_crime_reported) as helped FROM `households` where security_crime='yes' and security_crime_helped = 'Yes'");
                      $crhelpedR = mysqli_fetch_assoc($crhelpedQ);
                      $crhelped = $crhelpedR['helped'];
                    ?>
                    <div class="huge"><?php echo $crhelped; ?></div>
                    <div>Households were assisted</div>
                </div>
            </div>
        </div>

    </div>
</div>