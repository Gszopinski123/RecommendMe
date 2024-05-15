<!DOCTYPE html>
<html>
    <body>
        <img id="anchor" src=""></img>
        <p id="help"></p>
        <?php 
            $path = "/var/www/html/userData/";//path to save the file to
            $formalPath = "../userData/";//path to access the file
            $jsonFile = "../userData/app.json";//the json file with all the user data
            $fileName = str_replace(" ","",$_FILES["file"]["name"]);//remove all spaces from filename for easier access
            $fileName = str_replace("'","",$fileName);
            echo $fileName;
            $finalPath = $path . $fileName;//final path to save it to
            $phpPath = $formalPath . $fileName;//final path to access the file
            $userName = $_POST['user'];//check the user
            if(isset($_POST['post'])) {//set what type of post it is
                $type = $_POST['post'];
            } else {
                $type = $_POST['picture'];
            }

            $json = file_get_contents($jsonFile);//open json file
            $jsonDecode = json_decode($json,true);//decode the file
            if ($type == "picture") {//see what type the file is suppose to go under as
                $jsonDecode["$userName"]['profilePic'] = $phpPath;
            } else { 
                echo count($jsonDecode["$userName"]["posts"]);
                $jsonDecode["$userName"]["posts"][] = "$phpPath"; 
            }
            $jsonEncode = json_encode($jsonDecode,JSON_PRETTY_PRINT);//prepare for the data to go back to the json file
            file_put_contents($jsonFile,$jsonEncode . "\n");//save the newly added data
            if (move_uploaded_file($_FILES["file"]["tmp_name"],$finalPath)) {//upload the file to the server
            } else {
                echo "Try Again Later";
            }
            header("location: http://192.168.1.91/profiles/profile.php?user=$userName",true, 301);//return to the users page
            //last updated 5/15/24 Broomy
        ?>
        </body>
    </html>