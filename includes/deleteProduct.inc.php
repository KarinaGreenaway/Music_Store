<?php

//if (isset($_POST["deleteProductSubmit"])) { THIS FILE ISNT USED

require_once 'connection.php';
require_once 'functions.inc.php';


//$id = $_GET["id"];
//deleteProduct($connection, $id);
//mysqli_close($connection);

//}

//if (isset($_POST['deleteProductSubmit'])) {

//    header("location: ../profile.php?require=confirmproductdelete");  

//}
if (isset($_POST['deleteProductSubmitConfirmed'])) {

    $id = $_GET["id"];

    deleteProduct($connection, $id);
    mysqli_close($connection);
    header("location: ../admin.php?error=deletenone");
    
}
    