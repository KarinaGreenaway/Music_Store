<?php
if (isset($_POST["createProductSubmit"])){ //checking that user got to page through admin

$name = $_POST["productName"];
$category = $_POST["category"];
$description = $_POST["description"];
$stock = $_POST["stock"];
$buyPrice = $_POST["buyPrice"];
$sellPrice = $_POST["sellPrice"];
$image = $_FILES["image"]["name"];
$tmp_image = $_FILES["image"]["tmp_name"];


require_once 'connection.php';
require_once 'functions.inc.php';


if(emptyInputCreateProduct($name,$category,$description,$stock,$buyPrice,$sellPrice,$image)!== false){
header("location: ../admin.php?error=emptyinput");
exit();
}

if (invalidProductName($name)!== false){
header("location: ../admin.php?error=invalidproductname");
exit();
}

if (invalidProductStock($stock)!== false){
header("location: ../registration.php?error=invalidstock");
exit();
}

if ( invalidProductPrice($buyPrice,$sellPrice)!== false){
header("location: ../registration.php?error=passwordsdontmatch");
exit();
}

if (productExists($connection, $name, $category)!== false){
header("location: ../admin.php?error=productexists");
exit();
}



    createProduct($connection, $name, $category, $description, $stock, $buyPrice, $sellPrice, $image,$tmp_image);
    mysqli_close($connection);

}