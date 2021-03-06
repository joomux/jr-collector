<?php

/* Written by David Coghill with assistance from Jeremy Roberts
 * for Salesforce Marketing Cloud
 * as Proof of Concept only
 */

ini_set("display_errors","on");
error_reporting(E_ALL ^ E_NOTICE);

session_start();

date_default_timezone_set("Australia/Sydney");

//if we already know the user, take them to the preference page directly
if (isset($_COOKIE['FacebookUserId'])) {
    header("Location: postPage.php?known=1");
    exit();
}



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
    
    
    FacebookSession::setDefaultApplication('1582789501938711', '88b0fbed06508cc5048a85454980d1a4');

    $ourLoginUrl = 'https://'.$_SERVER['HTTP_HOST'].'/facebookLogin.php';


$helper = new FacebookRedirectLoginHelper($ourLoginUrl);
$loginUrl = $helper->getLoginUrl(array('scope'=>'public_profile,email'));


echo "<p align=\"center\"><a href=\"".$loginUrl."\" class=\"btn btn-lg btn-success\">Let's get started!</a></p>";
    ?>
        </div></body>
</html>
