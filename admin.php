<?php
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
    <br>
    <div id="container">
        <h2> Add Drink </h2>

        <form action="insert.php" method ="post">
            
            <label for="drink">Drink Name :</label>
            <input type="text" id = "drink" name ="drink"><br>

            <label for="price">Price: </label>
            <input type="text" id= "price" name ="price"><br>

            <input type="submit" name="insert_button" value="Insert">
        </form>


        <h2> Update Drink</h2>
        <table>
            <tr>
                <th> Drink Information</th>
                <th> Cost </th>
                <th> Submit </th>
                <th> Delete</th>
            </tr>
            <?php
            while($row = mysqli_fetch_array($update_drinks_record))
            {
                echo "<tr><form action = update.php method = post>";
                echo "<td><input type=text name = drink value = '" . $row['Drink']."'></td>";
                echo "<td><input type=text name = price value = '" . $row['Price']."'></td>";
                echo "<input type=hidden name = DrinkID value='" .$row['DrinkID']. "'>";
                echo "<td><input type = submit></td>";
                echo "<td><a href=delete.php?DrinkID=" .$row['DrinkID']. ">Delete</a></td>";
                echo "</form></tr>";
            }
            ?>
        </table>

    </div>
</main>
