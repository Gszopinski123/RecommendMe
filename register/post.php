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
                $username = strtolower($_POST['user']);//get the username
                $userEmail = $_POST['email'];//get the email
                $userPassword = $_POST['pass'];//get the password
                $hashPassword = password_hash($userPassword, PASSWORD_DEFAULT);//hash the password for security purposes
                $sqlCheck = "SELECT * FROM UserInfo WHERE userName='$username'";
                $sqlPost = "INSERT INTO UserInfo (firstName, lastName, userName, userEmail, password) VALUES ('$firstName','$lastName','$username','$userEmail','$hashPassword')";//run this query
                try {
                    include('../config/config.php');//get db info from config file
                    $result = $mysqli->query($sqlCheck);
                    $row = $result->fetch_assoc();
                    if (!($row['userName'])) {
                        if ($mysqli->query($sqlPost)) {//run the query if executed will
                            echo "You're all Set!";//return this
                            if (isset($_COOKIE['username'])) {
                                setcookie('username',"", time() - 3600,'/');
                            }
                            setcookie('username',"$userEmail $userPassword", time() + 60 * 60 * 24 * 7,'/');//will store a cookie in users browser
                            session_start();
                            if (isset($_SESSION['loggedin'])) {
                                if ($_SESSION['loggedin']) {
                                    $_SESSION['loggedin'] = 0;
                                    header("location: http://192.168.1.91/login/login.php", true, 301);
                                } else {
                                    header("location: http://192.168.1.91/login/login.php", true, 301);
                                }
                            } else {
                                header("location: http://192.168.1.91/login/login.php", true, 301);
                            }
                        }
                        
                    } else {
                        header("Location: http://192.168.1.91/login/index.php?exists=1");
                    }
                } catch (Exception $e) {//catch just in case
                    echo $e;
                }
                //last updated 5/15/24 Broomy
            ?>
    </body>
    </html>