<?php
session_start();
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
</head>
<body>
<header>
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
                        <a class="menu-link" href="login.php">Login</a>
                    </li>
                    <li>
                        <a class="menu-link" href="logout.php">Logout</a>
                    </li>
                    <li>
                        <a class="menu-link" href="create_account.php">Create Account</a>
                    </li>
                </ul>

                <ul class ="navbar__menu navbar__menu--right">
                    <!-- search bar -->
                    <div class="search_bar">
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
                    </div>

                    <div class="user_profile">
                        <li>
                            <?php
                            if (isset($_SESSION['username'])){
                                echo $_SESSION['username'];
                            }else{
                                echo "not logged in";
                            }

                            ?>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
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

            <div class = "col 100vh flex-cc">
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
        echo "<br><p>";
        echo $all_movie_rec_record['movie_name'];
        echo "</p><br>";
        echo "</div>";
        echo "</a>";
    }
    ?>
    </div>
</main>
</body>
</html>
