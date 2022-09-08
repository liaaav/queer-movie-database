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
$all_movies_query = "SELECT * FROM movie";
$all_movies_result = mysqli_query($con, $all_movies_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="style.css">
<!--    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">-->
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
<header>
    <nav>
        <div class = "navbar">
            <div class = "navbar__container">
                <li>
                    <a class="button" href="index.php">Home</a>
                </li>
                <li>
                    <a class="button" href="movies.php">Movies</a>
                </li>
                <li>
                    <a class="button" href="about_us.php">About Us</a>
                </li>
                <li>
                    <a class="button" href="login.php">Login</a>
                </li>
                <li>
                    <a class="button" href="logout.php">Logout</a>
                </li>
                <li>
                    <a class="button" href="create_account.php">Create Account</a>
                </li>
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
                        echo $_SESSION['username'];
                        ?>
                    </li>
                </div>
            </div>
        </div>
    </nav>
</header>



<main>
    <div class="main">

            </div>

            <div class="grid">
                <?php
                /*Display Items*/
                while ($all_movies_record = mysqli_fetch_assoc($all_movies_result)) {
    //                echo "<div class='item-box'>";
                    echo '<a href= "movie.php?movie=' . $all_movies_record['movie_id'] . '">';
                    echo "<div>";
                    echo "<img class='item-img' src='images/Rainbow_Flag.png' width = '100%'>";
                    echo "<br><p>";
                    echo $all_movies_record['movie_name'];
                    echo "</p><br>";
                    echo "</div>";
                    echo "</a>";

                }
                ?>
            </div>

</main>
<footer>

</footer>
</body>


</html>
