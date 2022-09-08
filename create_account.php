<?php
$con = mysqli_connect("localhost", "liav", "swifthelp20", "liav_queer");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Queer Movie Database </title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href="style.css">
</head>
<body>
<header>
    <nav>
        <div class = "navbar">
            <div class = "navbar__container">
                <li>
                    <a class="button" href="index.php">Home</a>
                </li>
                <li>
                    <a class="button" href="movies.php">Movies</a>
                </li>
                <li>
                    <a class="button" href="about_us.php">About Us</a>
                </li>
                <li>
                    <a class="button" href="login.php">Login</a>
                </li>
                <li>
                    <a class="button" href="logout.php">Logout</a>
                </li>
                <!-- search bar -->
                <table>
                    <form action="search.php" method="post">
                        <tr>
                            <td>
                                <input type="text" placeholder="Search"
                                       class="search" name="search">
                            </td>
                            <td>
                                <button type="submit" name="submit" value="Search">
                                    <span class="material-icons-outlined">search</span>
                                </button>
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </nav>
</header>
<main>
    <h2> Enter details here </h2>
    <!-- Login Form -->
    <form name = 'account_form' method = 'post' action = 'create_account_process.php'>
        <label for="username"> Username: </label>
        <input type="text" name="username"><br>

        <label for=password"> Password: </label>
        <input type="password" name="password"><br>

        <input type="submit" name="submit" id="submit" value="submit">
    </form>
</main>
