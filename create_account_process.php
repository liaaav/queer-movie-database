<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$user = $_POST['username'];
$pass = $_POST['password'];

$bcrypt_pass = password_hash($pass,  PASSWORD_BCRYPT);

$insert_user = "INSERT INTO users (username, password) VALUES ('$user','$bcrypt_pass')";

if(!mysqli_query($con, $insert_user))
{
    echo 'NOT INSERTED';
}
else
{
    echo 'INSERTED';
}
header("refresh:2; url = index.php");
?>