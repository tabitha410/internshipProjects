<?php 

// Establish a connection 
$conn = mysqli_connect("localhost","root","","fooddeliverydb");

if($conn){
    // echo "Connected successfully<br>";
} else{
    echo "Not Connected.<br>".mysqli_connect_error($conn);
}


//Insert records
if(isset($_POST["insert"])){
    $customer_id = $_POST["customer_id"];
    $order_id = $_POST["order_id"];
    $driver_name = $_POST["driver_name"];
    $contact_info = $_POST["contact_info"];
    $transport_means = $_POST["transport_means"];
    $current_location = $_POST["current_location"];
    $delivery_time = $_POST["delivery_time"];

    $query = "INSERT INTO delivery (customer_id,order_id,driver_name,contact_info,transport_means,current_location,delivery_time) 
    VALUES ('$customer_id','$order_id','$driver_name','$contact_info','$transport_means','$current_location','$delivery_time')";

    $runquery = mysqli_query($conn,$query);

    if($runquery){
        echo "Records inserted successfully";
    } else{
        die("Not Inserted".mysqli_connect_error($conn));
    }  
}
          

//Get records(array method)
function getRecord($conn, $query){
    $runquery = mysqli_query( $conn, $query);

    if(!$runquery){
        die ("Could not get records<br>".mysqli_error($conn));
    } else{
        // echo "Records found: ".mysqli_num_rows($runquery)."<br>";
    }
    return $runquery;
}
if(isset($_POST["retrieve"])){
    $query = "SELECT * FROM `delivery`;";
    $runquery = getRecord($conn, $query);

    echo "<table class='table table-responsive'><tr><th>Order id</th><th>Driver Name</th><th>Contact Info</th><th>Transport means</th><th>Action</th></tr>";
    $results = "";
    while($row = mysqli_fetch_array($runquery)){
        $results .= "<tr><td>".$row["order_id"]."</td>";
        $results .= "<td>".$row["driver_name"]."</td>";
        $results .= "<td>".$row["contact_info"]."</td>";
        $results .= "<td>".$row["transport_means"]."</td><td><button class='btn btn-primary view-record' order_id='".$row["order_id"]."'>View</button></td></tr>";
    }
    echo $results;

    echo "</table>";
}

//get single record
if(isset($_POST["getsinglerecord"])){
    $order_id = $_POST["order_id"];
    $query = "SELECT * FROM `delivery` WHERE order_id=$order_id ";
    $runquery = mysqli_query($conn, $query);
    if(!$runquery){
        die(mysqli_connect_error($conn));
    }
    $row = mysqli_fetch_array($runquery);
    $list = $row["id"].";".$row["driver_name"].";".$row["contact_info"].";".$row["transport_means"].";".$row["customer_id"].";".$row["current_location"].";".$row["delivery_time"];
    //turns the record into an array and stores it in variable 'list'
    echo $list;
}



?>