<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movierecommendation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$movieTitle = $_POST['movie_title'];

$query = "CALL DisplayMovieDetails('$movieTitle')";
$result = $conn->query($query);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<base href="http://localhost//dbms_proj//">
    <title>Movie Details</title>
    <link rel="stylesheet" type="text/css" href="movie_deets.css">
</head>
<body>
    <div class="form">
    <h1>Movie Details</h1>
    <?php
    if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<strong>{$row['movie']}:</strong> {$row['mov']}<br>";
        }
    } else {
        echo "No results found.";
    }
    ?>
    </div>
</body>
</html>
