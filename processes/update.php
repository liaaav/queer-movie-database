<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$movie_name = str_replace("'", "''", $_POST['movie_name']);
$update_movie = "UPDATE movie SET movie_name = '$movie_name', release_year = '$_POST[release_year]', language = '$_POST[language]', img_file_path = '$_POST[img]' WHERE movie_id ='$_POST[movie_id]'";

$delete_existing_genres = "DELETE FROM movie_genre WHERE movie_id='$_POST[movie_id]'";
if(!mysqli_query($con, $delete_existing_genres))
{
    echo 'not deleted';
}
else
{
    echo 'deleted';
}


$all_genre_query = "SELECT * FROM genre";
$all_genre_result = mysqli_query($con, $all_genre_query);

while ($all_genre_record = mysqli_fetch_assoc($all_genre_result)){
    if(in_array($all_genre_record['genre'], $_POST)){
        $genre_id = $all_genre_record['genre_id'];
        $update_genres = "INSERT INTO movie_genre (movie_id, genre_id) VALUES (' $_POST[movie_id] ', '$genre_id')";
        if(!mysqli_query($con, $update_genres))
        {
            echo 'GENRES NOT UPDATED';
        }
        else
        {
            echo 'GENRES UPDATED';
        }
    }
}

$delete_existing_representation = "DELETE FROM movie_representation WHERE movie_id='$_POST[movie_id]'";
if(!mysqli_query($con, $delete_existing_representation))
{
    echo 'not deleted';
}
else
{
    echo 'deleted';
}

$all_representation_query = "SELECT * FROM representation";
$all_representation_result = mysqli_query($con, $all_representation_query);

while ($all_representation_record = mysqli_fetch_assoc($all_representation_result)){
    if(in_array($all_representation_record['representation'], $_POST)){
        $representation_id = $all_representation_record['representation_id'];
        $update_representation = "INSERT INTO movie_representation (movie_id, representation_id) VALUES (' $_POST[movie_id] ', '$representation_id')";
        if(!mysqli_query($con, $update_representation))
        {
            echo 'REPRESENTATION NOT UPDATED';
        }
        else
        {
            echo 'REPRESENTATION UPDATED';
        }
    }
}

if(!mysqli_query($con, $update_movie))
{
    echo 'NOT UPDATED';
}
else
{
    echo 'UPDATED';
}

header("refresh:2; url = ../movie.php?movie=" . $_POST['movie_id']);
?>