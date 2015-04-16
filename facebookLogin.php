<?php

ini_set("display_errors","on");
error_reporting(E_ALL ^ E_NOTICE);

session_start();

date_default_timezone_set("Australia/Sydney");

require("facebook-sdk/autoload.php");

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('1584536598430668', '89d37b60577695dce29a3e1dc0c2d2fa');


$ourLoginUrl = 'http://'.$_SERVER['HTTP_HOST'].'/jr-collector/facebookLogin.php';
$currentUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$helper = new FacebookRedirectLoginHelper($ourLoginUrl);

//var_dump($helper->getSessionFromRedirect());

try {
  $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
    var_dump('FacebookRequestException',$ex);
} catch(\Exception $ex) {
  // When validation fails or other local issues
    var_dump('Exception',$ex);
}

if($session) {

  try {

    $user_profile = (new FacebookRequest(
      $session, 'GET', '/me'
    ))->execute()->getGraphObject(GraphUser::className());

    $birthday = $user_profile->getBirthday();
    
    $_SESSION['FirstName'] = $user_profile->getFirstName();
    $_SESSION['LastName'] = $user_profile->getLastName();
    $_SESSION['DOB'] = $birthday->format('m/d/Y');
    $_SESSION['Gender'] = $user_profile->getGender();
    $_SESSION['EmailAddress'] = $user_profile->getEmail();
    $_SESSION['FacebookUserId'] = $user_profile->getId();
    
    header("Location: postPage.php");
    exit();

  } catch(FacebookRequestException $e) {

    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();

  }   

} else {
    
    $helper = new FacebookRedirectLoginHelper($ourLoginUrl);
    $loginUrl = $helper->getLoginUrl();
 ?><!doctype html>
<html>
    <head><title>Facebook authentication POC</title></head>
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1584536598430668',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    
    <body><?php
 
 
 
    echo "<p>You haven't accepted our app yet. <a href=\"".$loginUrl."\">Log in</a></p>";
}
    
    ?>
    </body>
    
</html><?php



?>
