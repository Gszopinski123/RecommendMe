<!DOCTYPE html lang="en-us">
    <html>
        <head>
        </head>
        <body>
            <?php
                include('../config/session.php');//see if a user is logged in or not
                if ($loggedIn) {//if they are logged in allow them to logout
                    echo "<button onclick='phpLogout()'>Click here to logout!</button>";
                } else {//if not allow them to login 
                    echo "<a href='../login/login.php'>Please Login Here</a><br>";
                }
            ?>
            <script>
                function phpLogout() {//function to be used on click
                    const xhttp = new XMLHttpRequest();//ajax request
                    xhttp.onload = function() {//onload determine if the user is no longer logged in
                    }
                    xhttp.open("GET","logout.php?logout=1",true);//how we are gonna logout the user
                    xhttp.send();//send the info
                    location.reload()//reload the page
                }
            </script>
        </body>
    </html>