<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
    echo "<br>";
}

if(isset($_POST['representation'])){
    $representation = ucwords(strtolower($_POST['representation']));
    $representation_id = strtoupper($_POST['representation_id']);
    $flag_file_path = $_POST['flag'];
    echo $flag_file_path;
//    check duplicate id
    $check_rep = "SELECT representation FROM representation WHERE representation = '$representation'";
    $check_rep_result = mysqli_query($con, $check_rep);
    if($check_rep_result->num_rows == 0){
        $insert_representation = "INSERT INTO representation (representation_id, representation, flag_file_path) VALUES ('$representation_id', '$representation','$flag_file_path')";
        echo $insert_representation;
        if(!mysqli_query($con, $insert_representation))
        {
            echo 'NOT INSERTED';
        }
        else
        {
            echo 'INSERTED';
        }
    }else{
            echo "this representation already exists.";
    }
}
if(isset($_POST['genre'])){
    $genre = ucwords(strtolower($_POST['genre']));
    $genre_id = strtoupper($_POST['genre_id']);
//    check duplicate id
    $check_rep = "SELECT genre FROM genre WHERE genre = '$genre'";
    $check_rep_result = mysqli_query($con, $check_rep);
    if($check_rep_result->num_rows == 0){
        $insert_genre = "INSERT INTO genre (genre_id, genre) VALUES ('$genre_id', '$genre')";
        echo $insert_genre;
        if(!mysqli_query($con, $insert_genre))
        {
            echo 'NOT INSERTED';
        }
        else
        {
            echo 'INSERTED';
        }
    }else{
        echo "this genre already exists.";
    }
}

header("refresh:2; url = ../admin.php");