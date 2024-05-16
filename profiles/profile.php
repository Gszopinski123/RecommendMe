<!DOCTYPE html>
    <html>
        <head>
        <link rel="stylesheet" href="style.css">
        </head>
        <body>
        <?php 
        if (isset($_REQUEST['user'])) {
            if($_REQUEST['user'] == '') {
                header("Location: http://192.168.1.91/Home/home.php",true,301);
            }
            $userId = strtolower($_REQUEST['user']);
        } else {
            header("Location: http://192.168.1.91/Home/home.php",true,301);
        }
        echo "<title>$userId's Page!</title>";
        ?>
            <?php
                $path = "../userData/app.json";//path to access the user data
                $json = file_get_contents($path);//open the file
                $jsonData = json_decode($json,true);//make the data usable
                
                if (isset($jsonData["$userId"])) {//see if there is an entry for the specific user the page is for
                } else {
                    $jsonEncode = new stdClass();//if not we will add all the info from the db and some more for the posts
                    $sql = "SELECT * FROM UserInfo where userName='$userId'";//query
                    include("../config/config.php");//access the db
                    $result = $mysqli->query($sql);//access
                    $row = $result->fetch_assoc();//get info
                    if (!($row["userName"])) {
                        header("Location: http://192.168.1.91/Home/home.php",true,301);
                    }
                    $jsonEncode->fName = $row['firstName'];//add all this info
                    $jsonEncode->lName = $row['lastName'];
                    $jsonEncode->uName = $row['userName'];
                    $jsonEncode->uEmail = $row['userEmail'];
                    $jsonEncode->profilePic = "";
                    $jsonEncode->posts = array();
                    $newJson = json_encode($jsonEncode);//prepare data
                    $finalString = "\"$userId\": $newJson,";//make it accessiable by username
                    $lines = file($path);//access the file the data is going to end up
                    array_splice($lines,1,0,$finalString);//format it so we can keep adding more info to the file for new users
                    file_put_contents($path,implode('',$lines));//finally send off the data
                    header("Refresh:0");//refresh the page
                    
                }
                if ($jsonData["$userId"]['profilePic'] != "") {//see if the user has a photo in their data
                    echo "<img id='profilePic'src=". $jsonData["$userId"]['profilePic']."></img>";
                } else {// if not print default
                    echo "<img id='profilePic' src='../userData/Avatar.jpg'></img>";
                }
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
                echo "<p class='fixed'>
                ".$jsonData["$userId"]["fName"]." ". $jsonData["$userId"]["lName"] . "
                <br>Contact at: ". $jsonData["$userId"]['uEmail'] .
                "</p>";
                echo "<h1 id='center'>". $jsonData["$userId"]['uName'] ."</h1>";//print username
                echo "<h2 id='center'>". $jsonData["$userId"]['fName'] ." ". $jsonData["$userId"]['lName'] ."</h2>";//print the first name and last name
                echo "<br><br><br>";//make some line breaks
                $arr = $jsonData["$userId"]['posts'];//get the array for posts
                $arrlen = sizeof($jsonData["$userId"]['posts']);//get the number of posts
                echo "<div class='centerItems'>";
                for ($i =0; $i< $arrlen; $i++) {//loop through the posts
                    echo "<div class='item".(($i%2)+1)."'>";
                    echo "<p>Item</p>";
                    print "<iframe src=".$arr[$i]."></iframe>";//printout all the posts
                    echo "</div>";
                }
                echo "</div>";
                //last updated 5/16/24 Broomy
            ?>
            <br><br><br><br><br>
            <?php
            session_start();//see who is logged in
            if (isset($_SESSION['loggedin'])) {
                if ($_SESSION['loggedin']) {
                    if ($_SESSION['username'] == $userId) {// if the user is logged in and on their account allow them to submit photos and posts
                        echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
                        echo "Select Profile Picture to upload:";
                        echo '<input type="file" name="file" id="file">';
                        echo "<input type='submit' value='Upload Image' name='submit'>";
                        echo "<input type='hidden' name='user' value='$userId'>";
                        echo "<input type='hidden' name='picture' value='picture'>";
                        echo "</form>";
                        echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
                        echo "Select Post to upload:";
                        echo "<input type='file' name='file' id='file'>";
                        echo "<input type='submit' value='Upload Image' name='submit'>";
                        echo "<input type='hidden' name='user' value='$userId'>";
                        echo '<input type="hidden" name="post" value="post">';
                        echo "</form>";
                    }
                }
            }
            
            ?>
</body>
</html>