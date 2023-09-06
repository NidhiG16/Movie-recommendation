<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movierecommendation";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


$insertQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "User registration successful.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
