<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
$movie_name = str_replace("'", "&apos;", $_POST['movie_name']);
$update_movie = "UPDATE movie SET movie_name = '$movie_name', release_year = '$_POST[release_year]', language = '$_POST[language]' WHERE movie_id ='$_POST[movie_id]'";

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

echo "<br>";

// if there is a file to upload - checks it and uploads it to the server
if(isset($_FILES['fileToUpload']['name'])){
    $target_dir = "../movie_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

/*    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }*/

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    print_r($_FILES["fileToUpload"]["size"]);
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $update_movie = "UPDATE movie SET img_file_path = '".$_FILES['fileToUpload']['name']. "' WHERE movie_id ='$_POST[movie_id]'";
            if(!mysqli_query($con, $update_movie))
            {
                echo 'NOT UPDATED';
            }
            else
            {
                echo 'UPDATED';
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}

// clear server images of unused images

    $all_file_paths_query = "SELECT img_file_path FROM movie";
    $all_file_paths_result = mysqli_query($con, $all_file_paths_query);

    //puts all file paths into an array
    $all_file_paths = [];
    while($all_file_paths_record = mysqli_fetch_assoc($all_file_paths_result)){
        $all_file_paths[] = $all_file_paths_record['img_file_path'];
    }
//    target directory
    $dir = "../movie_images/";

    //if directory exists - reads its contents
    if (is_dir($dir))
    {

        if ($dh = opendir($dir))
        {
            while (($file = readdir($dh)) !== false)
            {
                if(!in_array($file, $all_file_paths)){
                    unlink($dir . $file);
                }
            }

            closedir($dh);

        }

    }


header("refresh:2; url = ../movie.php?movie=" . $_POST['movie_id']);
?>