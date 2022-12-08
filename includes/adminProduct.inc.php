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

        move_uploaded_file($tmpImageInput, "../admin/product_images/$imageInput");

        $sql = "UPDATE product SET product_name=?, category_name=?, product_description=?, product_stock=?, product_buy_price=?, product_sell_price=?, product_image=? WHERE product_id='$id';";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $errorMessage = "Invalid query: " . $connection->error;
            exit;
        }
        mysqli_stmt_bind_param($stmt, "sssidds", $nameInput, $categoryInput, $descriptionInput, $stockInput, $buyPriceInput, $sellPriceInput, $imageInput);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $successMessage = "Product updated successfully";
        header("location: ../admin.php");
        exit;

}
    
