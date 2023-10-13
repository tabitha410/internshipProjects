<?php


$conn = mysqli_connect("localhost", "root", "", "complete_impact_db");

if($conn){
    echo "Connection Successful";
} else {
    echo "Try Again. Not Connected"
}





?>