<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Symphony</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 CSS-->
    <link rel="stylesheet" href="bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href = "main.css">
</head>


<body id="index-body" >

<!-- Navbar Start-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="Images/logo.png" width="30" height="30"  class="d-inline-block align-top" alt="Logo">
        Symphony Official Store </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">HOME</a>
            </li>

            <?php
            if ((isset($_SESSION["users_username"]))&&($_SESSION["users_is_admin"]===1)){
                echo "<li class='nav-item'><a class='nav-link' href='profile.php'>MY ACCOUNT</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='admin.php'>MY ADMIN</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='includes/signout.inc.php'>SIGN OUT</a></li>";
            }
            elseif (isset($_SESSION["users_username"])){
                echo "<li class='nav-item'><a class='nav-link' href='profile.php'>MY ACCOUNT</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='includes/signout.inc.php'>SIGN OUT</a></li>";
            }
            else{
                echo "<li class='nav-item'><a class='nav-link' href='signin.php'>SIGN IN</a></li>";
            }
            ?>


        </ul>
        <form action="searchResults.php" method="POST" class="form-inline my-2 my-lg-0 mx-1">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>

            <a href="cart.php" class="btn btn-outline-secondary my-2 mx-2 my-sm-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
            </a>

        </form>
    </div>
</nav>
<!-- Navbar End-->

