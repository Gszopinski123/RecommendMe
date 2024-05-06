<!DOCTYPE html>
    <html>
        <head>
        <title>Welcome!</title>
        </head>
        <body>
            <?php
                $firstName = $_POST['first'];
                $lastName = $_POST['last'];
                $username = $_POST['user'];
                $userEmail = $_POST['email'];
                $password = $_POST['pass'];
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $sqlPost = "INSERT INTO UserInfo (firstName, lastName, userName, userEmail, password) VALUES ('$firstName','$lastName','$username','$userEmail','$hashPassword')";
                try {
                    $hostname = 'localhost';
                    $userName = 'loginUser';
                    $password = 'logmeinplease';
                    $database = 'loginInfo';
                    $mysqli = mysqli_connect($hostname, $userName, $password, $database); 
                    if ($mysqli->query($sqlPost)) {
                        echo "You're all Set!";
                    } else {
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            ?>
    </body>
    </html>