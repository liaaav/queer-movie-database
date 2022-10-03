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
                    <a class="current-page" href="about_us.php">About Us</a>
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
                                    <a href='logout.php'>Logout</a>
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
    <img src="images/lgbtq.jpg" alt="hands holding with rainbow colours">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend,
        erat non iaculis porttitor, arcu ligula gravida orci, vitae semper ipsum
        quam quis tellus. Cras quis rutrum nunc, non efficitur tortor. Morbi sed
        nulla vel magna imperdiet cursus eget nec erat. Donec volutpat lectus et efficitur cursus.
        Nullam bibendum lobortis imperdiet. Suspendisse lacinia lorem nisl, nec porttitor arcu
        volutpat vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet
        justo pellentesque dapibus accumsan. Nullam sit amet sem et neque ornare vehicula. Sed
        vestibulum enim elit, eu fermentum odio lacinia in. Vivamus mollis mauris arcu, imperdiet
        varius orci tristique in. Praesent tortor massa, tincidunt ut commodo id, viverra ut felis.
        Ut semper venenatis ultricies.

        Ut sapien nibh, eleifend nec hendrerit vel, gravida in risus. Duis dapibus id sem in maximus. Ut sodales feugiat lacus, eu viverra felis facilisis quis. Curabitur dignissim suscipit magna eu condimentum. Ut ornare pretium interdum. Suspendisse tempor tristique felis nec maximus. Sed vitae tristique odio. Duis suscipit, leo vitae venenatis semper, augue lacus venenatis orci, ac faucibus lorem mauris a urna. Fusce sed malesuada erat, quis accumsan lectus. Maecenas id nibh a sem dictum dignissim. Maecenas porttitor non tellus a efficitur. Donec in scelerisque ante. In vel cursus mauris. Vivamus augue nunc, vestibulum sit amet augue ac, malesuada euismod elit. Pellentesque massa libero, molestie sed leo vitae, elementum consectetur velit.</p>
        </div>
        </div>
</main>
</body>