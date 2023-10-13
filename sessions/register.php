<?php 
$conn = mysqli_connect("localhost","root","","sessions");

if($conn){
    // echo "connection successful<br>";
} else{
    echo "Not connected<br>".mysqli_connect_error($conn);
}

if(isset($_POST["click"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "INSERT INTO `users`(`username`, `password`) VALUES ('{$username}','{$password}')";
    $query = mysqli_query($conn,$sql);
    if($query){
        echo "Registered sucessfully<br>";
    } else{
        echo "Not registered<br>".mysqli_connect_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="new-username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="new-password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" name="click">Register</button>
        </form>
    </div>
</body>
</html>
