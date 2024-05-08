<?php
    session_start();//this is used to see if the user is still logged in during their session
    if (isset($_SESSION['loggedin'])) {//check to see if they have a session
        $loggedIn = $_SESSION['loggedin'];//set as logged in
    } else {
        $loggedIn = 0;//if not they are not logged in
    } 
?>