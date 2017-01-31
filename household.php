<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | Welcome';
    $description = 'Welcome to Lanet Umoja Location Dashboard';
}
 include 'inc/head.php';
 $id = $_GET['id'];
 define(HHPATH, "assets/images/households/");
 ?>

<style type="text/css">
    .user-profile img{width: 28px !important;}
    .toppad{margin-top: 15px;
            font-size: 18px !important;
            font-weight: 250;
            color:#333 !important;}
</style>
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
<div class="example-wrap">
<h2>Household Data</h2>
<div class="example table-responsive">
  <table id="paged" class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
    
    <?php
        $sql0 = "SELECT * FROM households WHERE id = $id";

        $cont0 = mysqli_query($conn, $sql0);
        $contact0 = mysqli_fetch_assoc($cont0);
$HHphoto = $contact0['house_photo'];

/* @Murage: Hide private columns from public  */   
    ?>
<?php if($_SESSION['RoleId'] == 1){ ?>  
<tr><td>Bread Winner Name</td><td><a href='map.php?id=<?php echo $contact0['id']; ?>'><?php echo $contact0['bread_winner_name']; ?></a> </td></tr>
<?php } ?>

    <tr><td>Bread Winner Role</td><td><?php echo $contact0['bread_winner_role']; ?></td></tr>
<?php if($_SESSION['RoleId'] == 1){ ?>  
	<tr><td>Spouse Name</td><td><?php echo $contact0['spouse_name']; ?></td></tr>
<?php } ?>	
    <tr><td>Bread Winner Age</td><td><?php echo $contact0['bw_age']; ?></td></tr>
    <tr><td>Bread Winner Occupation</td><td><?php echo $contact0['bw_occupation']; ?></td></tr>
<?php if($_SESSION['RoleId'] == 1){ ?>  	
    <tr><td>Bread Winner Cell Number</td><td><?php echo $contact0['bw_phone'];?></td></tr>	
	<tr><td>Spouse Cell Number</td><td><?php echo $contact0['spouse_tel_number'];?></td></tr>
<?php } ?>	
    <tr><td>Bread Winner Sub-Location</td><td><?php echo $contact0['sub_location']; ?></td></tr>
    <tr><td>Number of Children in the Household</td><td><?php echo $contact0['number_of_children_in_household']; ?></td></tr>
    <tr><td>Land Ownership</td><td><?php echo $contact0['land_ownership']; ?></td></tr>
    <tr><td>House Type</td><td><?php echo $contact0['property_house']; ?></td></tr>
    <!--<tr><td>House Location</td><td><a href=map.php?id=<?php echo $contact0['id']; ?>><?php echo $contact0['Longitude'].','. $contact0['Latitude']; ?></a></td></tr>-->
    <!-- Family Members
    <?php
    //$sql1 = "SELECT * FROM `households` JOIN `household_members` ON `households`.`repeat_member`= `household_members`.`repeat_member_2` WHERE `households`.`id`= $id";
    //$cont1 = mysqli_query($conn, $sql1);
    //$totalRows_Contents = mysqli_num_rows($cont1);
    //if($totalRows_Contents>=1) {
    ?>
    <table class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
        <tr id="hmembers"><td>Household Members 
<span class="tog"><img src="assets/images/plus.png" />
<img style="display:none;" src="assets/images/neg.png" />
</span></td></tr>
        <tr id="members"><td>
        <table class="panel table table-striped dataTable"  data-page-size="10" data-plugin="dataTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Relation to Bread Winner</th>
            <th>Age</th>
            <th>Occupation/Institution</th>
          </tr>
        </thead>
        <tbody>
        <?php
            //while($contact1 = mysqli_fetch_array($cont1)){ ?>
            <tr>
                <td><?php //echo $contact1['group_member_name']; ?></td>
                <td><?php //echo $contact1['group_member_rship']; ?></td>
                <td><?php //echo $contact1['group_member_age']; ?></td>
                <td><?php //echo $contact1['group_member_occupation']; ?></td>
            </tr>
        <?php
            //}
                
        ?>
          </tbody>
      </table>
      </td>
    </tr>
  </table>
<?php
    //}
?>
<!-- Social media section whether they follow chief/ass chief/ cluster leader etc-->
<table  class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
<tr id="hfollow"><td>Breadwinner Twitter Following (Do they follow:)
<span class="tog"><img src="assets/images/plus.png" />
<img style="display:none;" src="assets/images/neg.png" />
</span></td></tr>
<tr id="follow"><td>
<table class="panel table table-striped dataTable" data-page-size="10"  data-plugin="dataTable">
  <tr><td>Chief</td><td><?php echo $contact0['bw_twitter_bw_follow_chief']; ?></td><td>Get Tweets From Chief?</td><td><?php echo $contact0['bw_twitter_bw_get_tweet_chief']; ?></td></tr>
  <tr><td>Assistant Chief</td><td><?php echo $contact0['bw_twitter_bw_follow_assistant_chief']; ?></td><td>Get Tweets From Assistant Chief?</td><td><?php echo $contact0['bw_twitter_bw_get_tweet_assistant_chief']; ?></td></tr>
  <tr><td>Cluster Leaders</td><td><?php echo $contact0['bw_twitter_bw_follow_cluster_leader']; ?></td><td>Get Tweets From Cluster Leader?</td><td><?php echo $contact0['bw_twitter_bw_get_tweet_cluster_leader']; ?></td></tr>
</table>
</td>
</tr>
</table>

<table  class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
<tr id="hspousefollow"><td>Spouse Twitter Following (Does the spouse follow:)
<span class="tog"><img src="assets/images/plus.png" />
<img style="display:none;" src="assets/images/neg.png" />
</span></td></tr>
<tr id="spousefollow"><td>
<table class="panel table table-striped dataTable" data-page-size="10"  data-plugin="dataTable">
  <tr><td>Chief</td><td><?php echo $contact0['spouse_twitter_follow_chief']; ?></td><td>Get Tweets From Chief?</td><td><?php echo $contact0['spouse_twitter_get_tweet_chief']; ?></td></tr>
  <tr><td>Assistant Chief</td><td><?php echo $contact0['spouse_twitter_follow_assistant_chief']; ?></td><td>Get Tweets From Assistant Chief?</td><td><?php echo $contact0['spouse_twitter_get_tweet_assistant_chief']; ?></td></tr>
  <tr><td>Cluster Leaders</td><td><?php echo $contact0['spouse_twitter_follow_cluster_leader']; ?></td><td>Get Tweets From Cluster Leader?</td><td><?php echo $contact0['spouse_twitter_get_tweet_cluster_leader']; ?></td></tr>
</table>
</td>
</tr>
</table>
<!-- end of social media -->


<table  class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
    <tr id="hproperty"><td>Household Property
<span class="tog"><img src="assets/images/plus.png" />
<img style="display:none;" src="assets/images/neg.png" />
</span></td></tr>
    <tr id="property"><td>
        <table class="panel table table-striped dataTable" data-page-size="10"  data-plugin="dataTable">
            <tr><td>Livestock</td><td><?php echo $contact0['property_livestock']; ?></td></tr>
            <tr><td>Farming</td><td><?php echo $contact0['property_farming']; ?></td></tr>
            <tr><td>Related Detail</td><td><?php echo $contact0['property_farming_other']; ?></td></tr>
            <tr><td>House Type</td><td><?php echo $contact0['property_house']; ?></td></tr>
            <tr><td>Sanitation Type</td><td><?php echo $contact0['property_sanitation_facility'];?></td></tr>
        </table>
     </td>
    </tr>
</table>

<?php 
//echo $_SERVER["DOCUMENT_ROOT"];
//  $filename = '/home/openinstitute/lanet.opencounty.org/assets/images/house_photo_'. $contact0['id'].'_1.jpg';
//echo file_exists($filename);
if($HHphoto!=""){

?>


<table  class="panel table table-striped dataTable" data-page-size="10" data-plugin="dataTable">
<tr id="hmedia"><td>Household Media
<span class="tog"><img src="assets/images/plus.png" />
<img style="display:none;" src="assets/images/neg.png" />
</span></td></tr>
<tr id="media"><td>
<table class="panel table table-striped dataTable" data-page-size="10"  data-plugin="dataTable">

  <tr><td>Household Image</td><td>
 
      <?php
      /*$list = glob(HHPATH.'house_photo_'. $contact0['id'].'_*.jpg'); 
       foreach ($list as $l) { 
          //~ if (preg_match("~^a+\.php$~",$file)) 
             //~ $files[] = $l; */
            
  $qry = "SELECT * FROM `household_photos` WHERE `set_repeat_house_photo`  = '$HHphoto'";
  $res = mysqli_query($conn, $qry);
  while($img = mysqli_fetch_array($res)){
    $l = HHPATH.$img['household_photo']; 
    echo "<img style='width:450px; height: auto;'  alt='$alt'  title='$imgtitle' src='$l' />";
  }
             
  
      ?>
      
</td></tr>
  
</table>
</td>
</tr>
</table>
<?php } ?>
</div>
</div>
                    <!-- Everything that appears on the website ends here -->
            </div>
        </div>
    </div>
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

</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#hmembers').click(function(){
      $('#members').slideToggle('slow');
      $('span img',this).toggle();
    });

    $('#hproperty').click(function(){
      $('#property').slideToggle('slow');
      $('span img',this).toggle();
    });

    $('#hfollow').click(function(){
      $('#follow').slideToggle('slow');
      $('span img',this).toggle();
    });

    $('#hspousefollow').click(function(){
      $('#spousefollow').slideToggle('slow');
      $('span img',this).toggle();
    });

    $('#hmedia').click(function(){
      $('#media').slideToggle('slow');
      $('span img',this).toggle();
    });
  });
</script>
<style type="text/css">
  #hproperty, #hmembers, #hmedia, #hfollow,#hspousefollow{
    cursor: pointer;
  }
  #members, #property, #media, #follow, #spousefollow{
    display:none;
  }
  span img{
    width: 16px;
    margin-left: 5px;
  }
</style>
</body>
</html>