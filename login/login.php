<!DOCTYPE html>
    <html>
        <head>
            <title>Login!</title>
        </head>
        <body>
            <form method="POST" action="login.php">
                <input type="text" name="email" placeholder="Email"><br>
                <input type="password" name="pass" placeholder="Password"><br>
                <input type="submit">
            </form>
            <?php 
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $hashPass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "SELECT password from UserInfo WHERE userEmail='$email'";
                try {
                    $hostname = 'localhost';
                    $userName = 'loginUser';
                    $password = 'logmeinplease';
                    $database = 'loginInfo';
                    $mysqli = mysqli_connect($hostname, $userName, $password, $database); 
                    $result = $mysqli->query($sql);
                    $row = $result->fetch_assoc();
                    if (password_verify($pass,$row['password'])) {
                        header("Location: http://192.168.1.91/login/Welcome.php", true, 301);
                    }
                } catch (Exception $e) {
                    echo $e;
                }
            ?>
        </body>
    </html>