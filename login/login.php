<!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="style.css"> 
            <title>Login!</title>
        </head>
        <body>
            
            <?php //start php
                echo "
                <div class='dropdown'>
                    <button class='dropbtn'>Menu</button>
                        <div class='dropdown-content'>
                            <a href='../Home/home.php'>home</a>
                            <a href='../login/login.php'>login</a>
                            <a href='../login/index.php'>register</a>
                        </div>
                </div>
                ";
                $email = $_POST['email'];//get the inputted email 
                $pass = $_POST['pass'];//get the inputted password
                $sql = "SELECT * from UserInfo WHERE userEmail='$email'";//sql statement to get the associated password
                try {
                    include('../config/config.php');//get the login info from config
                    session_start();//start session to check if we are logged in
                    if ($_SESSION['loggedin']) {//will not allow us to login until we are logged out
                        header("Location: http://192.168.1.91/Home/home.php", true, 301);//redirect us
                    }
                    $result = $mysqli->query($sql);//run the query and get the information
                    $row = $result->fetch_assoc();//now run the rows
                    if (password_verify($pass,$row['password'])) {//get the password column and check it against the inputted password
                        session_start();//session to save users info so they staying across the server
                        $_SESSION['username'] = $row['userName'];//save the username
                        $_SESSION['firstname'] = $row['firstName'];//save the firstname
                        $_SESSION['lastname'] = $row['lastName'];//save the lastname
                        $_SESSION['password'] = $row['password'];//save the password hashed out use for later
                        $_SESSION['useremail'] = $email;//save user email
                        $_SESSION['loggedin'] = true;//see if the user is logged in
                        header("Location: http://192.168.1.91/Home/home.php", true, 301);//if password is correct redirect
                    }
                } catch (Exception $e) {//just in case
                    echo $e;
                }
                //last updated 5/16/24 Broomy
            ?>
            <form method="POST" action="login.php"><!-- this form on submit will send right back to this page where the php will be executed--> 
                <input type="email" name="email" placeholder="Email" ><br><!--user will enter email -->
                <input type="password" name="pass" placeholder="Password"><br><!--user will enter their password -->
                <input type="submit"><!-- on click the php will be executed -->
            </form><!--end of form -->
        </body>
    </html>