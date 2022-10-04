<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
echo "connected to database";
}
if(isset($_GET['movie_id'])){
    $delete_movie = "DELETE FROM movie WHERE movie_id='$_GET[movie_id]'";
    if(!mysqli_query($con, $delete_movie))
    {
        echo 'NOT DELETED';
    }
    else
    {
        echo 'DELETED';
    }
    header('Location: ../movies.php');
//    makes sure code below doesn't get executed when redirected
    exit;
}

if(isset($_GET['review_id'])){
    $delete_review = "DELETE FROM review WHERE review_id='$_GET[review_id]'";
    if(!mysqli_query($con, $delete_review))
    {
        echo 'NOT DELETED';
    }
    else
    {
        echo 'DELETED REVIEW';
    }
}

if(isset($_GET['genre_id'])){
    $delete_genre = "DELETE FROM genre WHERE genre_id='$_GET[genre_id]'";
    if(!mysqli_query($con, $delete_genre))
    {
        echo 'NOT DELETED';
    }
    else
    {
        echo 'DELETED GENRE';
    }

}


if(isset($_GET['representation_id'])){
    $delete_representation = "DELETE FROM representation WHERE representation_id='$_GET[representation_id]'";
    if(!mysqli_query($con, $delete_representation))
    {
        echo 'NOT DELETED';
    }
    else
    {
        echo 'DELETED REPRESENTATION';
    }

}

if(isset($_GET['user_id'])){
    $delete_user = "DELETE FROM users WHERE user_id = '$_GET[user_id]'";
    if(!mysqli_query($con, $delete_user))
    {
        echo 'NOT DELETED';
    }
    else
    {
        echo 'DELETED USER';
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

