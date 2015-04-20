<?php

/* Written by David Coghill with assistance from Jeremy Roberts
 * for Salesforce Marketing Cloud
 * as Proof of Concept only
 */

?><!doctype html>
<html lang="en">
    <head><title>Tell us what you love</title>
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
                $fields = array("FirstName" => "First Name", "LastName" => "Last Name", "DOB" => "Date of Birth", "FacebookUserId" => "Facebook User ID", "Gender" => "Gender", "EmailAddress" => "Email Address");
                foreach ($fields as $name => $label) {

                    echo '<input type="hidden" name="' . $name . '" value="' . $_COOKIE[$name] . '">';
                }
                
                if ($_GET['known']==1) {
                    $message = "Welcome back";
                } else {
                    $message = "It's your first time here";
                }
                
                ?>
                <h1>Hi, <?php print $_COOKIE['FirstName'] ?>!</h1><p class="bg-success"><?php print $message; ?>.</p><p>Tell us what you love eating...</p>
                <div class="row">
                    <div class="col-xs-4">
                        <img src="assets/images/hawaiian.png" alt="Hawaiian" style="max-width:100%">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="LikesHawaiian" value="TRUE" class="checkbox"<?php print ($_COOKIE['LikesHawaiian']=='TRUE'?' checked':''); ?>>I love Hawaiian!</label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <img src="assets/images/supreme.png" alt="Supreme" style="max-width:100%">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="LikesSupreme" value="TRUE" class="checkbox"<?php print ($_COOKIE['LikesSupreme']=='TRUE'?' checked':''); ?>>I love Supreme!</label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <img src="assets/images/garlic-bread.png" alt="Garlic Bread" style="max-width:100%">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="LikesGarlicBread" value="TRUE" class="checkbox"<?php print ($_COOKIE['LikesGarlicBread']=='TRUE'?' checked':''); ?>>I love Garlic Bread!</label>
                        </div>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" name="submit" value="To the (Marketing) Cloud!!">
            </form>
    </body>
</html>

