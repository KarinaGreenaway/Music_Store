<?php

if (isset($_POST["registerSubmit"])){

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

    elseif (invalidUsername($usernameInput)!== false){
        header("location: ../registration.php?error=invalidusername");
        exit();
    }
    elseif (invalidName($firstName, $lastName)!== false){
        header("location: ../registration.php?error=invalidname");
        exit();
    }
    elseif (invalidEmail($email)!== false){
        header("location: ../registration.php?error=invalidemail");
        exit();
    }

    elseif (pwdMatch($pwd, $pwdRepeat)!== false){
        header("location: ../registration.php?error=passwordsdontmatch");
        exit();
    }

    elseif (usernameExists($connection, $usernameInput, $email)!== false){
        header("location: ../registration.php?error=usernametaken");
        exit();
    }

    else{
        createUser($connection, $firstName, $lastName, $email, $usernameInput, $pwd);
        mysqli_close($connection);
    }


// maybe one for a long enough password

}


