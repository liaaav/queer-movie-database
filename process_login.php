<?php
session_start();
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database <br>";
}
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    $_SESSION['username'] = $user;

    $login_query = "SELECT password FROM users WHERE username = '" . $user . "'";
    $login_result = mysqli_query($con, $login_query);
    $login_record = mysqli_fetch_assoc($login_result);

    $hash = $login_record['password'];

    $verify = password_verify($pass, $hash);
    if($verify) {
        $_SESSION['logged_in'] = 1;
        header("Location: index.php");
    }
    else{
        header("Location: login.php");
    }
