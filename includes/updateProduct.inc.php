<?php

if (isset($_POST["updateProductSubmit"])) {

require_once 'connection.php';
require_once 'functions.inc.php';


$id = $_POST["id"];
$nameInput = $_POST["productName"];
$categoryInput = $_POST["category"];
$descriptionInput = $_POST["description"];
$stockInput = $_POST["quantity"];
$buyPriceInput = $_POST["buyPrice"];
$sellPriceInput = $_POST["sellPrice"];
$imageInput = $_FILES["image"]["name"];
$tmpImageInput = $_FILES["image"]["tmp_name"];       


        if (empty($nameInput) || empty($categoryInput) || empty($descriptionInput) || empty($stockInput) || empty($buyPriceInput) || empty($imageInput)|| empty($tmpImageInput)) {
            $errorMessage = "All fields are required";
            exit;
        }

    updateProduct($connection, $id, $nameInput, $categoryInput, $descriptionInput, $stockInput, $buyPriceInput, $sellPriceInput, $imageInput, $tmpImageInput);

}
    
