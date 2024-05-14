<!DOCTYPE html>
    <html>
        <head>
        <link rel="stylesheet" href="style.css">
        </head>
        <body>
        <?php $userId = $_REQUEST['user'];?>
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
                echo "<p id='user'>$userId</p>";//testing
                echo $jsonData["$userId"]['fName'];
                echo " ";
                echo $jsonData["$userId"]['lName'];
                echo "\n";
                $picture = $jsonData["$userId"]["profilePic"];
                echo "<img src='$picture'></img>";
                $pdf = $jsonData["$userId"]["posts"][0];
                echo "<iframe src='$pdf'></iframe>";
                //last updated 5/14/24 Broomy
            ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
            Select Profile Picture to upload:
            <input type="file" name="file" id="file">
            <input type="submit" value="Upload Image" name="submit">
            <input type="hidden" name="user" value="<?php print $userId?>">
            <input type="hidden" name="picture" value="picture">
            </form>
            <br><br><br><br><br>
            <form action="upload.php" method="post" enctype="multipart/form-data">
            Select Post to upload:
            <input type="file" name="file" id="file">
            <input type="submit" value="Upload Image" name="submit">
            <input type="hidden" name="user" value="<?php print $userId?>">
            <input type="hidden" name="post" value="post">
            </form>
</body>
</html>