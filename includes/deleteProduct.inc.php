<?php

//if (isset($_POST["deleteProductSubmit"])) {

require_once 'connection.php';
require_once 'functions.inc.php';


$id = $_GET["id"];
deleteProduct($connection, $id);
mysqli_close($connection);
//}
    