<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "online";


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $phone = htmlspecialchars($_POST['phone']);
    $gender = htmlspecialchars($_POST['gender']);
    $dob = htmlspecialchars($_POST['dob']);
    $address = htmlspecialchars($_POST['address']);
    
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, gender, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $hashed_password, $phone, $gender, $dob, $address);
    
   
    if ($stmt->execute()) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Form Submitted</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='form-container'>
                <h2>Submission Successful</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Password:</strong> ******** (hidden for security)</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Gender:</strong> $gender</p>
                <p><strong>Date of Birth:</strong> $dob</p>
                <p><strong>Address:</strong> $address</p>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
