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
        header("location: ../admin.php?error=emptyinput"); 
    }
    elseif(invalidProductStock($stock)!==false){
        header("location: ../admin.php?error=invalidstock"); 
    }
    elseif(invalidProductPrice($buyPrice,$sellPrice)!==false){
        header("location: ../admin.php?error=invalidprice"); 
    }
    elseif(productExists($connection, $name, $category)!==false){
        header("location: ../admin.php?error=productexists"); 
    }
    else{

        uploadImage($image, $tmp_image);
        createProduct($connection, $name, $category, $description, $stock, $buyPrice, $sellPrice, $image);
        mysqli_close($connection); 
    }

