<?php
session_start();

$id = $_SESSION['users_id'];
$usernameInput = $_POST['name'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];

require_once 'connection.php';
require_once 'functions.inc.php';

if(emptyInputUpdateAccount($usernameInput, $firstName, $lastName, $email)!== false){
    header("location: ../profile.php?error=emptyinput");  
}

elseif (isset($_POST['editAccountSubmit'])) {

    updateAccount($connection, $usernameInput, $firstName, $lastName, $email, $id);
    mysqli_close($connection);

    }


elseif (isset($_POST['deleteAccountSubmit'])) {

    $id = $_SESSION['users_id'];


    require_once 'connection.php';
    require_once 'functions.inc.php';

    deleteAccount($connection, $id);
    mysqli_close($connection);

    }