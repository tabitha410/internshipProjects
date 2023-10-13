<?php 

$conn = mysqli_connect("localhost","root","","timer");

if($conn){
    // echo "connection successful<br>";
} else{
    echo "Not connected<br>".mysqli_connect_error($conn);
}

if(isset($_POST["click"])){
    // echo "I was clicked"."<br>";
    if(isset($_POST["hours"]) && isset($_POST["minutes"]) && isset($_POST["seconds"])){
        $hours = $_POST["hours"];
        $minutes = $_POST["minutes"];
        $seconds = $_POST["seconds"];
        $currentCountdownTime = $_POST["currentCountdownTime"];

        $total_time = sprintf("%02d:%02d:%02d",$hours, $minutes, $seconds);
        // echo "Total Time: ".$total_time."<br>";
        // echo "Current Time: ".$currentCountdownTime."<br>";

        //convert total time and current time to seconds
        $total_time_secs = strtotime($total_time) - strtotime("00:00:00");
        $current_time_secs = strtotime($currentCountdownTime) - strtotime("00:00:00");

        $time_elapsed_secs = $total_time_secs - $current_time_secs;

        //convert time elapsed to hh:mm:ss format
        $time_elapsed = gmdate("H:i:s", $time_elapsed_secs);

        // echo "Time elapsed: ".$time_elapsed . "<br>";


        
        $query = "INSERT INTO user_time(total_time,curr_time,time_elapsed) VALUES('$total_time','$currentCountdownTime','$time_elapsed')";
        $runquery = mysqli_query($conn, $query);
        if(!$runquery){
            die("Error: ".mysqli_connect_error($conn));
        } else{
            // echo "Inserted successfully";
        }
    }
}



if(isset($_POST["currTime"])){
    $currTime = $_POST["currTime"];
    $query = "SELECT * FROM user_time WHERE curr_time = '$currTime'";
    if($currTime=="currTime"){
        $query = "SELECT * FROM user_time ORDER BY id DESC LIMIT 1";
    } else {
        // do nothing
    }
    
    $runquery = mysqli_query($conn, $query);

    if(!$runquery){
        die(mysqli_connect_error($conn));
    }
    $row = mysqli_fetch_assoc($runquery);
    $list = $row["curr_time"];
    echo $list;
}




















?>