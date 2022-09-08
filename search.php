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
                    echo "<img class='item-img' src='images/Rainbow_Flag.png' width = '100%'>";
                    echo "<br>";
                    echo $row['movie_name'];
                    echo "<br>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            echo "</div>";
        ?>
    </div>
</main>
</body>
</html>
