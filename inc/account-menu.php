    <ul id="sidebar-menu">
    <li class="header"><span>Account Menu</span></li>
    <li>
        <a href="index.php" title="Admin Dashboard">
            <i class="glyph-icon icon-home"></i>
            <span>Back to Dashboard</span>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="account.php" title="View profile">
            <i class="glyph-icon icon-user"></i>
            <span>View profile</span>
        </a>
    </li>
    <li class="divider"></li>
    <?php 
        if($_SESSION['RoleId'] == 1){ 
    ?>
    <li>
        <a href="manage-users.php" title="Manage other users">
            <i class="glyph-icon icon-users"></i>
            <span>Manage Other Users</span>
        </a>
    </li>
    <li class="divider"></li>
    <?php } ?>
    <li>
        <a href="change-password.php" title="Change password">
            <i class="glyph-icon icon-shield"></i>
            <span>Change Password</span>
        </a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="logout.php" title="Log out">
            <i class="glyph-icon icon-lock"></i>
            <span>Log Out</span>
        </a>
    </li>
    <li class="divider"></li>
    </ul><!-- #sidebar-menu -->