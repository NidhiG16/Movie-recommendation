<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movierecommendation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
$password = $_POST['password'];

$check_query = "SELECT user_id FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($check_query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows === 1) {
    
    $_SESSION['user_id'] = $result->fetch_assoc()['user_id'];
    header("Location: rating.html"); 
} else {

    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();
?>
