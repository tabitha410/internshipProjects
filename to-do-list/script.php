<?php

$conn = mysqli_connect("localhost","root","","to-do-list");

if($conn){
    // echo "connected";
} else{
    echo "Not connected".mysqli_connect_error($conn);
}

if(isset($_POST["click"])){
    echo "I was clicked";
    $task = $_POST["tasks"];
    echo $task;
}





?>
