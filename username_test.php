<?php

$password = 'Urmom';

$bcrypt_password = password_hash($password,  PASSWORD_BCRYPT);
echo "<br>Bcyrpt Password: " .$bcrypt_password;
/*
$user_types = 'Urmom';

$verify = password_verify($user_types, $bcrypt_password);
echo "<br>";

if($verify) {
    echo "Access Granted!";
}else{
    echo "Incorrect Password";
}*/
?>