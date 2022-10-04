<?php
session_start();
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
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
                    <a class = 'current-page' href = 'profile.php'>
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
            <?php
            echo "logged in as " . $_SESSION['username'];
            ?>
            <br>
            this would be an epic profile
            if I could be bothered
        </div>
    </div>
</main>
</body>