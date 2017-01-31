<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-child fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $children; ?></div>
                </div>
            </div>
            <div class="container">Number of Children in Households</div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-hand-stop-o fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <?php
                    $orphansQ = mysqli_query($conn,"SELECT SUM(`bw_other_orphans`) as orphans FROM `households`");
                    $orphansR = mysqli_fetch_assoc($orphansQ);
                    $orphans = $orphansR['orphans'];
                  ?>
                    <div class="huge"><?php echo $orphans; ?></div>
                    <div>Total number of orphans</div>
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
                    <i class="fa fa-columns fa-4x"></i>
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
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-stethoscope fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $imm; ?></div>
                    <div>Households with Immunized Children</div>
                </div>
            </div>
        </div>
    </div>
</div>