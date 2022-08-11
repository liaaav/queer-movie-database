<?php
/*Connection to database code*/
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "<p class='connection'>connected to database";
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
<header>
    <!-- logo -->
<!--    <a href = "index.php"><img class="logo" src= "images/WGC_Logo.png" alt="Wellington Girls College Logo"></a>-->
    <nav>
        <div class="navbar">
<!--            <div class="navbar-container fr">-->
                <!-- nav links -->
                <a class="button" href="index.php">Home</a>
                <a class="button" href="movies.php">Movies</a>
                <a class="button" href="about_us.php">About Us</a>

                <!--SEARCH BAR

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
            </div>-->


<!--        </div>-->

    </nav>
</header>


<main>
    <div class="main">

            <tr>
            </div>
<!--            <div class="items-container">-->
                <?php
                /*Display Items*/
                while ($all_movies_record = mysqli_fetch_assoc($all_movies_result)) {
    //                echo "<div class='item-box'>";
    //                echo '<a href= "item.php?item=' . $all_movies_record['ItemID'] . '">';

                    echo "<img class='item-img' src='images/Rainbow_Flag.png' width='15%'>";
                    echo "<br>";
                    echo $all_movies_record['movie_name'];
                    echo "<br>";
    //                echo "</a>";

                }
                ?>
<!--            </div>-->

</main>
<footer>

</footer>
</body>


</html>
