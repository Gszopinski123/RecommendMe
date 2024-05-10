<?php
    include("../config/config.php");
    $userName = $_REQUEST['search'];
    $sql = "select * from UserInfo WHERE userName='$userName';";
    $result = $mysqli->query($sql);//run the query and get the information
    $row = $result->fetch_assoc();//now run the rows
    if ($row['userName']) {
        
        echo "<a href='../profiles/profile.php?user=$userName'>Click Here to view</a>"; 
    } else {
       echo "Not Found";
    }
?>
