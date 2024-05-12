<!DOCTYPE html>
    <html>
        <head>
        <title>Welcome!</title>
        </head>
        <body>
            <?php
                //here we will take the information
                $firstName = $_POST['first'];//get the firstname
                $lastName = $_POST['last'];//get the lastname
                $username = $_POST['user'];//get the username
                $userEmail = $_POST['email'];//get the email
                $userPassword = $_POST['pass'];//get the password
                $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);//hash the password for security purposes
                $sqlPost = "INSERT INTO UserInfo (firstName, lastName, userName, userEmail, password) VALUES ('$firstName','$lastName','$username','$userEmail','$hashPassword')";//run this query
                try {
                    include('../config/config.php');//get db info from config file
                    if ($mysqli->query($sqlPost)) {//run the query if executed will
                        echo "You're all Set!";//return this
                        if (isset($_COOKIE['username'])) {
                            setcookie('username',"", time() - 3600,'/');
                        }
                        setcookie('username',"$userEmail $userPassword", time() + 60 * 60 * 24 * 7,'/');//will store a cookie in users browser
                        header("Location: http://192.168.1.91/login/Welcome.php", true, 301);//will redirect the user
                    }
                } catch (Exception $e) {//catch just in case
                    echo $e;
                }
                //last updated 5/12/24 Broomy
            ?>
    </body>
    </html>