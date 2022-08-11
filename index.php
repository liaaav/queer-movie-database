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
    <link rel='stylesheet' type='text/css' href="">
</head>
<body>
<header>
    <nav>
        <a class="button" href="index.php">Home</a>
        <a class="button" href="movies.php">Movies</a>
        <a class="button" href="about_us.php">About Us</a>
    </nav>
</header>

<main>
    <div id="banner">
        <img src="images/Rainbow_Flag.png" alt = "rainbow pride flag" width = 50%>
        <p> https://upload.wikimedia.org/wikipedia/commons/8/8a/LGBT_Rainbow_Flag.png</p>
    <h1>Queer Movies</h1>
    </div>
    <br>
    <div id="container">
        <h2>Recommended Movies</h2>

    </div>
</main>
</body>
</html>
