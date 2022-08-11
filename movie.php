<?php
    /*Connection to database code*/
    $con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
    if(mysqli_connect_errno()){
        echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
    else{
        echo "connected to database";
    }
    if(isset($_GET['item'])){
        $id = $_GET['item'];
    }else{
        $id = "HSW";
    }
    date_default_timezone_set('Pacific/Auckland');
    $day = (strftime("%A"));
    $today_special_query = "SELECT ItemID FROM specials WHERE Day = '" . $day . "'";
    $today_special_result = mysqli_query($con, $today_special_query);
    $today_special_record = mysqli_fetch_assoc($today_special_result);

    $this_item_query = "SELECT items.*, categories.Category FROM items, categories WHERE ItemID = '" . $id ."'";
    $this_item_result = mysqli_query($con, $this_item_query);
    $this_item_record = mysqli_fetch_assoc($this_item_result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="">
</head>
<body>
    <div id="page-container">
        <header>
            <!-- logo -->
            <a href = "index.php"><img class="logo" src= "images/WGC_Logo.png" alt="Wellington Girls College Logo"></a>
            <nav>
                <div class="navbar">
                    <div class="navbar-container fr">
                        <!-- nav links -->
                        <a href="index.php">Home</a>
                        <a href="browse.php">Browse</a>
                        <a href="specials.php">Specials</a>
                        <!-- search bar -->
                        <div class = "boxContainer">
                            <table class="elementsContainer">
                                <form action="browse.php" method="post">
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
                    </div>


                </div>

            </nav>
        </header>
        <main>
            <div>
                <div class='item-information'>
                    <br>
                        <h2> ITEM INFORMATION</h2>
                        <?php
            //            Retrieve information from database of selected item

                        echo "<img class='item-information-image' src='images/" .$this_item_record['Image'] ."' alt='" . $this_item_record['ItemName'] . "'>";
                        if($today_special_record['ItemID'] == ($this_item_record['ItemID'])){
                            echo "<p><strong>TODAY'S SPECIAL! </strong>";

                        }else{
                            if($this_item_record['Availability'] == 'no'){
                                echo "<p> NOT AVAILABLE<br>";
                            }elseif($this_item_record['Availability'] == 'yes') {
                                echo "<p> IN STOCK <p>";
                            }
                        }
                        echo "<p> Item Name: " . $this_item_record['ItemName'] . "<br>";
                        echo "<p> Cost: $" . $this_item_record['Cost'] . "<br>";
                        echo "<p> Category: " . $this_item_record['Category'] . "<br>";

                        if($this_item_record['MeatFree'] == True){
                            echo "<p> Meat Free<br>";
                        }
                        if($this_item_record['DairyFree'] == True){
                            echo "<p> Dairy Free<br>";
                        }
                        if($this_item_record['Vegan'] == True){
                            echo "<p> Vegan <br>";
                        }
                        if($this_item_record['GlutenFree'] == True){
                            echo "<p> Gluten Free<br>";
                        }


                        ?>
                </div>
        </main>
    </div>

    <footer>
        <div class="legal-bar">
            <p>© WGC Ava Li 2021 - all rights reserved </p>
        </div>
    </footer>
</body>
</html>

