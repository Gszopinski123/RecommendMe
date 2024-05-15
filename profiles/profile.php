<!DOCTYPE html>
    <html>
        <head>
        <link rel="stylesheet" href="style.css">
        </head>
        <body>
        <?php $userId = strtolower($_REQUEST['user']);?>
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
                    echo "<img id='profilePic'src='../userData/Avatar.jpg'></img>";
                }
                echo "<h1 id='center'>". $jsonData["$userId"]['uName'] ."</h1>";//print username
                echo "<h2 id='center'>". $jsonData["$userId"]['fName'] ." ". $jsonData["$userId"]['lName'] ."</h2>";//print the first name and last name
                echo "<br><br><br>";//make some line breaks
                $arr = $jsonData["$userId"]['posts'];//get the array for posts
                $arrlen = sizeof($jsonData["$userId"]['posts']);//get the number of posts
                for ($i =0; $i< $arrlen; $i++) {//loop through the posts
                    print "<iframe src=".$arr[$i]."></iframe>";//printout all the posts
                }
                //last updated 5/15/24 Broomy
            ?>
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