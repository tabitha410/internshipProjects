<?php 

$conn = mysqli_connect("localhost","root","","fooddeliverydb");

if($conn){
    // echo "Connection successful<br>";
} else{
    echo "Try again. Not connected<br>".mysqli_connect_error($conn);

}

//Insert Records
if(isset($_POST["insert"])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    $query = "INSERT INTO customers(name,address,phone_number,email,password) VALUES('$name','$address','$phone_number','$email','$password')";
    $runquery = mysqli_query($conn, $query);
    if(!$runquery){
        die("Error: ".mysqli_connect_error($conn));
    } else {
        echo "<br>".$name." has been registered successfully";
    }
}


//Retrieve Records
if(isset($_POST["retrieve"])){
    $query = "SELECT id, name, address, phone_number, email, password FROM `customers`;";
    $records = mysqli_query($conn, $query);

    echo "<table class='table table-responsive'><tr><th>id</th><th>Name</th><th>Address</th><th>Phone Number</th><th>Email</th><th>Action</th></tr>";
            
    if (mysqli_num_rows($records) > 0){
        while($row = mysqli_fetch_assoc($records)){
            echo "<tr><td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["phone_number"]."</td>";
            echo "<td>".$row["email"]."</td><td><button class='btn btn-primary view-record' data-id='".$row["id"]."'>View</button></td></tr>";
            


        }
    }  else{
        echo "No records found";
    }
    echo "</table>";
}


//get single record
if(isset($_POST["getsinglerecord"])){
    $id = $_POST["id"];
    $query = "SELECT * FROM customers WHERE id=$id";
    $run_query = mysqli_query($conn, $query);
    if(!$run_query){
        die(mysqli_connect_error($conn));
    }
    $row = mysqli_fetch_assoc($run_query);
    $list = $row["id"].";".$row["name"].";".$row["address"].";".$row["phone_number"].";".$row["email"].";".$row["password"];
    //turns the record into an array and stores it in variable 'list'
    echo $list;
}

?>