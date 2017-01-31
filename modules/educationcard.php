<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-graduation-cap fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $ecd; ?></div>
                    <div>Households with Children in ECD</div>
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
                    <i class="fa fa-stethoscope fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $cmswdQ = mysqli_query($conn, "SELECT SUM(`children_missed_school_waterborne_diseases`) as cmswd FROM `households`");
                      $cmswdR = mysqli_fetch_assoc($cmswdQ);
                      $cmswd = $cmswdR['cmswd'];
                    ?>
                    <div class="huge"><?php echo $cmswd; ?></div>
                </div>
            </div>
            <div class="col-md-offset-3">Missed school due to waterborne diseases</div>
        </div>

    </div>
</div>