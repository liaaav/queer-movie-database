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


$all_genre_query = "SELECT * FROM genre";
$all_genre_result = mysqli_query($con, $all_genre_query);

$all_representation_query = "SELECT * FROM representation";
$all_representation_result = mysqli_query($con, $all_representation_query);
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

        <h2> Add Movie </h2>

        <form action="processes/insert_movie.php" method ="post">

            <label for="movie_name">Movie Name :</label>
            <input type="text" id = "movie_name" name ="movie_name"><br>

            <label for="release_year">Release Year: </label>
            <?php
            echo "<input type='number' name = 'release_year' min='1880' max='". date('Y'). "' required='required'>"
            ?>
            <br>

            <label for="language">Language: </label>
            <input type="text" id= "language" name ="language"><br>

            <?php
            while ($all_genre_record = mysqli_fetch_assoc($all_genre_result)) {
                echo "<input type='checkbox' id= '". $all_genre_record['genre_id']. "' name= ". $all_genre_record['genre_id'].
                    "' value = '" .$all_genre_record['genre'] . "'>";
                echo "<label for= '". $all_genre_record['genre_id']. "'>" .$all_genre_record['genre'] . "</label><br>";
            }
            mysqli_free_result($all_genre_result);
            ?>
<br>
            <?php
            while ($all_representation_record = mysqli_fetch_assoc($all_representation_result)) {
                echo "<input type='checkbox' id= '". $all_representation_record['representation_id']. "' name= ". $all_representation_record['representation_id'].
                    "' value = '" .$all_representation_record['representation'] . "'>";
                echo "<label for= '". $all_representation_record['representation_id']. "'>" .$all_representation_record['representation'] . "</label><br>";
            }
            mysqli_free_result($all_representation_result);
            ?>

            <input type="submit" name="insert_button" value="Insert">
        </form>

        <h2> Edit Genres </h2>

        <table>
            <tr>
                <th> Genre </th>
                <th> Submit </th>
                <th> Delete</th>
            </tr>
            <?php
            $all_genre_result = mysqli_query($con, $all_genre_query);
            while($row = mysqli_fetch_array($all_genre_result))
            {
                echo "<tr><form action = update_genre.php method = post>";
                echo "<td><input type=text name = genre value = '" . $row['genre']."'></td>";
                echo "<input type=hidden name = genre_id value='" .$row['genre_id']. "'>";
                echo "<td><input type = submit></td>";
                echo "<td><a href=delete_genre.php?genre_id=" .$row['genre_id']. ">Delete</a></td>";
                echo "</form></tr>";
            }
            // add genre
            ?>
        </table>
        <h2> Edit Representation </h2>

        <table>
            <tr>
                <th> Representation </th>
<!--                flag-->
                <th> Submit </th>
                <th> Delete</th>
            </tr>
            <?php
            $all_representation_result = mysqli_query($con, $all_representation_query);
            while($row = mysqli_fetch_array($all_representation_result))
            {
                echo "<tr><form action = update_representation.php method = post>";
                echo "<td><input type=text name = representation value = '" . $row['representation']."'></td>";
                echo "<input type=hidden name = representation_id value='" .$row['representation_id']. "'>";
                echo "<td><input type = submit></td>";
                echo "<td><a href=delete_representation.php?representation_id=" .$row['representation_id']. ">Delete</a></td>";
                echo "</form></tr>";
            }
            // add representation and edit flag
            ?>
        </table>
    </div>
</main>