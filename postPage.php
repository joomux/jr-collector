<?php
session_start();

?>
<!doctype html>
<html>
    <head><title>Submit to Marketing Cloud</title></head>
    <body>
        <form action="populateDE.php" method="POST">
            <?php
            
            $fields = array("FirstName"=>"First Name","LastName"=>"Last Name","DOB"=>"Date of Birth","FacebookUserId"=> "Facebook User ID","Gender"=>"Gender","EmailAddress"=>"Email Address");
            foreach($fields as $name=>$label) {
             
                echo '<input type="hidden" name="'.$name.'" value="'.$_SESSION[$name].'">';
            }
            
            ?>
            <p>Hi, <?php print $_SESSION['FirstName'] ?>! Tell us what you love eating!</p>
            <ul>
                <li><label><input type="checkbox" name="LikesHawaiian" value="1">I love Hawaiian!</label></li>
                <li><label><input type="checkbox" name="LikesSupreme" value="1">I love Supreme!</label></li>
                <li><label><input type="checkbox" name="LikesGarlicBread" value="1">I love Garlic Bread!</label></li>

            </ul>
            <p><input type="submit" name="submit" value="To the (Marketing) Cloud!!"></p>
        </form>
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

