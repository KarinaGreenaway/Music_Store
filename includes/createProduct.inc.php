<?php

//if (isset($_POST["createProductSubmit"])){

$name = $_POST["productName"];
$category = $_POST["category"];
$description = $_POST["description"];
$stock = $_POST["quantity"];
$buyPrice = $_POST["buyPrice"];
$sellPrice = $_POST["sellPrice"];
$image = $_FILES["image"]["name"];
$tmp_image = $_FILES["image"]["tmp_name"];


require_once 'connection.php';
require_once 'functions.inc.php';

uploadImage($image, $tmp_image);
createProduct($connection, $name, $category, $description, $stock, $buyPrice, $sellPrice, $image);
mysqli_close($connection);

//}

//if(emptyInputCreateProduct($name,$category,$description,$stock,$buyPrice,$sellPrice,$image)!== false){
//header("location: ../admin.php?error=emptyinput");
//exit();
//}

//if (invalidProductName($name)!== false){
//header("location: ../admin.php?error=invalidproductname");
//exit();
//}

//if (invalidProductStock($stock)!== false){
//header("location: ../registration.php?error=invalidstock");
//exit();
//}

//if ( invalidProductPrice($buyPrice,$sellPrice)!== false){
//header("location: ../registration.php?error=passwordsdontmatch");
//exit();
//}

//if (productExists($connection, $name, $category)!== false){
//header("location: ../admin.php?error=productexists");
//exit();
//}


