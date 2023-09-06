<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "User ID not found.";
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "movierecommendation");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$watchlist_query = "
    SELECT m.title
    FROM movies m
    JOIN watchlist w ON m.movie_id = w.movie_id
    WHERE w.user_id = '$user_id';
";

$watchlist_result = mysqli_query($conn, $watchlist_query);

if (!$watchlist_result) {
    die("Query failed: " . mysqli_error($conn));
}

$watchlistContent = "";
while ($row = mysqli_fetch_assoc($watchlist_result)) {
    $watchlistContent .= "<p>" . $row['title'] . "</p>";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
<base href="http://localhost//dbms_proj//">
    <title>My Watchlist</title>
    <link rel="stylesheet" type="text/css" href="get_movie.css">
</head>
<body>
    <div class="form">
    <h1>Your Watchlist</h1>
    <?php echo $watchlistContent; ?>
</div>
</body>
</html>
