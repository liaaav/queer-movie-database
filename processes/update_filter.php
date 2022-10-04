<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

print_r($_POST);
if(isset($_POST['representation_id'])){
    echo "over";
    $filter_name = str_replace("'", "&apos;", $_POST['representation']);
    $filter_name = ucwords(strtolower($filter_name));
    $description = str_replace("'", "&apos;", $_POST['description']);
    $query = "UPDATE representation SET representation = '$filter_name', description = '$description' WHERE representation_id ='$_POST[representation_id]'";
    echo $query;
}

if(isset($_POST['genre_id'])){
    echo "here";
    $filter_name = str_replace("'", "&apos;", $_POST['genre']);
    $filter_name = ucwords(strtolower($filter_name));
    $query = "UPDATE genre SET genre = '$filter_name' WHERE genre_id ='$_POST[genre_id]'";
}

if(!mysqli_query($con, $query))
{
    echo 'NOT UPDATED';
}
else
{
    echo 'UPDATED';
}

//header("refresh:2; url = ../admin.php");
?>