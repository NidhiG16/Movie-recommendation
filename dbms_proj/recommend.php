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

$sql = "
SELECT m.title, g.genre_name
FROM movies m
JOIN genres g ON m.genre_id = g.genre_id
JOIN (
    SELECT AVG(rating) AS user_avg_rating, m.genre_id
    FROM ratings r
    JOIN movies m ON r.movie_id = m.movie_id
    WHERE r.user_id = '$user_id'
    GROUP BY m.genre_id
) user_ratings ON m.genre_id = user_ratings.genre_id
WHERE m.movie_id NOT IN (
    SELECT movie_id
    FROM ratings
    WHERE user_id = '$user_id'
)
AND user_ratings.user_avg_rating >= (
    SELECT AVG(rating)
    FROM ratings
    WHERE movie_id IN (
        SELECT movie_id
        FROM ratings
        WHERE user_id = '$user_id'
    )
)";

$result = $conn->query($sql);
$recommendations = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recommendations[] = $row;
    }
} else {
    $recommendations[] = ["title" => "No recommendations found.", "genre_name" => ""];
}

$conn->close();
echo json_encode($recommendations);

?>
