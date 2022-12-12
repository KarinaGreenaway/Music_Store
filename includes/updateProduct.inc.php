<?php

require_once 'connection.php';
require_once 'functions.inc.php';

if (isset($_POST["updateProductSubmit"])) {

    $id = $_POST["id"];
    $nameInput = $_POST["productName"];
    $categoryInput = $_POST["category"];
    $descriptionInput = $_POST["description"];
    $stockInput = $_POST["quantity"];
    $buyPriceInput = $_POST["buyPrice"];
    $sellPriceInput = $_POST["sellPrice"];
    $imageInput = $_FILES["image"]["name"];
    $tmpImageInput = $_FILES["image"]["tmp_name"];     

    if(emptyInputCreateProduct($nameInput,$categoryInput,$descriptionInput,$stockInput,$buyPriceInput,$sellPriceInput,$imageInput)!==false){
        header("location: ../admin.php?error=emptyinput"); 
    }
    elseif(invalidProductStock($stockInput)!==false){
        header("location: ../admin.php?error=invalidstock"); 
    }
    elseif(invalidProductPrice($buyPriceInput,$sellPriceInput)!==false){
        header("location: ../admin.php?error=invalidprice"); 
    }
    else{
    updateProduct($connection, $id, $nameInput, $categoryInput, $descriptionInput, $stockInput, $buyPriceInput, $sellPriceInput, $imageInput, $tmpImageInput);
    header("location: ../admin.php?error=updatenone");       
    }  
}

elseif (isset($_POST['deleteProductSubmit'])) {
    $id = $_POST["id"];
    header("location: ../admin.php?delete=$id");  

}
elseif (isset($_POST['deleteProductSubmitConfirmed'])) {
    $id = $_POST["id"];
    deleteProduct($connection, $id);
    mysqli_close($connection);
    header("location: ../admin.php?error=deletenone");
    
}
    
