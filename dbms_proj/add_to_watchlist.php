<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "movierecommendation");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        echo "User ID not found.";
        exit; 
    }

    if (isset($_POST['selected_movies']) && is_array($_POST['selected_movies'])) {
        foreach ($_POST['selected_movies'] as $movie_id) {
            $insert_query = "INSERT INTO watchlist (user_id, movie_id) VALUES ('$user_id', '$movie_id')";
            mysqli_query($conn, $insert_query);
        }
        echo '<meta http-equiv="refresh" content="2;url=watchlist.php">';
    } else {
        echo "No movies selected.";
    }

    mysqli_close($conn);
}
?>
