<!DOCTYPE html lang="en-us">
    <html>
        <head>
            <link rel="stylesheet" href="style.css">
            <title>Home!</title>
        </head>
        <body>
            <?php
            session_start();
            if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['loggedin']) {s
                    $userId = $_SESSION['username'];
                    echo "
                    <div class='dropdown'>
                        <button class='dropbtn'>Menu</button>
                            <div class='dropdown-content'>
                                <a href='../Home/home.php'>home</a>
                                <a href='../profiles/profile.php?user=$userId'>My page</a>
                                <a href='../login/index.php'>register</a>
                                <a href='logout.php?logout=1&type=0'>logout</a>
                            </div>
                    </div>
                    ";
                } else {
                    echo "
                    <div class='dropdown'>
                        <button class='dropbtn'>Menu</button>
                            <div class='dropdown-content'>
                                <a href='../Home/home.php'>home</a>
                                <a href='../login/index.php'>register</a>
                                <a href='../login/login.php'>login</a>
                            </div>
                    </div>
                    ";
                }
            } else {
                echo "
                    <div class='dropdown'>
                        <button class='dropbtn'>Menu</button>
                            <div class='dropdown-content'>
                                <a href='../Home/home.php'>home</a>
                                <a href='../login/index.php'>register</a>
                                <a href='../login/login.php'>login</a>
                            </div>
                    </div>
                    ";
            }
                
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
                    echo "<p class='welcome'>Welcome back ".$_SESSION["firstname"]." ".$_SESSION['lastname']."!</p><br>";
                } else {//if not allow them to login 
                    echo "<p class='welcome'>Welcome!</p><br>";
                }
                //last updated 5/16/24 Broomy
            ?>
            <h1 class="center">Search For Users!</h1>
            <center><input id="userText">
            <button class="center" onclick="searchForUser()">Search</button></center>
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