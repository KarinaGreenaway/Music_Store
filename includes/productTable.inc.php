<?php

require_once 'connection.php';
require_once 'functions.inc.php';


getProductTable($connection);
mysqli_close($connection);

// Below checks if there has been any error during query execution and if so sends the user back to the home page
if (!$resultData){
    header("location:../index.php?error=queryfailed");
    exit();

}