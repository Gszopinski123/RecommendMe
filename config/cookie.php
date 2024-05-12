<?php
    //cookie file makes it easier for a use to log back in after being away
    if (isset($_COOKIE['username'])) {//check if there is a cookie
        $next = 1;//to seperate password and email
        $userPassword ="";//save password
        $userEmail = "";//save email
        $cookie = $_COOKIE['username'];//store cookie text
        $chars = str_split($cookie);//for iterating over the string
        foreach ($chars as $char) {//start loop
            if ($char == ' ') {//when we hit a space there its time to switch to password and username
                $next = 0;//to make the switch
            } else if ($next) {//catenate character to each string
                $userEmail = "$userEmail$char";//concatenate
            } else {
                $userPassword = "$userPassword$char";//concatenate
            }
        }
    }
    //last updated 5/12/24 Broomy
?>