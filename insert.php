<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$new_drink = $_POST['drink'];
$new_price = $_POST['price'];

$insert_drink = "INSERT INTO drinks (Drink, Price) VALUES ('$new_drink','$new_price')";

if(!mysqli_query($con, $insert_drink))
{
    echo 'NOT INSERTED';
}
else
{
    echo 'INSERTED';
}
header("refresh:2; url = admin.php");
?>