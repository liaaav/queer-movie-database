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
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eleifend, erat non iaculis porttitor, arcu ligula gravida orci, vitae semper ipsum quam quis tellus. Cras quis rutrum nunc, non efficitur tortor. Morbi sed nulla vel magna imperdiet cursus eget nec erat. Donec volutpat lectus et efficitur cursus. Nullam bibendum lobortis imperdiet. Suspendisse lacinia lorem nisl, nec porttitor arcu volutpat vel. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquet justo pellentesque dapibus accumsan. Nullam sit amet sem et neque ornare vehicula. Sed vestibulum enim elit, eu fermentum odio lacinia in. Vivamus mollis mauris arcu, imperdiet varius orci tristique in. Praesent tortor massa, tincidunt ut commodo id, viverra ut felis. Ut semper venenatis ultricies.

        Ut sapien nibh, eleifend nec hendrerit vel, gravida in risus. Duis dapibus id sem in maximus. Ut sodales feugiat lacus, eu viverra felis facilisis quis. Curabitur dignissim suscipit magna eu condimentum. Ut ornare pretium interdum. Suspendisse tempor tristique felis nec maximus. Sed vitae tristique odio. Duis suscipit, leo vitae venenatis semper, augue lacus venenatis orci, ac faucibus lorem mauris a urna. Fusce sed malesuada erat, quis accumsan lectus. Maecenas id nibh a sem dictum dignissim. Maecenas porttitor non tellus a efficitur. Donec in scelerisque ante. In vel cursus mauris. Vivamus augue nunc, vestibulum sit amet augue ac, malesuada euismod elit. Pellentesque massa libero, molestie sed leo vitae, elementum consectetur velit.</p>
</main>
