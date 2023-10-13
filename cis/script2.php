<?php

$conn = mysqli_connect("localhost","root","","complete_impact_db");

if($conn){
    echo "Connection sucessful<br>";
} else{
    echo("Connection not sucessful. Try again<br>".mysqli_connect_error($conn));
}

function insertRecord ($sql,$conn){
    $run_sql = mysqli_query ($sql,$conn);
    if ($run_sql){
        echo "Record inserted successfully<br>";
    } else{
        die("Record cannot be inserted<br>".mysqli_error($conn));
    }
}

function getRecordArray($sql,$conn){
    $run_sql = mysqli_query($sql,$conn);
 
    if ($run_sql){
        echo mysqli_num_rows($run_sql)." record(s) found;<br><br>";
    } else{
        die("Could not get record<br>".mysqli_error($conn));
    }
    return $run_sql;
}

$sql = "SELECT * FROM `teachers`;";
$run_sql = getRecordArray($conn,$sql);

$records = "";
while($row = mysqli_fetch_array($run_sql)){
    $records .= $row["first_name"]."  ";
    $records .= $row["last_name"]."<br>";
}
echo $records;




?>