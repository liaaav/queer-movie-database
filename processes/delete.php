<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
echo "connected to database";
}
// if($_GET(genre_id) isset
$delete_movie = "DELETE FROM movie WHERE movie_id='$_GET[movie_id]'";
if(!mysqli_query($con, $delete_movie))
{
    echo 'NOT DELETED';
}
else
{
    echo 'DELETED';
}
header('Location: ../movies.php');
?>

