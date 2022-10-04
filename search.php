<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

$all_drinks_query = "SELECT DrinkID, drink FROM drinks";
$all_drinks_result = mysqli_query($con, $all_drinks_query);
$all_orders_query = "SELECT OrderID FROM orders ORDER BY OrderID ASC";
$all_orders_result = mysqli_query($con, $all_orders_query);
$all_customers_query = "SELECT CustomerID, FName FROM customers";
$all_customers_result = mysqli_query($con, $all_customers_query);

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
        <div class = "main">

            <?php
                $search = $_POST['search'];

                $query1 = "SELECT * FROM movie WHERE movie_name LIKE '%$search%' ORDER BY movie_name";
                $query = mysqli_query($con, $query1);
                $count = mysqli_num_rows($query);
                if($count == 0){
                    echo "<p>There was no search results!";

                }else{
                    echo "<div class='grid'>";
                    while ($row = mysqli_fetch_array($query)) {
        //                echo "<div class='item-box'>";
                        echo '<a href= "movie.php?movie=' . $row['movie_id'] . '">';
                        echo "<div>";
                        echo "<img class='movie-img' src='movie_images/" . $row['img_file_path'] . "'>";
                        echo "<br><p>";
                        echo $row['movie_name'];
                        echo "<br>";
                        echo "</div>";
                        echo "</a>";
                    }
                }
                echo "</div>";
            ?>
        </div>
    </div>
</main>
</body>
</html>
