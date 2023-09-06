<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movierecommendation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT genre_name, popularity FROM genres";
$result = $conn->query($query);

$genrePopularity = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genrePopularity[] = array(
            "genre_name" => $row["genre_name"],
            "popularity" => $row["popularity"]
        );
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($genrePopularity);
?>
