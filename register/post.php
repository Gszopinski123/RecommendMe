<!DOCTYPE html>
    <html>
        <head>
        <title>Welcome!</title>
        </head>
        <body>
            <?php//here we will take the information 
                $firstName = $_POST['first'];//get the firstname
                $lastName = $_POST['last'];//get the lastname
                $username = $_POST['user'];//get the username
                $userEmail = $_POST['email'];//get the email
                $password = $_POST['pass'];//get the password
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);//hash the password for security purposes
                $sqlPost = "INSERT INTO UserInfo (firstName, lastName, userName, userEmail, password) VALUES ('$firstName','$lastName','$username','$userEmail','$hashPassword')";//run this query
                try {
                    include('../config/config.php');//get db info from config file
                    if ($mysqli->query($sqlPost)) {//run the query if executed will
                        echo "You're all Set!";//return this
                    }
                } catch (Exception $e) {//catch just in case
                    echo $e;
                }
            ?>
    </body>
    </html>