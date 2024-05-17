<?php
    include("../config/config.php");
    $userName1 = $_REQUEST['search'];
    $sql = "select * from UserInfo WHERE userName='$userName1';";
    $result = $mysqli->query($sql);//run the query and get the information
    $row = $result->fetch_assoc();//now run the rows
    if ($row['userName']) {
        echo "<a href='../profiles/profile.php?user=$userName1'>Click Here to view</a>"; 
    } else {
       echo "Not Found";
    }
    //last updated 5/12/24 Broomy
?>
