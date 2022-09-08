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
    <h2> Enter details here </h2>
    <!-- Create Account Form -->
    <form name = 'account_form' method = 'post' action = 'create_account_process.php'>
        <label for="username"> Username: </label>
        <input type="text" name="username"><br>

        <label for=password"> Password: </label>
        <input type="password" name="password"><br>

        <input type="submit" name="submit" id="submit" value="submit">
    </form>
    </div>
</main>
