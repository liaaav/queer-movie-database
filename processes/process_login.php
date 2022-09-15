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

    $login_query = "SELECT password, is_admin FROM users WHERE username = '" . $user . "'";
    $login_result = mysqli_query($con, $login_query);
    $login_record = mysqli_fetch_assoc($login_result);


    $hash = $login_record['password'];

    $verify = password_verify($pass, $hash);

    if($login_record['is_admin'] == 1){
        $admin = true;
    }else{
        $admin = false;
    }


    if($verify) {
        $_SESSION['logged_in'] = 1;
        $_SESSION['username'] = $user;
        $_SESSION['admin'] = $admin;
        header("Location: ../index.php");
    }
    else{
        header("Location: ../login.php");
    }
