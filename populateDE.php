<?php

/**
 * 
 * DE population utility.
 * 
 * Populates Data Extension based on Facebook data. 
 * 
 * Currently linked to JR's learning account (see fuelsdk/config.php)
 * 
 * Row contents should be passed via POST, with variable names as below.
 * 
 * If email is blank, will be set as dcoghill@example.com and DOB as 1/1/1980
 * 
**/

//Data Extension name
$DataExtensionNameForTesting = "Jardine-Facebook-POC";

//Variables to be passed by POST
$newRowArray = array('EmailAddress','FirstName','LastName','DOB','Gender','FacebookUserId', 'LikesHawaiian', 'LikesSupreme', 'LikesGarlicBread');

//----------
ini_set("display_errors","on");
error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set("Australia/Sydney");

require('fuelsdk/ET_Client.php');

$cookie_expiry = time()+60*60*24*30;


foreach($newRowArray as $key) {
    if (isset($_POST[$key])) {
        $newRowArray[$key] = $_POST[$key];
        setcookie($key,$_POST[$key],$cookie_expiry);
    } else {
        $newRowArray[$key] = 'FALSE';
        setcookie($key,"",$cookie_expiry); //blank out empty variables (such as unchecked checkboxes) or they'll always be set
    }
}

if ($newRowArray['EmailAddress'] == NULL){
    $newRowArray['EmailAddress'] = 'dcoghill@example.com';
    $newRowArray['DOB'] = '1/1/1980';
    //echo 'POST is blank, so inserting test email address.<br>';
}

try {	
	$myclient = new ET_Client();//true, false, $config);

        //check if email address already exists
        
        
        if ($already_exists) {
            
        } else {
            // Add a row to a DataExtension 
            //print_r("Add a row to a DataExtension  <br>\n");
            $postDRRow = new ET_DataExtension_Row();
            $postDRRow->authStub = $myclient;
            $postDRRow->props = $newRowArray;
            $postDRRow->Name = $DataExtensionNameForTesting;	
            $postResult = $postDRRow->patch();
            print_r('Post Status: '.($postResult->status ? 'true' : 'false')."<br>\n");
            print 'Code: '.$postResult->code."\n";
            print 'Message: '.$postResult->message."\n";	
            print 'Result Count: '.count($postResult->results)."\n";
            print 'Results: '."\n";
            print_r($postResult->results);
            print "\n---------------\n";

            $success = $postResult->status;
        }
	
	}
	catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
<!doctype html>
<html lang="en">
    <head><title>We've saved your details</title>
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
        <style type="text/css">body {
                padding-top: 20px;
                padding-bottom: 20px;
            }</style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body><div class="container"><?php
if ($success) {
    print "<p class=\"text-success\" align=\"center\">Thanks, ".$_POST['FirstName']."! We've saved your details!</p>";
} else {
    print "<p class=\"text-warning\">Sorry, something went wrong.</p>";
}

?><p align="center"><a href="facebookAuth.php" class="btn btn-success">Return to the preference centre</a></p></div></body></html>