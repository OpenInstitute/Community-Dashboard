<div class="col-lg-3 col-md-6">
    <div class="panel panel-yellow">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-3">
                    <i class="fa  fa-lightbulb-o fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <div class="huge"><?php echo $elec_yes; ?></div>
                    <div>Households with Electricity</div>
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
                    <i class="fa fa-sun-o fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $solarQ = mysqli_query($conn, "SELECT COUNT(energy_power_source) as energy FROM `households` where energy_power_source = 'Solar Energy'");
                      $solarR = mysqli_fetch_assoc($solarQ);
                      $solar = $solarR['energy'];
                    ?>
                    <div class="huge"><?php echo $solar; ?></div>
                    <div>Households using Solar Energy</div>
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
                    <i class="fa fa-simplybuilt fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $batteryQ = mysqli_query($conn, "SELECT COUNT(energy_power_source) as energy FROM `households` where energy_power_source = 'Battery'");
                      $batteryR = mysqli_fetch_assoc($batteryQ);
                      $battery = $batteryR['energy'];
                    ?>
                    <div class="huge"><?php echo $battery; ?></div>
                    <div>Households using Battery Energy</div>
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
                    <i class="fa fa-tint fa-4x"></i>
                </div>
                <div class="col-xs-9 text-right">
                    <?php
                      $kerosene = mysqli_query($conn, "SELECT energy_cooking_facilities FROM `households` where energy_cooking_facilities like '%kero%'");
                      $kerosene = mysqli_fetch_assoc($kerosene);
                      $kerosene = $batteryR['energy'];
                    ?>
                    <div class="huge"><?php echo $kerosene; ?></div>
                    <div>Households use Kerosene to cook</div>
                </div>
            </div>
        </div>
    </div>
</div>