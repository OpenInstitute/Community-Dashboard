<?php
include 'inc/conn.inc';
require_once 'Facebook/autoload.php';
# login-callback.php
$fb = new Facebook\Facebook([
  'app_id' => '',
  'app_secret' => '',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
 
} 
catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} 
catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
 if (isset($accessToken)) {

  // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    $response = $fb->get('/me?fields=id,name,picture', $accessToken);
    $user = $response->getGraphUser();
    $fbid = $user['id'];            // To Get Facebook ID
    $_SESSION['sm_id'] = $fbid;
    $fbuname = $user['name'];  // To Get Facebook Username
    $fbpic1 = $user['picture']; 
    $pic = json_decode($fbpic1);
      $picture = $pic->url;

      $img = "<img src=\"";
      $img .= $picture;
      $img .= "\" />";
      $fbpic = $img;
      $_SESSION['smImage'] = $fbpic;
    $sql_fb = "SELECT roles.RoleUrl, roles.RoleId, public_login.name FROM public_login INNER JOIN roles ON public_login.RoleId = roles.RoleId WHERE public_login.smId = '$fbid' AND public_login.smId !='' AND signedInFrom !='Web' LIMIT 1";
    $resFb = mysqli_query($conn, $sql_fb);
    $records = mysqli_num_rows($resFb);
    if($records>=1){
      mysqli_query($conn, "update `public_login` set lastLogin=CURRENT_DATE, `login_count` = (`login_count`+1) WHERE smId = '$fbid'");

        $session = mysqli_fetch_assoc($resFb);
        $_SESSION['user_session'] = $session['name'];
        $_SESSION['RoleId'] = $session['RoleId'];
        // $k = substr($session['RoleUrl'],0,-1);
          //~ if($_SESSION['RoleId'] == 1){
            //~ header("location: ../index.php");
          //~ }elseif($_SESSION['RoleId'] == 2){
            //~ header("location: ../public/index.php");
          //~ }
          //~ else{
            header("location: index.php");
          //}
      } else {
      $dbfb = "INSERT INTO `public_login`(`name`, `organization`, `email`, `password`, `avatar`,`RoleId`,`signedInFrom`, `smId`,`lastLogin`) VALUES ('$fbuname', '', '', '', '$fbpic','2','Facebook','$fbid', CURRENT_DATE)";
        mysqli_query($conn, $dbfb);
       $_SESSION['user_session'] = $fbuname;
        $_SESSION['RoleId'] = 2;
        ;

       header("location: index.php");
    }
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
  }
  ?>
