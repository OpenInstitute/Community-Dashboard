    <ul id="sidebar-menu">
    <li class="header"><span>Dashboard</span></li>
    <?php
	/* @Murage: Active Link */
	$curr_menu = (isset($_REQUEST['MID'])) ? base64_decode($_REQUEST['MID']) : '';
	$curr_smenu = (isset($_REQUEST['SMID'])) ? base64_decode($_REQUEST['SMID']) : '';
	
	/* @Murage: Hide private links from public  */   
	$menu_admin = ($_SESSION['RoleId'] <> 1) ? " and menuaccess <> '2' " : "";
	
		  $qry = "SELECT * FROM  menu WHERE menuviewed = 1 $menu_admin ORDER BY menuseq";
		  $Res = mysqli_query($conn, $qry);
		  
		  while($menu = mysqli_fetch_array($Res)){
              $menuid = $menu['menuid'];
              $qrySub = "SELECT * FROM  submenu WHERE menuid = $menuid AND submenuviewed = 1";
              $ResSub = mysqli_query($conn, $qrySub);
              $chkrow = mysqli_num_rows($ResSub);
              if($chkrow>=1) 
			  {
				  $active_menu = ($curr_menu == $menuid) ? ' current ' : '';
				  
				echo "<li class='sf_".$menuid." ".$active_menu."'>
						<a href='javascript:void(0);' title='" .$menu['menuname']."'>
							<i class='glyph-icon ". $menu['menuicon'] ."'></i>
							<span>" .$menu['menuname']."</span>
						</a>
						<div class='sidebar-submenu'>

							<ul>";
							while($submenu = mysqli_fetch_array($ResSub)){
								$submenuid = $submenu['submenuid'];
								
								$active_smenu = ($curr_smenu == $submenuid) ? ' current ' : '';
								
								//echo "<li><a href='". $submenu['submenulink'] ."' title='". $submenu['submenuname'] ."'><span>". $submenu['submenuname'] ."</span></a></li>";
								$link = str_replace('.php', '.php',$submenu['submenulink'])."?MID=".base64_encode($menuid)."&SMID=".base64_encode($submenu['submenuid']);
								echo "<li class='sfc_".$submenuid." ".$active_smenu."'><a href='". $link ."' title='". $submenu['submenuname'] ."'><span>". $submenu['submenuname'] ."</span></a></li>";
							}
							echo "			
							</ul>

						</div><!-- .sidebar-submenu -->
					</li>";
			  }
              else {
				echo "<li>
						<a href='". $menu['menulink'] ."' title='" .$menu['menuname']."'>
							<i class='glyph-icon ". $menu['menuicon'] ."'></i>
							<span>".$menu['menuname']."</span>
						</a>
					</li> ";
				}
				echo "	<li class='divider'></li>";
            }
    ?>
    
    
    </ul><!-- #sidebar-menu -->