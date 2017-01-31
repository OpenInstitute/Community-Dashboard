    <ul id="sidebar-menu">
    <li class="header"><span>Dashboard</span></li>
    <?php
		  $qry = "SELECT * FROM  menu WHERE menuviewed = 1 ORDER BY menuseq";
		  $Res = mysqli_query($conn, $qry);
		  
		  while($menu = mysqli_fetch_array($Res)){
              $menuid = $menu['menuid'];
              $qrySub = "SELECT * FROM  submenu WHERE menuid = $menuid AND submenuviewed = 1";
              $ResSub = mysqli_query($conn, $qrySub);
              $chkrow = mysqli_num_rows($ResSub);
              if($chkrow>=1) {
				echo "<li>
						<a href='javascript:void(0);' title='" .$menu['menuname']."'>
							<i class='glyph-icon ". $menu['menuicon'] ."'></i>
							<span>" .$menu['menuname']."</span>
						</a>
						<div class='sidebar-submenu'>

							<ul>";
							while($submenu = mysqli_fetch_array($ResSub)){
								//echo "<li><a href='". $submenu['submenulink'] ."' title='". $submenu['submenuname'] ."'><span>". $submenu['submenuname'] ."</span></a></li>";
								$link = str_replace('.php', '.php',$submenu['submenulink'])."?MID=".base64_encode($menuid)."&SMID=".base64_encode($submenu['submenuid']);
								echo "<li><a href='". $link ."' title='". $submenu['submenuname'] ."'><span>". $submenu['submenuname'] ."</span></a></li>";
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