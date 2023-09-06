<!DOCTYPE html>
<html>
<head>
<base href="http://localhost//dbms_proj//">
    <title>Movie List</title>
    <link rel="stylesheet" type="text/css" href="watchlist.css">
</head>
<body>
    <h1>Movie List</h1>
    <div class="watchlist">
    <form action="add_to_watchlist.php" method="POST">
        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $conn = mysqli_connect("localhost", "root", "", "movierecommendation");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM movies";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div>';
            echo '<input type="checkbox" name="selected_movies[]" value="' . $row['movie_id'] . '">';
            echo '<label>';
            echo $row['title'] . ' (' . $row['release_date'] . ')';
            echo '</label>';
            echo '</div>';
        }

        mysqli_close($conn);
        ?>
        <button type="submit">Add Selected Movies to Watchlist</button>
    </form>
    </div>
	<button onclick="showWatchList()">Show WatchList</button>
	<script>
	function showWatchList(){
		window.location.href="get_movie.php";
	}
</script>
</body>
</html>
