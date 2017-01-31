<?php include 'inc/conn.inc';
    if(!isset($_SESSION['user_session'])){
        header("location: login.php");
    }
 ?>
<!DOCTYPE html> 
<html ng-app="monarchApp" lang="en">

<?php
if(!isset($title)){
    $title = 'Lanet Umoja | My Account - View and Manage Users';
    $description = 'View and manage users on admin level';
}
 include 'inc/head.php';
$userId = $_GET['uid'];
  ?>
    <body>


    <div id="page-wrapper">
  <!-- Top bar here -->
  <?php include 'inc/topbar.php'; ?>
    <div id="page-sidebar">
    <div class="scroll-sidebar">
        <?php include 'inc/account-menu.php'; ?>
    </div>
    </div>
        <div id="page-content-wrapper">
            <div id="page-content">   
                    <div ng-view></div>
                    <!-- Everything that appears on the website goes here -->
                    <!-- Search Bar starts here -->
                    <div class="panel panel-table col-md-12" style="padding: 15px;">
                      <form method="post" action="manage-users.php">
                          <div class="top form-group">
                              <label class="col-md-3 control-label">Search Users</label>
                              <div class="col-md-8">
                                  <input type="text" class="form-control" name="searchbtn" placeholder="Type username to search..." />
                              </div>
                          </div>
                      </form>
                      <div class="top clearfix"></div>
                    </div>
                    <?
                      $jina = $_POST['searchbtn'];
                      if(isset($jina)){
                      $q = "SELECT * FROM public_login p JOIN roles r on p.RoleId=r.RoleId WHERE p.name LIKE '%$jina%'";
                      $r = mysqli_query($conn, $q);
                    ?>
                    <div class="container">
                        <table class="panel table table-striped">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Name</th>
                              <th>Organization</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Last Login</th>
                              <th>Edit</th>
                            </tr>
                          </thead>
                    <?php
                      $k = 0;
                      while($results = mysqli_fetch_array($r)){
                        $k++;
                      ?>
                      <tbody>
                            <tr>
                              <th><?php echo $k; ?></th>
                              <td><?php echo $results['name']; ?></td>
                              <td><?php echo $results['organization']; ?></td>
                              <td><?php echo $results['email']; ?></td>
                              <td><?php echo $results['RoleName']; ?></td>
                              <td><?php echo $results['lastLogin']; ?></td>
                              <td><a data-toggle="modal" data-target="#editUser" href="manage-users.php?uid=<?php echo $results['id']; ?>">Edit</a></td>
                            </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <center>
                    <p><a onclick="unset()" href="manage-users.php"><-- Back to user list</a></p>
                  </center>
                  <script>
                    function unset(){
                      location.reload();
                    }
                  </script>

                  <?php
                      } else{
                    ?>
                    <!-- Search Bar ends here -->
                    <!-- Users list -->
                    <div class="container">
                        <table class="panel table table-striped">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Name</th>
                              <th>Organization</th>
                              <th>Email</th>
                              <th>Role</th>
                              <th>Last Login</th>
                              <th>Edit</th>
                            </tr>
                          </thead>
                          <?php
                          $uQ = "SELECT * FROM public_login p JOIN roles r on p.RoleId=r.RoleId ORDER BY name";
                          $usersQuery = mysqli_query($conn, $uQ);
                          $i = 0;
                          while ($users = mysqli_fetch_array($usersQuery)) {
                            $i++;
                          ?>
                          <tbody>
                            <tr>
                              <th><?php echo $i; ?></th>
                              <td><?php echo $users['name']; ?></td>
                              <td><?php echo $users['organization']; ?></td>
                              <td><?php echo $users['email']; ?></td>
                              <td><?php echo $users['RoleName']; ?></td>
                              <td><?php echo $users['lastLogin']; ?></td>
                              <td><a data-toggle="modal" data-target="#editUser" href="manage-users.php?uid=<?php echo $users['id']; ?>">Edit</a></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                     </div>
                     <?php } ?>
                    <!-- End of users list --> 
              <!-- Modal Form Here -->
  <div id="editUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <?php
             $userQ = "SELECT * FROM public_login p JOIN roles r on p.RoleId=r.RoleId where p.id = '$userId'";
             $userR = mysqli_query($conn, $userQ);
             $userinfo = mysql_fetch_assoc($userR);
          ?>
          <h4 class="modal-title">Edit User - <?php echo $userinfo['name']; ?></h4>
        </div>
        <div class="modal-body">
          <p>Edit this user's information</p>
          
          <script type="text/javascript">
            alert('<?php echo $userQ; ?>');
          </script>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- Modal Form Ends Here --> 
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
</body>
</html>