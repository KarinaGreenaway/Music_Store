<?php
session_start();

if (isset($_POST['editAccountSubmit'])) {

    $id = $_SESSION['users_id'];
    $usernameInput = $_POST['name'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];


    require_once 'connection.php';
    require_once 'functions.inc.php';

    updateAccount($connection, $usernameInput, $firstName, $lastName, $email, $id);
    mysqli_close($connection);

    }