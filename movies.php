<?php
session_start();
/*Connection to database code*/
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

/*
//Setting variables for category
if(isset($_GET['category'])){
    if(empty($_GET['category'])){
        unset($_GET['category']);
    }
    else{
        $category = "AND categories.Category = '" . $_GET['category'] ."'";
    }

}else{
    $category = "";
}
//Setting variables for filters
if(isset($_GET['filter'])){
    if(empty($_GET['filter'])) {
        unset($_GET['filter']);
    }
    else{
        $filter = "AND " . $_GET['filter'] . "= TRUE";
    }
}
// Setting variables for sorting items order
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}else{
    $sort = 'alphaAsc';
}
if($sort == 'alphaAsc') {
    $field = 'ItemName';
    $order = 'ASC';
}elseif($sort == 'costAsc') {
    $field = 'Cost';
    $order = 'ASC';
}elseif($sort == 'costDesc') {
    $field = 'Cost';
    $order = 'DESC';
}elseif($sort == 'alphaDesc') {
    $field = 'ItemName';
    $order = 'DESC';

}
// Setting variable for availability
if(isset($_GET['availability'])){
    if(empty($_GET['availability'])) {
        unset($_GET['availability']);
    }
    else{
        $availability = "AND Availability = " . $_GET['availability'];
    }
}
*/
$all_movies_query = "SELECT * FROM movie ORDER BY movie_name ASC";
$all_movies_result = mysqli_query($con, $all_movies_query);
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
<!--SORTING MOVIES-->
        <ul>
            <li>
                
            </li>
        </ul>

            <div class="grid">
                <?php
                /*Display Items*/
                while ($all_movies_record = mysqli_fetch_assoc($all_movies_result)) {
                    echo '<a href= "movie.php?movie=' . $all_movies_record['movie_id'] . '">';
                    echo "<div>";
                    echo "<img class='item-img' src='images/lgbtq_flag.png' width = '100%'>";
                    echo "<br><p>";
                    echo $all_movies_record['movie_name'];
                    echo "</p><br>";
                    echo "</div>";
                    echo "</a>";

                }
                ?>
            </div>
    </div>
</main>
<footer>

</footer>
</body>


</html>
