<div class="col-lg-3 col-md-6">
    <div class="panel panel-farmer">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-user fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $noFarmers; ?></div>
                    <div>Farmers<br/> &nbsp;</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-agriculture">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-pagelines fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $farming_no; ?></div>
                    <div>Crop Farming Households</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-red">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-bell fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $livestock_no; ?></div>
                    <div>Livestock Keeping households</div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="panel panel-agriculture">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa fa-lock fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $theftQ = mysqli_query($conn, "SELECT COUNT(security_crime_affected) as theft FROM `households` where security_crime_affected LIKE 'Theft of Livestock'");
                      $theftR = mysqli_fetch_assoc($theftQ);
                      $theft = $theftR['theft'];
                    ?>
                    <div class="huge"><?php echo $theft; ?></div>
                    <div>Cases Reported of Livestock Theft</div>
                </div>
            </div>
        </div>

    </div>
</div>