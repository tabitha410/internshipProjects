<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Database connection details
    $db_host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'complete_impact_db';
    
        // Create a database connection
        $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
    
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Get form data
        $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $address = mysqli_real_escape_string($conn, $_POST["address"]);
        $contact_info = mysqli_real_escape_string($conn, $_POST["contact_info"]);
        $subjects_taught = mysqli_real_escape_string($conn, $_POST["subjects_taught"]);
    
        // Prepare and execute the SQL query to insert data into the database
        $sql = "INSERT INTO teachers (first_name, last_name, gender, address, contact_info, subjects_taught) 
                VALUES ('$first_name', '$last_name', '$gender', '$address', '$contact_info', '$subjects_taught')";
    
        if (mysqli_query($conn, $sql)) {
            echo "Record inserted successfully!";
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    
        // Close the database connection
        mysqli_close($conn);
    }
    ?>
    
