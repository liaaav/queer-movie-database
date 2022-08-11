<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_cafe");
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
echo "connected to database";
}

$delete_drink = "DELETE FROM drinks WHERE DrinkID='$_GET[DrinkID]'";
if(!mysqli_query($con, $delete_drink))
{
    echo 'NOT DELETED';
}
else
{
    echo 'DELETED';
}
header("refresh:2; url = admin.php");
?>

