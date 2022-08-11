<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

$update_drink = "UPDATE drinks SET Drink='$_POST[drink]', Price = '$_POST[price]' WHERE DrinkID='$_POST[DrinkID]'";

if(!mysqli_query($con, $update_drink))
{
    echo 'NOT UPDATED';
}
else
{
    echo 'UPDATED';
}
header("refresh:2; url = admin.php");
?>