<!DOCTYPE html>
    <html>
        <head>
        <link rel="stylesheet" href="style.css">
        </head>
        <body>
        <?php 
        if (isset($_REQUEST['user'])) {//this will is used to make sure pages for not existant users are entered
            if($_REQUEST['user'] == '') {//one case
                header("Location: http://192.168.1.91/Home/home.php",true,301);//redirect
            }
            $userId = strtolower($_REQUEST['user']);//make all the usernames lowercase so we dont have a problem where there are mutliple different types of the same user
        } else {
            header("Location: http://192.168.1.91/Home/home.php",true,301);//redirect if there is no user tag
        }
        echo "<title>$userId's Page!</title>";//title specific to the user
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
                }//nav bar for easy access accross the website
                session_start();
                if (isset($_SESSION['loggedin'])) {
                    if ($_SESSION['loggedin']) {
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
                
                session_start();//start to allow the user to remove aspects of their profile
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {//do some checks make sure the user is even logged in first
                    if ($_SESSION['username'] == $userId) {//check their userId
                        echo "<p class='fixed'>
                        <a href='remove.php?profile=1&user=$userId'>Remove Profile Picture</a><br>
                        ".$jsonData["$userId"]["fName"]." ". $jsonData["$userId"]["lName"] . "
                        <br>Contact at: ". $jsonData["$userId"]['uEmail'] .
                        "</p>";
                    } else {//if they dont match dont allow them to edit
                        echo "<p class='fixed'>
                        ".$jsonData["$userId"]["fName"]." ". $jsonData["$userId"]["lName"] . "
                        <br>Contact at: ". $jsonData["$userId"]['uEmail'] .
                        "</p>";
                    }
                } else {//if they are not even logged in dont allow them to edit it
                    echo "<p class='fixed'>
                    ".$jsonData["$userId"]["fName"]." ". $jsonData["$userId"]["lName"] . "
                    <br>Contact at: ". $jsonData["$userId"]['uEmail'] .
                    "</p>"; 
                }
                echo "<h1 id='center'>". $jsonData["$userId"]['uName'] ."</h1>";//print username
                echo "<h2 id='center'>". $jsonData["$userId"]['fName'] ." ". $jsonData["$userId"]['lName'] ."</h2>";//print the first name and last name
                echo "<br><br><br>";//make some line breaks
                $arr = $jsonData["$userId"]['posts'];//get the array for posts
                $arrlen = sizeof($jsonData["$userId"]['posts']);//get the number of posts
                session_start();
                echo "<div class='centerItems'>";
                for ($i =0; $i< $arrlen; $i++) {//loop through the posts
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {//see if the user is logged in before allowing them to edit
                        if ($_SESSION['username'] == $userId) {//if the usernames match allow them to edit
                            echo "<div class='item".(($i%2)+1)."'>";
                            echo "<p>Remove this <a href='remove.php?post=$i&user=$userId'>click here!</a></p>";
                            print "<iframe src=".$arr[$i]."></iframe>";//printout all the posts
                            echo "</div>";
                        } else {//if usernames dont match dont let them edit
                            echo "<div class='item".(($i%2)+1)."'>";
                            print "<iframe src=".$arr[$i]."></iframe>";//printout all the posts
                            echo "</div>";
                        }
                    } else {//if they arent even logged in do not let them touch
                        echo "<div class='item".(($i%2)+1)."'>";
                        print "<iframe src=".$arr[$i]."></iframe>";//printout all the posts
                        echo "</div>";
                    }
                    
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