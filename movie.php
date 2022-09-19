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
$genre_query = "SELECT genre.genre FROM genre, movie, movie_genre WHERE movie.movie_id = '" . $id ."'
                AND genre.genre_id = movie_genre.genre_id AND movie.movie_id = movie_genre.movie_id";
$genre_result = mysqli_query($con, $genre_query);

// selected movie representation
$representation_query = "SELECT representation.representation, representation.flag_file_path FROM 
                        representation, movie, movie_representation WHERE movie.movie_id = '" .$id ."'
                        AND representation.representation_id = movie_representation.representation_id 
                        AND movie.movie_id = movie_representation.movie_id";
$representation_result = mysqli_query($con, $representation_query);

// selected movie reviews
$review_query = "SELECT review.*, users.* FROM review, users WHERE movie_id = '" .$id . "' AND users.user_id = review.user_id ORDER BY users.user_id DESC";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="style.css">
</head>
<body>
<nav>
    <div class = "navbar">
        <div class = "navbar__container">
            <ul class = "navbar__menu navbar__menu--left">
                <li>
                    <a class="current-page" href="index.php">Home</a>
                </li>
                <li>
                    <a href="movies.php">Movies</a>
                </li>
                <li>
                    <a href="about_us.php">About Us</a>
                </li>
                <li>
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
                    <!--                        <div class="user_profile">-->
                    <a>
                        <?php
                        if (isset($_SESSION['username'])){
                            echo $_SESSION['username'];
                        }
                        ?>
                    </a>
                    <!--                        </div>-->
                </li>
                <?php
                if ((isset($_SESSION['username']))) {
                    echo "<li>
                                    <a class='menu-link' href='logout.php'>Logout</a>
                                </li>";
                }

                ?>
                <?php
                if ((!isset($_SESSION['username']))) {
                    echo "
                        <li>
                            <a href='create_account.php'>Create Account</a>
                        </li>
                        <li>
                            <a class='menu-link' href='login.php'>Login</a>
                        </li>";
                }
                ?>


            </ul>
        </div>
    </div>
</nav>


    <main>
        <div class = "content">
            <br>
            <?php
            echo "<h2>" . $this_movie_record['movie_name'] . "</h2><br>";
            //   Retrieve information from database of selected movie
            //   find images for movies
            echo "<img class='item-img' src='images/lgbtq_flag.png' width = '25%'>";

            echo "<p>";
            while ($representation_record = mysqli_fetch_assoc($representation_result)) {
                echo "<img class='flag_img' src='images/". $representation_record['flag_file_path'] . "'>";
            }
            echo "<br>";

            echo "<p>";
            while ($genre_record = mysqli_fetch_assoc($genre_result)) {
                echo $genre_record['genre'];
                echo ", ";
            }
            echo "<br>";
            echo $this_movie_record['language'];
            echo "<br>";
            echo $this_movie_record['release_year'];
            ?>
<br>
            <!--            Edit movie-->
            <?php
            if ((isset($_SESSION['logged_in']))){
                if(($_SESSION['admin'])){
                    echo "<a href='edit_movie.php?movie=" . $id . "'>edit</a>";
                }
            }

            ?>
<br>
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
    </main>


</body>
</html>

