<?php
    include("../config/session.php");//used to check the session to see if they are logged in
    if (isset($_REQUEST['logout'])) {//then we see if the user wants to logout
        session_start();//we start the session
        $_SESSION['loggedin'] = 0;//we set the session to logout
        echo $_SESSION['loggedin'];//we return that the user is logged out
    }
?>