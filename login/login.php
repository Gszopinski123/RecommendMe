<!DOCTYPE html>
    <html>
        <head>
            <title>Login!</title>
        </head>
        <body>
            <form method="POST" action="login.php"><!-- this form on submit will send right back to this page where the php will be executed--> 
                <input type="text" name="email" placeholder="Email"><br><!--user will enter email -->
                <input type="password" name="pass" placeholder="Password"><br><!--user will enter their password -->
                <input type="submit"><!-- on click the php will be executed -->
            </form><!--end of form -->
            <?php //start php
                $email = $_POST['email'];//get the inputted email 
                $pass = $_POST['pass'];//get the inputted password
                $sql = "SELECT password from UserInfo WHERE userEmail='$email'";//sql statement to get the associated password
                try {
                    include('../config/config.php');//get the login info from config
                    $result = $mysqli->query($sql);//run the query and get the information
                    $row = $result->fetch_assoc();//now run the rows
                    if (password_verify($pass,$row['password'])) {//get the password column and check it against the inputted password
                        header("Location: http://192.168.1.91/login/Welcome.php", true, 301);//if password is correct redirect
                    }
                } catch (Exception $e) {//just in case
                    echo $e;
                }
            ?>
        </body>
    </html>