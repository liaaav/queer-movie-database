<?php
/*Connection to database code*/
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
if(isset($_GET['movie'])){
    $id = $_GET['movie'];
}else{
    $id = "1";
}
$this_movie_query = "SELECT movie.* FROM movie WHERE movie_id = '" . $id ."'";
$this_movie_result = mysqli_query($con, $this_movie_query);
$this_movie_record = mysqli_fetch_assoc($this_movie_result);

$genre_query = "SELECT genre.genre FROM genre, movie, movie_genre WHERE movie.movie_id = '" . $id ."'
                AND genre.genre_id = movie_genre.genre_id AND movie.movie_id = movie_genre.movie_id";
$genre_result = mysqli_query($con, $genre_query);

$representation_query = "SELECT representation.representation, representation.flag_file_path FROM 
                        representation, movie, movie_representation WHERE movie.movie_id = '" .$id ."'
                        AND representation.representation_id = movie_representation.representation_id 
                        AND movie.movie_id = movie_representation.movie_id";
$representation_result = mysqli_query($con, $representation_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="style.css">
    <!--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">-->
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
            <br>
            <?php
            echo "<h2>" . $this_movie_record['movie_name'] . "</h2><br>";
            //            Retrieve information from database of selected movie

            echo "<img class='item-img' src='images/Rainbow_Flag.png' width = '25%'>";

            echo "<p>"; //  make this the flag
            while ($representation_record = mysqli_fetch_assoc($representation_result)) {
                echo $representation_record['representation'];
                echo " representation";
            }
            echo "<br>";

            echo "<p>";
            while ($genre_record = mysqli_fetch_assoc($genre_result)) {
                echo $genre_record['genre'];
                echo ", ";
            }
            ?>
    </main>

<footer>
</footer>
</body>
</html>

