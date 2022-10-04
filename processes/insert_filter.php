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
    $description = str_replace("'", "&apos;", $_POST['description']);

    $flag_file_path = $_FILES['fileToUpload']['name'];
    echo $flag_file_path;

//    check duplicate id
    $check_rep = "SELECT representation FROM representation WHERE representation = '$representation'";
    $check_rep_result = mysqli_query($con, $check_rep);
    if($check_rep_result->num_rows == 0){
        $insert_representation = "INSERT INTO representation (representation_id, representation, flag_file_path, description) VALUES ('$representation_id', '$representation','$flag_file_path','$description')";
        echo $insert_representation;
//        upload image to server
            $target_dir = "../flag_images/";
            echo print_r($_FILES);
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            /*// Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }*/

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
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
        }
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