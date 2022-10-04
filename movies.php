<?php
session_start();
/*Connection to database code*/
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

// Setting variables for sorting items order
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}else{
    $sort = 'alphaAsc';
}
if($sort == 'alphaAsc') {
    $field = 'movie_name';
    $order = 'ASC';
}elseif($sort == 'alphaDesc') {
    $field = 'movie_name';
    $order = 'DESC';

}


// all movies
$movies_query = "SELECT * FROM movie ORDER BY $field $order";
$movies_result = mysqli_query($con, $movies_query);

//all representations
$all_representation_query = "SELECT * FROM representation";
$all_representation_result = mysqli_query($con, $all_representation_query);

// all genres
$all_genre_query = "SELECT * FROM genre";
$all_genre_result = mysqli_query($con, $all_genre_query);

if(isset($_GET['genre_id'])){
    if(empty($_GET['genre_id'])) {
        unset($_GET['genre_id']);
    }
    else{
        $movies_query = "SELECT movie.*, genre.* FROM genre, movie, movie_genre WHERE genre.genre_id = movie_genre.genre_id 
                                AND movie.movie_id = movie_genre.movie_id AND movie_genre.genre_id = '".$_GET['genre_id'] . "' 
                                ORDER BY $field $order";
        $movies_result = mysqli_query($con, $movies_query);

        $genre_query = "SELECT genre FROM  genre WHERE genre_id = '" . $_GET['genre_id'] . "'";
        $genre_result = mysqli_query($con, $genre_query);
        $genre_record = mysqli_fetch_assoc($genre_result);
    }
}

if(isset($_GET['representation_id'])){
    if(empty($_GET['representation_id'])) {
        unset($_GET['representation_id']);
    }
    else{
        $movies_query = "SELECT movie.*, representation.* FROM representation, movie, movie_representation WHERE 
                        representation.representation_id = movie_representation.representation_id 
                        AND movie.movie_id = movie_representation.movie_id AND movie_representation.representation_id = '".$_GET['representation_id'] . "'
                         ORDER BY $field $order";
        $movies_result = mysqli_query($con, $movies_query);

        $representation_query = "SELECT * FROM  representation WHERE representation_id = '" . $_GET['representation_id'] . "'";
        $representation_result = mysqli_query($con, $representation_query);
        $representation_record = mysqli_fetch_assoc($representation_result);
    }
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
                    <a class='current-page' href="movies.php">Movies</a>
                </li>
                <li>
                    <a href="about_us.php">About Us</a>
                </li>
                <li>
                    <?php
                    //                    if admin is logged in, given access to admin page
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
                    <a href = 'profile.php'>
                        <?php
                        //                        if logged in, shows username
                        if (isset($_SESSION['username'])){
                            echo $_SESSION['username'];
                        }
                        ?>
                    </a>
                </li>
                <?php
                //                if logged in, shows logout
                if ((isset($_SESSION['username']))) {
                    echo "<li>
                                    <a href='logout.php'>Logout</a>
                                </li>";
                }

                ?>
                <?php
                //                if not logged in shows create account and log in pages
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
            <div class='title'>
                <h1>
                <?php

                echo "Movies";
                if(isset($_GET['genre_id'])){
                    echo " - ";
                    echo $genre_record['genre'];
                }elseif(isset($_GET['representation_id'])){
                    echo " - ";
                    echo $representation_record['representation'];
                }
                ?>
                </h1>

                <?php
                if(isset($_GET['representation_id'])){
                    echo $representation_record['description'];
                }
                ?>

            </div>

            <br>

            <div class="page-grid">
                <div class="filters">
                    <!--Sort Items Dropdown-->
                    <div class="filter-panel">
                        <div class="filter-panel-inner">
                        <h2>Sorting</h2>
                            <form name='sort_form' id='sort_form' method='get' action='movies.php'>
                                <div class="dropdown">
                                    <select id='sort' name='sort'>
                                        <!--options-->
                                        <option value='alphaAsc'
                                            <?php
                                            if($sort == 'alphaAsc'){
                                                echo ' selected';
                                            }
                                            ?>
                                        > Alphabetical A to Z</option>
                                        <option value='alphaDesc'
                                            <?php
                                            if($sort == 'alphaDesc'){
                                                echo ' selected';
                                            }
                                            ?>> Alphabetical Z to A</option>
                                    </select>
                                </div>
                                    <input class="submit-button" type="submit" name="submit" value="submit">
                            </form>
                        </div>
                    </div>

                    <div class="filter-panel">
                        <div class="filter-panel-inner">
                            <h2>Genres</h2>
                            <ul class="filter">
                                <?php
                                    while($all_genre_record = mysqli_fetch_assoc($all_genre_result)) {
                                        echo "<li";
                                        if(isset($_GET['genre_id'])){
                                            if($all_genre_record['genre_id']==$_GET['genre_id']){
                                                echo " class = 'selected-filter'";
                                            }
                                        }
                                        echo ">";
                                        echo "<a href='movies.php?genre_id=".$all_genre_record['genre_id'] ."'>";
                                        echo $all_genre_record['genre'];
                                        echo "</a>";
                                        echo "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="filter-panel">
                        <div class="filter-panel-inner">
                            <h2>Representation</h2>
                            <ul class="filter">
                                <?php
                                while($all_representation_record = mysqli_fetch_assoc($all_representation_result)) {
                                    echo "<li";
                                    if(isset($_GET['representation_id'])){
                                        if($all_representation_record['representation_id']==$_GET['representation_id']){
                                            echo " class = 'selected-filter'";
                                        }
                                    }
                                    echo ">";
                                    echo "<a href='movies.php?representation_id=".$all_representation_record['representation_id'] ."'>";
                                    echo $all_representation_record['representation'];
                                    echo "</a>";
                                    echo "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <div class = 'movies'>
            <!--SORTING MOVIES-->
                <div class="grid">
                    <?php
                    /*Display movies*/
                    if($movies_result->num_rows === 0){
                        echo "No results";
                    }
                    while ($movies_record = mysqli_fetch_assoc($movies_result)) {

                        echo '<a href= "movie.php?movie=' . $movies_record['movie_id'] . '">';
                        echo "<div>";
                        echo "<img class='movie-img' src='movie_images/" . $movies_record['img_file_path'] . "' alt = 'movie poster for " . $movies_record['movie_name'] ."'>";
                        echo "<br><p>";
                        echo $movies_record['movie_name'];
                        echo "</p><br>";
                        echo "</div>";
                        echo "</a>";

                    }
                    ?>
                </div>
            </div>
    </div></div>
    </div>
</main>
<footer>

</footer>
</body>


</html>
