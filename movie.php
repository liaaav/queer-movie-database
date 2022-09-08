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
                    <a class="menu-link" href="index.php">Home</a>
                </li>
                <li>
                    <a class="menu-link" href="movies.php">Movies</a>
                </li>
                <li>
                    <a class="menu-link" href="about_us.php">About Us</a>
                </li>
                <li>
                    <a class="menu-link" href="create_account.php">Create Account</a>
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
                    echo "<li>
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

<!--            Review Form -->
            <?php
                echo "<form name = 'review_form' method = 'post' action = 'review.php?movie=" . $id . "'>
                <input type='text' name='review' placeholder='Add a review...' ><br>
                <input type='submit' name='submit' id='submit' value='submit'>
            </form>";
            ?>

<!--            Reviews-->
            
        </div>
    </main>


</body>
</html>

