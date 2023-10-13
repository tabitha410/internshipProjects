<?php


$conn = mysqli_connect("localhost", "root", "", "complete_impact_db");

if($conn){
    echo "Connection Successful<br>";
} else {
    echo "Try Again. Not Connected<br>";
}


function insertRecord($sql, $conn) {

    $run_sql = mysqli_query($conn, $sql);

    if(!$run_sql){
        die("Could not insert record ".mysqli_error($conn));
    } else {
        echo "Record inserted<br>";
    }
}

function getRecordArray($sql, $conn) {
    $run_sql = mysqli_query($conn, $sql);

    
    if(!$run_sql){
        die("Record not found ".mysqli_error($conn));
    } else {

        echo mysqli_num_rows($run_sql)." Record(s) Found<br>";;
    }

    return $run_sql;

}

$sql = "SELECT * FROM `teachers`;";
$run_sql = getRecordArray($sql, $conn);


$records = "";
while($row = mysqli_fetch_array($run_sql)){
    $records .= $row["first_name"]."  ";
    $records .= $row["last_name"].":"."<br>";
    $records .= $row["subjects_taught"]."<br><br>";
}

echo $records;


// create new record in database
// $sql = "INSERT INTO `teachers` (id, first_name, last_name, gender, address, contact_info, subjects_taught) 
//         VALUES(NULL,'amarachi','okeke','female','32, JS Road','09072718381','biology' )";

// insertRecord($sql, $conn);

// $run_sql = mysqli_query($conn, $sql);

// if(!$run_sql){
//     die("Could not insert record ".mysqli_error($conn));
// } else {
//     echo "Record inserted";
// }
// // creating another new record
// $sql = "INSERT INTO `teachers` (id, first_name, last_name, gender, address, contact_info, subjects_taught ) 
//         VALUES(NULL,'adaeze','testimony','female','4, DBC street','08012358945','english')";

// $run_sql = mysqli_query($conn, $sql);

// if($run_sql){
//     echo "Record insertion successful";
// } else{
//     die("Record could not be inserted".mysqli_error($conn));
// }
// // another new record
// $sql = "INSERT INTO `teachers` (id, first_name, last_name, gender, address, contact_info, subjects_taught ) 
//         VALUES(NULL,'alban','ayooluwa','male','7, abc street','07018350043','biology, physics')";

// $run_sql = mysqli_query($conn, $sql);

// if(!$run_sql){
//     die("Record could not be inserted".mysqli_error($conn));
// } else{
//     echo "Record insertion successful";
// }
?>