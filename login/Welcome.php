<!DOCTYPE html>
<html>
    <body>
    <?php
        include("../config/cookie.php");
        session_start();//start session to collect data
        if(isset($_SESSION['username'])) {//make sure the session has been started and set
            if ($_SESSION['loggedin']) {
                $firstname = $_SESSION['firstname'];//set firstname var
                $lastname = $_SESSION['lastname'];//set lastname var
                echo "Welcome $firstname $lastname";//printout first and lastname
            } 
            
        } else {//if there hasnt been an established session
            if (isset($_COOKIE['username'])) {
                include("../config/config.php");
                include("../config/cookie.php");
                $sql = "SELECT * from UserInfo WHERE userEmail='$userEmail'";//sql statement to get the associated password
                $result = $mysqli->query($sql);//run the query and get the information
                $row = $result->fetch_assoc();//now run the rows
                if (password_verify($userPassword,$row['password'])) {//get the password column and check it against the inputted password
                    session_start();//session to save users info so they staying across the server
                    $_SESSION['username'] = $row['userName'];//save the username
                    $_SESSION['firstname'] = $row['firstName'];//save the firstname
                    $_SESSION['lastname'] = $row['lastName'];//save the lastname
                    $_SESSION['password'] = $row['password'];//save the password hashed out use for later
                    $_SESSION['useremail'] = $userEmail;//save user email
                    $_SESSION['loggedin'] = 1;//see if the user is logged in
                }
            } else {
                echo "Please Login <a href='login.php'>Here</a>";
            }
        }
        header("Location: http://192.168.1.91/Home/home.php", true, 301);//if password is correct redirect
        //last updated 5/15/24 Broomy
    ?>
    </body>
</html>