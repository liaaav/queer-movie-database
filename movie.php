<?php
session_start();
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
// selected movie details
$this_movie_query = "SELECT movie.* FROM movie WHERE movie_id = '" . $id ."'";
$this_movie_result = mysqli_query($con, $this_movie_query);
$this_movie_record = mysqli_fetch_assoc($this_movie_result);


// selected movie genres
$genre_query = "SELECT genre.* FROM genre, movie, movie_genre WHERE movie.movie_id = '" . $id ."'
                AND genre.genre_id = movie_genre.genre_id AND movie.movie_id = movie_genre.movie_id";
$genre_result = mysqli_query($con, $genre_query);

// selected movie representation
$representation_query = "SELECT representation.*, representation.flag_file_path FROM 
                        representation, movie, movie_representation WHERE movie.movie_id = '" .$id ."'
                        AND representation.representation_id = movie_representation.representation_id 
                        AND movie.movie_id = movie_representation.movie_id";
$representation_result = mysqli_query($con, $representation_query);

// selected movie reviews
$review_query = "SELECT review.*, users.* FROM review, users WHERE movie_id = '" .$id . "' AND users.user_id = review.user_id ORDER BY datetime DESC";
$review_result = mysqli_query($con, $review_query);

// selected movie user rating
if ((isset($_SESSION['logged_in']))) {
    $user_rating_query = "SELECT rating FROM rating WHERE user_id = '" . $_SESSION['user_id'] . "' AND movie_id = '" . $id . "'";

    $user_rating_result = mysqli_query($con, $user_rating_query);
    $user_rating_record = mysqli_fetch_assoc($user_rating_result);

    $user_rating = $user_rating_record['rating'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
</head>

<body>
<nav>
    <div class = "navbar">
        <div class = "navbar__container">
            <ul class = "navbar__menu navbar__menu--left">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="movies.php">Movies</a>
                </li>
                <li>
                    <a href="about_us.php">About Us</a>
                </li>
                <li>
<!--                    shows admin link if logged in as admin -->
                    <?php
                    if ((isset($_SESSION['logged_in']))) {
                        if ($_SESSION['admin']) {
                            echo "<a href='admin.php'>Admin</a>";
                        }
                    }
                    ?>
                </li>
            </ul>

            <ul class ="navbar__menu navbar__menu--right">
                <li>
                    <!-- search bar -->
                    <form class="search-box" action="search.php" method="post">

                        <input type="text" class="search__input" placeholder="Search..." name="search">

                        <button class="material-icons-outlined" type="submit" name="submit" value="Search">search</button>

                    </form>
                </li>
                <li>
                    <a>
<!--                    if logged in - displays username -->
                        <?php
                        if (isset($_SESSION['username'])){
                            echo $_SESSION['username'];
                        }
                        ?>
                    </a>

                </li>
                <?php
//                if logged in - displays logout link
                if ((isset($_SESSION['username']))) {
                    echo "<li>
                                    <a href='logout.php'>Logout</a>
                                </li>";
                }

                ?>
                <?php
//                if not logged in - displays create acc and login links
                if ((!isset($_SESSION['username']))) {
                    echo "
                        <li>
                            <a href='create_account.php'>Create Account</a>
                        </li>
                        <li>
                            <a href='login.php'>Login</a>
                        </li>";
                }
                ?>


            </ul>
        </div>
    </div>
</nav>


    <main>
        <div class = "content">
            <div class="main">
                <div class='movie-banner'>
                    <div class='movie-column'>
                        <section class='inner-content'>
<!--                        Retrieve information from database of selected movie-->
                            <div class='poster'>
                                <?php


                                //  display image
                                echo "<img class='movie-img' src='images/". $this_movie_record['img_file_path'] . "' width = '15%'>";
                                ?>
                            </div>
                            <div class="movie-details">
                                <?php

                //              movie name
                                echo "<h1 class='movie-title'>" . $this_movie_record['movie_name'] . "</h1>";

                //              other movie details
                                echo "<p>";
                                echo $this_movie_record['release_year'];
                                echo " &#x2022; ";
                                echo $this_movie_record['language'];

                //              display gay flags
                                echo "<div class = movie-representation>";
                                while ($representation_record = mysqli_fetch_assoc($representation_result)) {
                                    echo "<a href='movies.php?representation_id=" . $representation_record['representation_id'] . "'>";
                                    echo "<img class='flag_img' src='images/". $representation_record['flag_file_path'] . "'>";
                                    echo "</a>";
                                }
                                echo "</div>";

                //              display genres
                                echo "<div class = movie-filters>";
                                    echo "<ul class='filter'>";
                                    while ($genre_record = mysqli_fetch_assoc($genre_result)) {
                                        echo "<li>";
                                        echo "<a href='movies.php?genre_id=".$genre_record['genre_id'] ."'>";
                                        echo $genre_record['genre'];
                                        echo "</a></li>";
                                    }
                                    echo "</ul>";
                                echo "</div>";

                                ?>
            <br>
                                <!--            Edit movie-->
                                <?php
                //               link hidden if not admin
                                if ((isset($_SESSION['logged_in']))){
                                    if(($_SESSION['admin'])){
                                        echo "<a href='edit_movie.php?movie=" . $id . "'>edit</a>";
                                    }
                                }

                                ?>
            <br>
                            </div>
                        </section>
                    </div>
                </div>
                <!--            rate movie out of 5 -->
                <?php
                if(isset($user_rating)) {
                    echo '<p> You rated this movie ';
                    echo $user_rating;
                    echo '/5';
                }
                if (isset($_SESSION['logged_in'])) {

                    ?>
                    <form name="rating" method = 'post' action = 'processes/rating.php'>
                        <input type="radio" id="1" name="rating" value="1">
                        <label for="1"> 1 </label>
                        <input type="radio" id="2" name="rating" value="2">
                        <label for="2"> 2 </label>
                        <input type="radio" id="3" name="rating" value="3">
                        <label for="3"> 3 </label>
                        <input type="radio" id="4" name="rating" value="4">
                        <label for="4"> 4 </label>
                        <input type="radio" id="5" name="rating" value="5">
                        <label for="5"> 5 </label>
                        <input type = submit>
                        <?php
                        echo "<input type=hidden name = movie_id value='" .$this_movie_record['movie_id'] . "'>";
                        ?>
                    </form>
                <?php
                }
                ?>



                <!--            Review Form -->
                <?php
                if ((isset($_SESSION['logged_in']))) {
                    echo "<form name = 'review_form' method = 'post' action = 'processes/review.php?movie=" . $id . "'>
                                <input type='text' name='review' required='required' placeholder='Add a review...' ><br>
                                <input type='submit' name='submit' id='submit' value='submit'>
                          </form>";

                }
                ?>




                <!--            Reviews-->
    <br><br>
                <?php
                while ($review_record = mysqli_fetch_assoc($review_result)) {
                    echo "<strong>";
                    echo $review_record['username'];
                    echo ": </strong>";
                    echo $review_record['review'];
                    echo "<br>";
                }
                ?>
            </div>
        </div>
    </main>


</body>
</html>

