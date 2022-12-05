<?php

if (isset($_POST["registerSubmit"])){ //checking that user got to page through actually signing up

    $usernameInput = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];

    require_once 'connection.php';
    require_once 'functions.inc.php';

    if (emptyInputRegister($usernameInput, $email, $firstName, $lastName, $pwd, $pwdRepeat)!== false){
        header("location: ../registration.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($usernameInput)!== false){
        header("location: ../registration.php?error=invalidusername");
        exit();
    }

    if (invalidEmail($email)!== false){
        header("location: ../registration.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat)!== false){
        header("location: ../registration.php?error=passwordsdontmatch");
        exit();
    }

    if (usernameExists($connection, $usernameInput, $email)!== false){
        header("location: ../registration.php?error=usernametaken");
        exit();
    }
// maybe one for a long enough password


    createUser($connection, $firstName, $lastName, $email, $usernameInput, $pwd);
    mysqli_close($connection);

}
else{
    header("location:../registration.php");
}

