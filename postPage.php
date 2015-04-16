<?php
session_start();

?>
<!doctype html>
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
        <form action="populateDE.php" method="POST" class="post">
            <?php
            
            $fields = array("FirstName"=>"First Name","LastName"=>"Last Name","DOB"=>"Date of Birth","FacebookUserId"=> "Facebook User ID","Gender"=>"Gender","EmailAddress"=>"Email Address");
            foreach($fields as $name=>$label) {
             
                echo '<input type="hidden" name="'.$name.'" value="'.$_SESSION[$name].'">';
            }
            
            ?>
            <p>Hi, <?php print $_SESSION['FirstName'] ?>! Tell us what you love eating!</p>
            <div class="checkbox">
                <label><input type="checkbox" name="LikesHawaiian" value="TRUE" class="form-control">I love Hawaiian!</label></div>
            <div class="checkbox"><label><input type="checkbox" name="LikesSupreme" value="TRUE" class="checkbox">I love Supreme!</label></div>
            <div class="checkbox"><label><input type="checkbox" name="LikesGarlicBread" value="TRUE" class="checkbox">I love Garlic Bread!</label></div>
            <input class="btn btn-lg btn-success" type="submit" name="submit" value="To the (Marketing) Cloud!!">
        </form>
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

