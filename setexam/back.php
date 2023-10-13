<?php 

$conn = mysqli_connect("localhost","root","","equiz");

if($conn){
    // echo "connection successful<br>";
} else{
    echo "Not connected<br>".mysqli_connect_error($conn);
}

if(isset($_POST["click"])){
    // echo "clicked";
    $exam = $_POST["exam"];
    $description = $_POST["description"];
    $examdate = $_POST["examdate"];
    $entrydate = $_POST["entrydate"];

    $query = "INSERT INTO exam(exam, description, examdate, entrydate) VALUES('$exam','$description','$examdate','$entrydate')";
    $runquery = mysqli_query($conn, $query);
    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    } else{
        echo "Inserted successfully";
    }
}



?>