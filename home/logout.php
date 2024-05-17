<?php
    include("../config/session.php");//used to check the session to see if they are logged in
    if (isset($_REQUEST['logout'])) {//then we see if the user wants to logout
        session_start();//we start the session
        $_SESSION['loggedin'] = 0;//we set the session to logout
        //echo $_SESSION['loggedin'];//we return that the user is logged out
    }
    if ($_REQUEST['type'] == 0) {
        header("Location: http://192.168.1.91/Home/home.php",true, 301);
    } else if ($_REQUEST['type'] == 1) {
        $userId = $_REQUEST['user'];
        header("Location: http://192.168.1.91/profiles/profile.php?user=$userId",true,301);
    } else if ($_REQUEST['type'] == 2) {
        header("Location: http://192.168.1.91/login/index.php",true,301);
    }
    
    //last updated 5/12/24 Broomy
?>