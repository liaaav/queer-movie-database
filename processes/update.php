<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}

$update_movie = "UPDATE movie SET movie_name = '$_POST[movie_name]', release_year = '$_POST[release_year]', language = '$_POST[language]' WHERE movie_id ='$_POST[movie_id]'";

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
            echo 'NOT UPDATED';
        }
        else
        {
            echo 'UPDATED';
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