<?php
session_start();
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$review = $_POST['review'];
$user = $_SESSION['username'];
$movie_id = $_GET['movie'];
echo $user;
$get_user_id = "SELECT user_id FROM users WHERE username = '". $user . "'";
$user_id_result = mysqli_query($con, $get_user_id);
$user_array = mysqli_fetch_assoc($user_id_result);
$user_id = $user_array['user_id'];

$insert_review = "INSERT INTO review (movie_id, user_id, review) VALUES ('$movie_id','$user_id','$review')";

if(!mysqli_query($con, $insert_review))
{
    echo 'NOT INSERTED';
}
else
{
    echo 'INSERTED';
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>