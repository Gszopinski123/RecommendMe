<!DOCTYPE html lang="en-us">
    <html>
        <head>
        </head>
        <body>
            <?php
                session_start();//session to save users info so they staying across the server
                if (isset($_COOKIE['username']) && (!isset($_SESSION['loggedin']))) {
                    include("../config/cookie.php");
                    include("../config/config.php");
                    $sql = "SELECT * from UserInfo WHERE userEmail='$userEmail'";//sql statement to get the associated password
                    $result = $mysqli->query($sql);//run the query and get the information
                    $row = $result->fetch_assoc();//now run the rows
                    if (password_verify($userPassword,$row['password'])) {
                        $_SESSION['username'] = $row['userName'];//save the username
                        $_SESSION['firstname'] = $row['firstName'];//save the firstname
                        $_SESSION['lastname'] = $row['lastName'];//save the lastname
                        $_SESSION['password'] = $row['password'];//save the password hashed out use for later
                        $_SESSION['useremail'] = $userEmail;//save user email
                        $_SESSION['loggedin'] = 1;//see if the user is logged in
                    }
                }
                include('../config/session.php');//see if a user is logged in or not
                if ($loggedIn) {//if they are logged in allow them to logout
                    echo "<button onclick='phpLogout()'>Click here to logout!</button>";
                } else {//if not allow them to login 
                    echo "<a href='../login/login.php'>Please Login Here</a><br>";
                }
                //last updated 5/12/24 Broomy
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
            <h1>Search For Users!</h1>
            <input id="userText">
            <button onclick="searchForUser()">Search</button>
            <p id="found"></p>
            <script>
                function searchForUser() {
                    let userName = document.getElementById("userText").value;
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        document.getElementById("found").innerHTML = this.responseText;
                    }
                    xhttp.open("GET","search.php?search="+userName);
                    xhttp.send();
                }
            </script>
        </body>
    </html>