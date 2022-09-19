<?php
session_start();
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$rating = $_POST['rating'];
$user_id = $_SESSION['user_id'];
$movie_id = $_POST['movie_id'];


$delete_existing_ratings = "DELETE FROM rating WHERE user_id='$user_id' AND movie_id = '$movie_id'";

if(!mysqli_query($con, $delete_existing_ratings))
{
    echo 'not deleted';
}
else
{
    echo 'deleted';
}

$insert_rating = "INSERT INTO rating (movie_id, user_id, rating) VALUES ('$movie_id','$user_id','$rating')";

if(!mysqli_query($con, $insert_rating))
{
    echo 'NOT INSERTED';
}
else
{
    echo 'INSERTED';

}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>