<?php

session_start();
require_once 'connection.php';

if (isset($_POST['editAccountSubmit'])) {

    $id = $_SESSION['users_id'];
    $usernameInput = $_POST['name'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    
        $sql2 = "UPDATE users SET users_username=?, users_forename=?,users_surname=?,users_email=? WHERE users_id='$id';";
        $stmt2 = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt2, "ssss", $usernameInput, $firstName, $lastName, $email);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        header("location: ../profile.php?error=none");
        exit();

    }