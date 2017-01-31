<div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-ambulance fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $rows_yesh; ?></div>
                    <div>Household heads who visited a health facility</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-home fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $nets_yes; ?></div>
                    <div>Households with mosquito nets</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-money fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $cashQ = mysqli_query($conn, "SELECT SUM(money_spent_on_waterborne_diseases) as cash FROM `households`");
                      $cashR = mysqli_fetch_assoc($cashQ);
                      $cash = $cashR['cash'];
                      $ksh = $cash/1000000;
                      $kshdec = round($ksh,2);
                    ?>
                    <div class="huge"><?php echo $kshdec."M"; ?></div>
                    <div>Money spent on waterborne diseases</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-green">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-institution fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $amwQ = mysqli_query($conn, "SELECT SUM(adults_missed_work_waterborne_diseases) as amw FROM `households`");
                      $amwR = mysqli_fetch_assoc($amwQ);
                      $amw = $amwR['amw'];
                    ?>
                    <div class="huge"><?php echo $amw; ?></div>
                </div>
                <div>Adults missed work due to waterborne diseases</div>
            </div>
        </div>
    </div>
</div>