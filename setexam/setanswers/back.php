<?php 

$conn = mysqli_connect("localhost","root","","equiz");

if($conn){
    // echo "connection successful<br>";
} else{
    echo "Not connected<br>".mysqli_connect_error($conn);
}

//add records
if(isset($_POST["add"])){
    $questionsid = $_POST["questionid"];
    $answers = $_POST["answers"];
    $exhibit= $_POST["exhibit"];

    $query = "INSERT INTO answers(questionsid, answers, exhibit) VALUES('$questionsid','$answers','$exhibit')";
    $runquery = mysqli_query($conn, $query);
    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    } else{
        echo "Inserted successfully";
    }
}

//delete records
if (isset($_POST["deleteRecord"])){
    $id = $_POST["id"];
    $query = "DELETE FROM answers WHERE id=$id";
    $runquery = mysqli_query($conn, $query);

    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    }
}

//update records
if (isset($_POST["updateRecord"])){
    $id = $_POST["id"];
    $updatedAnswer = $_POST["updatedAnswer"];
    $updatedExhibit = $_POST["updatedExhibit"];

    $query = "UPDATE answers SET answers='$updatedAnswer', exhibit='$updatedExhibit' WHERE id=$id";
    $runquery = mysqli_query($conn, $query);

    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    }   
}


//retrieve records
if(isset($_POST["obtain"])){
    $questionsid = $_POST["questionid"];
    $query = "SELECT id, questionsid, answers, exhibit, entrydate FROM `answers` WHERE questionsid=$questionsid";
    $records = mysqli_query($conn, $query);

    echo "<table class='table table-responsive'><tr><th>ID</th><th>Question ID</th><th>Answers</th><th>Exhibit</th><th>Entry Date</th><th>Action</th></tr>";
            
    if (mysqli_num_rows($records) > 0){
        while($row = mysqli_fetch_assoc($records)){
            echo "<tr><td>".$row["id"]."</td>";
            echo "<td>".$row["questionsid"]."</td>";
            echo "<td>".$row["answers"]."</td>";
            echo "<td>".$row["exhibit"]."</td>";
            echo "<td>".$row["entrydate"]."</td><td><button class='btn btn-success edit-record' data-id='".$row["id"]."'>Edit</button></td></tr>";

        }
    }  else{
        echo "No records found";
    }
    echo "</table>";
}

//edit record
if(isset($_POST["editRecord"])){
    $id = $_POST["id"];
    $query = "SELECT * FROM answers WHERE id=$id";
    $runquery = mysqli_query($conn, $query);
    
    if(!$runquery){
        die(mysqli_connect_error($conn));
    }
    $row = mysqli_fetch_assoc($runquery);
    $list = $row["id"].";".$row["questionsid"].";".$row["answers"].";".$row["exhibit"].";".$row["entrydate"];

    echo $list;
}



//
if(isset($_POST["getQuestion"])){
    $query = "SELECT * FROM questions";
    $runquery = mysqli_query($conn, $query);
    $questionarray = array();
    while($row=mysqli_fetch_array($runquery)){
        $questionitem = array(
            "id" => $row['id'],
            "question" => $row['question'],
            "entrydate" => $row['entrydate']
        );
        
        array_push($questionarray, $questionitem);
    }

    echo json_encode($questionarray);    
}
?>