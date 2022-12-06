<?php

require_once 'connection.php';

if(isset($_POST['editAccountSubmit'])){

    $id=$_SESSION['users_id'];
    $usernameInput=$_POST['name'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];

    $sql= "SELECT * FROM users WHERE users_id='$id';";
    $stmt = mysqli_query($connection,$sql);
    $row = mysqli_fetch_assoc($stmt);
    $result= $row['users_id'];

    if($result === $id){

        $sql2 = "UPDATE users SET users_username=?, users_forename=?,users_surname=?,users_email=? WHERE users_id='$id';";
        $stmt2 = mysqli_stmt_init($connection);


        if (!mysqli_stmt_prepare($stmt2,$sql2)){
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt2, "ssss",$usernameInput, $email, $firstName, $lastName, $email);
        mysqli_stmt_execute($stmt2);

        //$sql2=mysqli_query($connection,$update);

        if($sql2){
            /*Successful*/
            header("location: ../index.php");
        }
        else
        {
            /*profile not updated*/
            header("location: ../profile.php?error=notupdated");
        }
    }
    else
    {
        /*id is not a match*/
        header("location: ../profile.php?error=idnotamatch");
    }
}