<style type="text/css">
    .twitter-timeline{ min-height:500px !important; }
</style>
<div id="page-header" class="bg-gradient-9">
    <div id="mobile-navigation">
        <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
        <a href="index.php" class="logo-content-small" title="Lanet Location"></a>
    </div>
    <div id="header-logo" class="logo-bg">
        <a href="index.php" class="logo-content-big" title="Lanet Location">
            Lanet Umoja
            <span>The Location Dashboard</span>
        </a>
        <a href="index.php" class="logo-content-small" title="Lanet Location">
            Lanet Umoja
            <span>The Location Dashboard</span>
        </a>
        <a id="close-sidebar" href="#" title="Close sidebar">
            <i class="glyph-icon icon-angle-left"></i>
        </a>
    </div>
    <div id="header-nav-left">
        <div class="user-account-btn dropdown">
            <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
                <!-- <img width="28" src="assets/image-resources/gravatar.jpg" alt="Profile image"> -->
                <?php
                $qry = "SELECT * FROM  `public_login` where public_login.name='" . $_SESSION['user_session'] ."' AND avatar !=''";
              $Res = mysqli_query($conn, $qry);
              $chkrow = mysqli_num_rows($Res);
              $img = mysqli_fetch_assoc($Res);
              if($chkrow >= 1){
                $av = $img['avatar'];
                    if($img['RoleId']>1){
                        if($img['signedInFrom'] !== 'Web'){
                        }else{
                      $av = str_replace('src="', 'src="../', $av);
                        }
                    } 
                    echo $av;
                }
                else{
                $image = "<img src=\"assets/images/avatar.png\" title=\"". $_SESSION['user_session'] ."\">";
                echo $image;
              }
              ?>
                <span><?php echo $_SESSION['user_session']; ?></span>
                <!-- <i class="glyph-icon icon-angle-down"></i> -->
            </a>

        </div>
    </div><!-- #header-nav-left -->

    <div id="header-nav-right">
        <div class="dropdown" id="notifications-btn">
            <a data-toggle="dropdown" href="#" title="">
                <i class="glyph-icon icon-twitter"></i>
            </a>
            <div class="dropdown-menu box-md float-right">

                <div class="popover-title display-block clearfix pad10A">
                    Chief's Tweets
                    <a class="text-transform-cap font-primary font-normal btn-link float-right" href="https://twitter.com/Chiefkariuki" title="View more options">
                        Go to Twitter...
                    </a>
                </div>
                <div class="scrollable-content scrollable-slim-box">
                    <a class="twitter-timeline" href="https://twitter.com/Chiefkariuki">Tweets by Chiefkariuki</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
        <a class="header-btn" id="logout-btn" href="account.php" title="Account Settings">
            <i class="glyph-icon icon-gear"></i>
        </a>        
        <a class="header-btn" id="logout-btn" href="logout.php" title="Log out">
            <i class="glyph-icon icon-lock"></i>
        </a>
    </div><!-- #header-nav-right -->
</div>