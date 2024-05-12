<!DOCTYPE html>
    <html>
        <head>
        
        </head>
        <body>
            <?php
                $userId = $_REQUEST['user'];
                echo "<p id='user'>$userId</p>";
                $path = "../userData/app.json";
                $json = file_get_contents($path);
                $jsonData = json_decode($json,true);
                echo $jsonData;
                
                if (isset($jsonData["$userId"])) {
                    echo "What!";
                } else {
                    echo "give me a second!";
                    $jsonEncode = new stdClass();
                    $sql = "SELECT * FROM UserInfo where userName='$userId'";
                    include("../config/config.php");
                    $result = $mysqli->query($sql);
                    $row = $result->fetch_assoc();
                    $jsonEncode->fName = $row['firstName'];
                    $jsonEncode->lName = $row['lastName'];
                    $jsonEncode->uName = $row['userName'];
                    $jsonEncode->uEmail = $row['userEmail'];
                    $newJson = json_encode($jsonEncode);
                    $finalString = ",\"$userId\": $newJson";
                    // $file = fopen($path, 'a');
                    $lines = file($path);
                    array_splice($lines,2,0,$finalString);
                    echo $lines;
                    file_put_contents($path,implode('',$lines));
                    // fclose($file);
                }
                //last updated 5/12/24 Broomy
                
            ?>
            <!-- <p id ="json"></p> -->
            <p id="gotchu"></p>
            <script>
                let userName = document.getElementById("user").innerHTML;
            //     fetch('../userData/app.json')
            // .then(response => response.json())
            // .then(data => 
            // document.getElementById("json").innerHTML = data[`${userName}`].name
            // )
            // .catch(error => console.error('Error fetching JSON:', error))
            // function grabFile() {
            //     let file = document.getElementById("files").files;
            //     console.log(file);
            // }
            
            </script>
</body>
</html>