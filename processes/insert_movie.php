<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$movie_name = $_POST['movie_name'];
$release_year = $_POST['release_year'];
$language = $_POST['language'];

$movie_name = str_replace("'", "''", $movie_name);
$insert_movie = "INSERT INTO movie (movie_name, release_year, language) VALUES ('$movie_name','$release_year','$language')";
echo $insert_movie;
if(!mysqli_query($con, $insert_movie))
{
    echo 'NOT INSERTED';
}
else
{
    echo 'INSERTED';
}

$id_query = "SELECT movie_id FROM movie WHERE movie_name = '" .$movie_name . "'";
echo $id_query;
$id_result = mysqli_query($con, $id_query);
$id_record = mysqli_fetch_assoc($id_result);

$movie_id = $id_record['movie_id'];

$all_genre_query = "SELECT * FROM genre";
$all_genre_result = mysqli_query($con, $all_genre_query);

while ($all_genre_record = mysqli_fetch_assoc($all_genre_result)){
    if(in_array($all_genre_record['genre'], $_POST)){
        $genre_id = $all_genre_record['genre_id'];
        $update_genres = "INSERT INTO movie_genre (movie_id, genre_id) VALUES ('$movie_id', '$genre_id')";
        if(!mysqli_query($con, $update_genres))
        {
            echo 'NOT INSERTED';
        }
        else
        {
            echo 'INSERTED';
        }
    }
}

$all_representation_query = "SELECT * FROM representation";
$all_representation_result = mysqli_query($con, $all_representation_query);

while ($all_representation_record = mysqli_fetch_assoc($all_representation_result)){
    if(in_array($all_representation_record['representation'], $_POST)){
        $representation_id = $all_representation_record['representation_id'];
        $update_representation = "INSERT INTO movie_representation (movie_id, representation_id) VALUES ('$movie_id', '$representation_id')";
        if(!mysqli_query($con, $update_representation))
        {
            echo 'NOT INSERTED';
        }
        else
        {
            echo 'INSERTED';
        }
    }
}




header("refresh:2; url = ../index.php");
?>