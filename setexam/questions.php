<?php 

$conn = mysqli_connect("localhost","root","","equiz");

if($conn){
    // echo "connection successful<br>";
} else{
    echo "Not connected<br>".mysqli_connect_error($conn);
}


//add records
if(isset($_POST["submit"])){
    $examid = $_POST["examid"];
    $question = $_POST["question"];
    $questiontype = $_POST["questiontype"];
    // $entrydate = $_POST["entrydate"];
    $exhibit = $_POST["exhibit"];

    $query = "INSERT INTO questions(examid, question, questiontype, exhibit) VALUES('$examid','$question','$questiontype','$exhibit')";
    $runquery = mysqli_query($conn, $query);
    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    } else{
        echo "Inserted successfully";
    }
}


//obtain records
if(isset($_POST["retrieve"])){
    $examid = $_POST["examid"];
    $query = "SELECT id, examid, question, questiontype, entrydate, exhibit FROM `questions` WHERE `examid`= '$examid';";
    $records = mysqli_query($conn, $query);

    echo "<table class='table table-responsive'><tr><th>ID</th><th>Exam ID</th><th>Question</th><th>Question Type</th><th>Entry Date</th><th>Exhibit</th><th>Action</th></tr>";
            
    if (mysqli_num_rows($records) > 0){
        while($row = mysqli_fetch_assoc($records)){
            echo "<tr><td>".$row["id"]."</td>";
            echo "<td>".$row["examid"]."</td>";
            echo "<td>".$row["question"]."</td>";
            echo "<td>".$row["questiontype"]."</td>";
            echo "<td>".$row["entrydate"]."</td>";
            echo "<td>".$row["exhibit"]."</td><td><button class='btn btn-success edit-record' data-id='".$row["id"]."'>Edit</button></td></tr>";
            

        }
    }  else{
        echo "No records found";
    }
    echo "</table>";
}


//edit record
if(isset($_POST["editRecord"])){
    $id = $_POST["id"];
    $query = "SELECT * FROM questions WHERE id=$id";
    $runquery = mysqli_query($conn, $query);
    
    if(!$runquery){
        die(mysqli_connect_error($conn));
    }
    $row = mysqli_fetch_assoc($runquery);
    $list = $row["id"].";".$row["examid"].";".$row["question"].";".$row["questiontype"].";".$row["entrydate"].";".$row["exhibit"];

    echo $list;
}

//delete record
if (isset($_POST["deleteRecord"])){
    $id = $_POST["id"];
    $query = "DELETE FROM questions WHERE id=$id";
    $runquery = mysqli_query($conn, $query);

    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    }
}

//update records
if (isset($_POST["updateRecord"])){
    $id = $_POST["id"];
    $updatedQuestion = $_POST["updatedQuestion"];
    $updatedQT = $_POST["updatedQT"];
    $updatedExhibit = $_POST["updatedExhibit"];

    $query = "UPDATE questions SET question='$updatedQuestion', questiontype='$updatedQT', exhibit='$updatedExhibit' WHERE id=$id";
    $runquery = mysqli_query($conn, $query);

    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    }   
}


//
if(isset($_POST['getExamination'])){
    $query = "SELECT * FROM exam";
    $runquery = mysqli_query($conn, $query);
    $examarray = array();
    while($row=mysqli_fetch_array($runquery)){
        $examitem = array(
            "id" => $row['id'],
            "exam" => $row['exam'],
            "examdate" => $row['examdate']
        );
        
        array_push($examarray, $examitem);
    }

    echo json_encode($examarray);
}

?>