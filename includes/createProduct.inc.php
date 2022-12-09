<?php

$errorMessage = "";
$successMessage = "";
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


if(emptyInputCreateProduct($name,$category,$description,$stock,$buyPrice,$sellPrice,$image)!== false){
    $errorMessage= "Please fill in all fields.";
    header("location: ../admin.php?error=emptyinput"); //needs to be implemented
}

else{

    uploadImage($image, $tmp_image);
    createProduct($connection, $name, $category, $description, $stock, $buyPrice, $sellPrice, $image);
    mysqli_close($connection); 
}






//if (invalidProductName($name)!== false){
//$errorMessage= "Please enter a valid product name.";
//exit();
//}

//if (invalidProductStock($stock)!== false){
//$errorMessage= "Please enter a valid stock amount.";
//exit();
//}

//if ( invalidProductPrice($buyPrice,$sellPrice)!== false){
//$errorMessage= "Please enter valid product prices";
//exit();
//}

//if (productExists($connection, $name, $category)!== false){
//$errorMessage= "Sorry, this product already exists";
//exit();
//}


