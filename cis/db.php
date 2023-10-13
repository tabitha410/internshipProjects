<?php


$conn = mysqli_connect("localhost", "root", "", "complete_impact_db");

    if($conn){
        echo "Connection sucessful<br>";
    } else{
        echo "Unable to connect.Try again<br>".mysqli_connect_error($conn);
    }


?>