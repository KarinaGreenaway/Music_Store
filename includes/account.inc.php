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

elseif( invalidUserName($usernameInput)!== false){
    header("location: ../profile.php?error=invalidusername");  
}

elseif( invalidName($firstName, $lastName)!== false){
    header("location: ../profile.php?error=invalidname");  
}

elseif(invalidEmail($email)!== false){
    header("location: ../profile.php?error=invalidemail");  
}

elseif (isset($_POST['editAccountSubmit'])) {
    updateAccount($connection, $usernameInput, $firstName, $lastName, $email, $id);
    mysqli_close($connection);
}

/** The elseif statement below passes a requirement through a header
 * rather than an error that is checked in profile.php to confirm the
 * user wants to delete their account, preventing deleting it by mistake.
 */
elseif (isset($_POST['deleteAccountSubmit'])) {
    header("location: ../profile.php?require=confirmpassword");  
}

elseif (isset($_POST['deleteAccountSubmitConfirmed'])) {
    $id = $_SESSION['users_id'];
    deleteAccount($connection, $id);
    mysqli_close($connection); 
}