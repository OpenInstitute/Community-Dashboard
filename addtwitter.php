<?php require_once 'twitoauth.php';
//adding twitter users to db
	$twtId =  $user->id;
	$_SESSION['twitter_user'] = $twtId;
	$twtName = $user->screen_name;
	$twtimg =  $user->profile_image_url;
	 $img = "<img src=\"";
      $img .= $twtimg;
      $img .= "\" />";
     $twtpic = $img;
     $from = 'Twitter';
     //echo "INSERT INTO `public_login`(`name`, `organization`, `email`, `password`, `avatar`,`RoleId`,`signedInFrom`, `smId` `lastLogin`) VALUES ($twtName', '', '', '', '$twtpic','2','Twitter','$twtId','')"; exit;
     $sql_twt = "SELECT roles.RoleUrl, roles.RoleId, public_login.name FROM public_login INNER JOIN roles ON public_login.RoleId = roles.RoleId WHERE public_login.smId = '$twtId' AND public_login.smId !='' AND signedInFrom !='Web' LIMIT 1";
     $resTwt = mysqli_query($conn, $sql_twt);
     $records = mysqli_num_rows($resTwt);
     if($records >= 1){
        mysqli_query($conn, "update `public_login` set lastLogin=now() WHERE smId = '$twtId'");
        $session = mysqli_fetch_assoc($resTwt);
        $_SESSION['user_session'] = $session['name'];
        $_SESSION['RoleId'] = $session['RoleId'];
        // $k = substr($session['RoleUrl'],0,-1);
            header("location: index.php");
      } else {
        $insertTwt = "INSERT INTO `public_login`(`name`, `organization`, `email`, `password`, `avatar`,`RoleId`,`signedInFrom`, `smId`) VALUES ('$twtName', '', '', '', '$twtpic','2','Twitter','$twtId')";
      mysqli_query($conn, $insertTwt);
       $_SESSION['user_session'] = $twtName;
        $_SESSION['RoleId'] = 2;
        $k = 'index.php';
       header("location: $k");
    }
?>