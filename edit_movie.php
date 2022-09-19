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
if((!isset($_SESSION['admin']))){
    header("Location: index.php");
}

// current movie
$this_movie_query = "SELECT movie.* FROM movie WHERE movie_id = '" . $id ."'";
$this_movie_result = mysqli_query($con, $this_movie_query);
$this_movie_record = mysqli_fetch_assoc($this_movie_result);

// movie's genres
$genre_query = "SELECT genre.genre_id FROM genre, movie, movie_genre WHERE movie.movie_id = '" . $id ."'
                AND genre.genre_id = movie_genre.genre_id AND movie.movie_id = movie_genre.movie_id";
$genre_result = mysqli_query($con, $genre_query);

// loop which appends genre id into single array
$movie_genres = [];
while ($genre_record = mysqli_fetch_assoc($genre_result)){
    $movie_genres[] = $genre_record['genre_id'];
}

// all genres
$all_genre_query = "SELECT * FROM genre";
$all_genre_result = mysqli_query($con, $all_genre_query);

// movie's representation
$representation_query = "SELECT representation.representation_id, representation.flag_file_path FROM 
                        representation, movie, movie_representation WHERE movie.movie_id = '" .$id ."'
                        AND representation.representation_id = movie_representation.representation_id 
                        AND movie.movie_id = movie_representation.movie_id";
$representation_result = mysqli_query($con, $representation_query);


//all representations
$all_representation_query = "SELECT * FROM representation";
$all_representation_result = mysqli_query($con, $all_representation_query);

// loop which appends representation id into single array
$movie_representations = [];
while ($representation_record = mysqli_fetch_assoc($representation_result)){
    $movie_representations[] = $representation_record['representation_id'];
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
                    <a>
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
                                    <a class='menu-link' href='logout.php'>Logout</a>
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
        <?php
        $movie_name = str_replace("'", "&apos;", $this_movie_record['movie_name']); // if the movie name has quotes
            echo "<form action = processes/update.php method = post>";
                echo "<input type=text name = movie_name required='required' value = '" . $movie_name. "'></td>";
                echo "<input type=number name = release_year min='1880' max='". date('Y'). "' required='required' value = '" . $this_movie_record['release_year']."'></td>";
                echo "<input type=text name = language required='required' value = '" . $this_movie_record['language']."'></td>";


            // edit genres
                echo "<br>";
                while ($all_genre_record = mysqli_fetch_assoc($all_genre_result)) {

                    // if movie already has genre
                    if(in_array($all_genre_record['genre_id'], $movie_genres)){
                        $checked = true;
                    }else{
                        $checked = false;
                    }
                    echo "<input type='checkbox' id= '". $all_genre_record['genre_id']. "' name= ". $all_genre_record['genre_id'].
                    "' value = '" .$all_genre_record['genre'] . "'";
                    if ($checked){
                        echo " checked";
                    }
                    echo ">";
                    echo "<label for= '". $all_genre_record['genre_id']. "'>" .$all_genre_record['genre'] . "</label><br>";
                }

            // edit representation
        echo "<br>";
        while ($all_representation_record = mysqli_fetch_assoc($all_representation_result)) {

            // if movie already has representation
            if(in_array($all_representation_record['representation_id'], $movie_representations)){
                $checked = true;
            }else{
                $checked = false;
            }
            echo "<input type='checkbox' id= '". $all_representation_record['representation_id']. "' name= ". $all_representation_record['representation_id'].
                "' value = '" .$all_representation_record['representation'] . "'";
            if ($checked){
                echo " checked";
            }
            echo ">";
            echo "<label for= '". $all_representation_record['representation_id']. "'>" .$all_representation_record['representation'] . "</label><br>";
        }


                echo "<input type=hidden name = movie_id value='" .$this_movie_record['movie_id']. "'>";
                echo "<td><input type = submit></td>";


            echo "</form>";
            echo "<br>";
        //            delete movie
                    echo "<td><a href=processes/delete.php?movie_id=" .$this_movie_record['movie_id']. ">Delete movie</a></td>";
        ?>



    </div>
</main>