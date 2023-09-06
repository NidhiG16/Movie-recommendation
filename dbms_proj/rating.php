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

$user_id = $_SESSION['user_id'];

$movie_ids = $_POST['movie_id'];
$ratings = $_POST['rating'];

$insert_rating_query = "INSERT INTO ratings (user_id, movie_id, rating) VALUES (?, ?, ?)";
$stmt = $conn->prepare($insert_rating_query);

for ($i = 0; $i < count($movie_ids); $i++) {
    $movie_id = $movie_ids[$i];
    $rating = $ratings[$i];
    
    $stmt->bind_param("iii", $user_id, $movie_id, $rating);
    
    if (!$stmt->execute()) {
        echo "Error adding rating for Movie ID $movie_id: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

header("Location: recommend.html");
?>
