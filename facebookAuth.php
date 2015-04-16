<?php

ini_set("display_errors","on");
error_reporting(E_ALL ^ E_NOTICE);

session_start();

date_default_timezone_set("Australia/Sydney");

require("facebook-sdk/autoload.php");

$var = "hello";
$len = strlen($var);
$mbLen = mb_strlen($var);

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

?><!doctype html>
<html>
    <head><title>Facebook authentication POC</title></head>
    
    <body>
    <?php
    FacebookSession::setDefaultApplication('1584536598430668', '89d37b60577695dce29a3e1dc0c2d2fa');

    $ourLoginUrl = 'http://'.$_SERVER['HTTP_HOST'].'/facebookLogin.php';


$helper = new FacebookRedirectLoginHelper($ourLoginUrl);
$loginUrl = $helper->getLoginUrl(array('scope'=>'public_profile,user_birthday,email'));

echo "<p><a href=\"".$loginUrl."\">Log in via Facebook</a></p>";
    ?>
    </body>
</html>
