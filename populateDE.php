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
$newRowArray = array('EmailAddress','FirstName','LastName','DOB','Gender','FacebookUserId');

//----------
ini_set("display_errors","on");
error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set("Australia/Sydney");

require('fuelsdk/ET_Client.php');

foreach($newRowArray as $key) {
    if (isset($_POST[$key])) {
        $newRowArray[$key] = $_POST[$key];
    }
}

if ($newRowArray['EmailAddress'] == NULL){
    $newRowArray['EmailAddress'] = 'dcoghill@example.com';
    $newRowArray['DOB'] = '1/1/1980';
    echo 'POST is blank, so inserting test email address.<br>';
}

try {	
	$myclient = new ET_Client();//true, false, $config);

	// Add a row to a DataExtension 
	print_r("Add a row to a DataExtension  <br>\n");
	$postDRRow = new ET_DataExtension_Row();
	$postDRRow->authStub = $myclient;
	$postDRRow->props = $newRowArray;
	$postDRRow->Name = $DataExtensionNameForTesting;	
	$postResult = $postDRRow->post();
	print_r('Post Status: '.($postResult->status ? 'true' : 'false')."<br>\n");
	//print 'Code: '.$postResult->code."\n";
	//print 'Message: '.$postResult->message."\n";	
	//print 'Result Count: '.count($postResult->results)."\n";
	//print 'Results: '."\n";
	//print_r($postResult->results);
	//print "\n---------------\n";
	
	}
	catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

echo 'Test complete';

?>