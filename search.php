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
</head>
<body>
<header>
    <nav>
        <a class="button" href="index.php">Home</a>
        <a class="button" href="movies.php">Movies</a>
        <a class="button" href="about_us.php">About Us</a>
        <!-- search bar -->
        <div class = "boxContainer">
            <table class="elementsContainer">
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
    </nav>
</header>

<main>

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

</main>
</body>
</html>
