<?php
    if (isset($_REQUEST['user']) && isset($_REQUEST['post'])) {//check what type of post is being deleted
            session_start();//check make sure they have the correct username
            if ($_SESSION['username']==$_REQUEST['user']) {//check
                $userId = $_REQUEST['user'];//save post number and username
                $post = $_REQUEST['post'];
                $jsonFile = "../userData/app.json";//the json file with all the user data
                $json = file_get_contents($jsonFile);//open json file
                $jsonDecode = json_decode($json,true);//decode the file
                $arr = $jsonDecode["$userId"]['posts'];//save array
                $newArr = array();//make a new array
                for ($i = 0, $j = 0; $i < sizeof($arr); $i++) {
                    if ($i == $post) {//loop through posts
                        ;
                    } else {//save the posts the user wants to keep into a new array
                        $newArr[$j] = $arr[$i];
                        $j++;
                    }
                }
                $jsonDecode["$userId"]['posts'] = $newArr;//save the data as the new array
                $jsonEncode = json_encode($jsonDecode,JSON_PRETTY_PRINT);//prepare for the data to go back to the json file
                file_put_contents($jsonFile,$jsonEncode . "\n");//save the newly added data
                header("Location: http://192.168.1.91/profiles/profile.php?user=$userId");//redirect
            } else {
                header("Location: http://192.168.1.91/Home/home.php");//redirect if the usernames do not match
            }
    } else if (isset($_REQUEST['user']) && isset($_REQUEST['profile'])) {//different type of content being removed
        session_start();
        if ($_SESSION['username'] == $_REQUEST['user']) {//check the usernames
            $userId = $_REQUEST['user'];//save the username
            $jsonFile = "../userData/app.json";//the json file with all the user data
            $json = file_get_contents($jsonFile);//open json file
            $jsonDecode = json_decode($json,true);//decode the file
            $jsonDecode["$userId"]['profilePic'] = "";//reset the profile picture data
            $jsonEncode = json_encode($jsonDecode,JSON_PRETTY_PRINT);//prepare for the data to go back to the json file
            file_put_contents($jsonFile,$jsonEncode . "\n");//save the newly added data
            header("Location: http://192.168.1.91/profiles/profile.php?user=$userId");//redirect to the usrs page
        } else {
            header("Location: http://192.168.1.91/Home/home.php");//redirect to home
        }
    } else {
        header("Location: http://192.168.1.91/Home/home.php");//redirect to home
    }
    
?>