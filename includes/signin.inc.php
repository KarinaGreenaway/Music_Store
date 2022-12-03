<?php
if (isset($_POST["signinSubmit"])){
    $user=$_POST["user"];
    $pwd=$_POST["pwd"];

    require_once 'connection.php';
    require_once 'functions.inc.php';

    if (emptyInputSignin($user, $pwd)!== false){
        header("location: ../signin.php?error=emptyinput");
        exit();
    }

    signinUser($connection,$user,$pwd);
}
else{
    header("location:../signin.php");
    exit;
}
