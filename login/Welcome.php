<!DOCTYPE html>
<html>
    <body>
    <?php
        session_start();//start session to collect data
        if(isset($_SESSION['username'])) {//make sure the session has been started and set
            $firstname = $_SESSION['firstname'];//set firstname var
            $lastname = $_SESSION['lastname'];//set lastname var
            echo "Welcome $firstname $lastname";//printout first and lastname
        } else {//if there hasnt been an established session
            echo 'Please Try again Later!';//tell user to comeback later for user later
        }
    ?>
    </body>
</html>