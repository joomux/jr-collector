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

?><!doctype html>
<html lang="en">
    <head><title>Facebook authentication POC</title>
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
        <style type="text/css">body {
  padding-top: 20px;
  padding-bottom: 20px;
}</style>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body><div class="container">
    <?php
    FacebookSession::setDefaultApplication('1584536598430668', '89d37b60577695dce29a3e1dc0c2d2fa');

    $ourLoginUrl = 'https://'.$_SERVER['HTTP_HOST'].'/facebookLogin.php';


$helper = new FacebookRedirectLoginHelper($ourLoginUrl);
$loginUrl = $helper->getLoginUrl(array('scope'=>'public_profile,user_birthday,email'));

foreach($_COOKIE as $key=>$val) {
    var_dump($key.': '.$val);
}

echo "<p align=\"center\"><a href=\"".$loginUrl."\" class=\"btn btn-lg btn-success\">Let's get started!</a></p>";
    ?>
        </div></body>
</html>
