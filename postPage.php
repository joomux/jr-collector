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
             
                echo '<p><label for="'.$name.'_field">'.$label.'<label></p><p><input name="'.$name.'_viewer" type="text" value="'.$_SESSION[$name].'" disabled id="'.$name.'_field"></label><input type="hidden" name="'.$name.'" value="'.$_SESSION[$name].'">';
            }
            
            ?>
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

