<?php
session_start();
    $con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
    else{

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
        <section class="home-hero">
            <div class ="two-col">

                <div class = "col 100vh">
                    <div class = "home-hero__img">
                        <img src="images/lgbtq_flag.png" alt = "rainbow pride flag">
                    </div>
                </div>

                <div class = "col 100vh flex-cc">
                    <h1>Queer Movies</h1>
                </div>

            </div>
        </section>
        <br>
        <h2>Recommended Movies</h2>
        <div class="grid">
            <?php
            while ($all_movie_rec_record = mysqli_fetch_assoc($all_movie_rec_result)) {
                echo '<a href= "movie.php?movie=' . $all_movie_rec_record['movie_id'] . '">';
                echo "<div>";
                echo "<img class='item-img' src='images/lgbtq_flag.png' width = '100%'>";
                echo "<br><p>";
                echo $all_movie_rec_record['movie_name'];
                echo "</p><br>";
                echo "</div>";
                echo "</a>";
            }
            ?>
        </div>
    </div>
</main>
</body>
</html>
