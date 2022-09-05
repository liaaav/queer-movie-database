<?php
    $con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
    else{
        echo "connected to database";
    }

    $all_movie_rec_query = "SELECT movie.movie_name, movie.movie_id FROM movie, movie_rec WHERE movie.movie_id = movie_rec.movie_id";
    $all_movie_rec_result = mysqli_query($con, $all_movie_rec_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="style.css">
</head>
<body>
<header>
    <nav>
        <a class="button" href="index.php">Home</a>
        <a class="button" href="movies.php">Movies</a>
        <a class="button" href="about_us.php">About Us</a>
        <!-- search bar -->
        <table>
            <form action="search.php" method="post">
                <tr>
                    <td>
                        <input type="text" placeholder="Search"
                               class="search" name="search">
                    </td>
                    <td>
                        <button type="submit" name="submit" value="Search">
                            <span class="material-icons-outlined">search</span>
                        </button>
                    </td>
                </tr>
            </form>
        </table>
    </nav>
</header>

<main>
    <div class="home-hero">
        <div class ="two-col">
            <div class = "col 100vh">
                <div class = "home-hero__img">
                    <img src="images/Rainbow_Flag.png" alt = "rainbow pride flag">
                </div>

            </div>
            <div class = "col">
                <h1>Queer Movies</h1>
            </div>
        </div>
    </div>
    <br>
        <h2>Recommended Movies</h2>
    <div class="grid">
    <?php
    while ($all_movie_rec_record = mysqli_fetch_assoc($all_movie_rec_result)) {
        echo '<a href= "movie.php?movie=' . $all_movie_rec_record['movie_id'] . '">';
        echo "<div>";
        echo "<img class='item-img' src='images/Rainbow_Flag.png' width = '100%'>";
        echo "<br>";
        echo $all_movie_rec_record['movie_name'];
        echo "<br>";
        echo "</div>";
        echo "</a>";
    }
    ?>
    </div>
</main>
</body>
</html>
