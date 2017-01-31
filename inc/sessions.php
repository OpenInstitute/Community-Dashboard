<?php include 'conn.inc';

if (!isset($_SESSION['user_session'])) {
  header("location:./login.php");
} 
//echo $_SERVER['HTTP_HOST']; exit;
$qry = "SELECT roles.RoleUrl FROM public_login INNER JOIN roles ON public_login.RoleId = roles.RoleId WHERE public_login.name='" . $_SESSION['user_session'] ."'";
      $chk = mysqli_query($conn, $qry);
      $session = mysqli_fetch_assoc($chk);
        $curPage = $_SERVER['REQUEST_URI'];
        $expPage = $session['RoleUrl'];
       //echo substr($expPage,-1,1); 
		$k = ($session['RoleUrl']!="/") ?  "/" : "";

		if ('http://'.$_SERVER['HTTP_HOST'] == 'http://localhost'){
			$curPage = substr($curPage,0,strrpos($curPage,'/'));
			$expPage = '/lanet'.$k.substr($expPage,0,-1) ;
			//echo $curPage . '-'. $expPage; exit;
			$site = 'http://' . $_SERVER['HTTP_HOST'] .'/lanet';

		} else {
			$curPage = substr($curPage,0,strrpos($curPage,'/')+1);
			$expPage =  "/". substr($expPage,0,-1) .$k ;
			//echo $curPage . '-'. $expPage;
			$site = 'http://' . $_SERVER['HTTP_HOST'] ;

		}
		
        if($curPage != $expPage){
			header("location: $site/login.php");
		}
?>
