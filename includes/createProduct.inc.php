


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ugly Lil Website</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href = "../main.css">
</head>


<body id="index-body" >






<!-- Buttonto trigger create product modal -->
<a type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addProduct">
    Add Product</a>
<!-- Buttonto trigger create product modal End -->


<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content bg-dark border-secondary text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Create New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="">
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Category</label>
                        <div class="">
                            <input type="text" class="form-control" name="category" value="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="">
                           <!-- <input type="text" class="form-control" name="description" rows="4" value="" data-mdb-showcounter="true" maxlength="200">-->
                            <textarea class="form-control" id="textAreaExample" rows="4" name="description" data-mdb-showcounter="true" maxlength="200"></textarea>
                            <div class="form-helper"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Stock</label>
                            <div class="input-group w-auto justify-content-end align-items-center rounded">
                                <input type="number" step="1" max="1000" value="1" name="quantity" class="quantity-field border-0 text-center w-25 rounded">
                            </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Buy Price</label>
                        <div class="">
                            <input type="number" class="form-control" name="buyPrice" value="" step=".01">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Sell Price</label>
                        <div class="">
                            <input type="number" class="form-control" name="sellPrice" value="" step=".01">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Image</label>
                        <div class="">
                            <input type="text" class="form-control" name="image" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button name="createProductSubmit" type="button" class="btn btn-secondary">Create</button>
            </div>
        </div>
    </div>
</div>



<footer>
</footer>

<!-- Bootstrap JS -->
<script src="../bootstrap-4.6.2-dist/jquery.js"></script>
<script src="../bootstrap-4.6.2-dist/popper.js"></script>
<script src="../bootstrap-4.6.2-dist/js/bootstrap.min.js"></script>
<!-- Bootstrap JS End -->
</body>
</html>






<?php
if (isset($_POST["createProductSubmit"])){ //checking that user got to page through admin

$name = $_POST["name"];
$category = $_POST["category"];
$description = $_POST["description"];
$stock = $_POST["stock"];
$buyPrice = $_POST["buyPrice"];
$sellPrice = $_POST["sellPrice"];
$image = $_POST["image"];


require_once 'connection.php';
require_once 'functions.inc.php';

if (emptyInputCreateProduct($name,$category,$description,$stock,$buyPrice,$sellPrice,$image)!== false){
header("location: ../admin.php?error=emptyinput");
exit();
}

if (invalidUsername($username)!== false){
header("location: ../admin.php?error=invalidusername");
exit();
}

if (invalidEmail($email)!== false){
header("location: ../registration.php?error=invalidemail");
exit();
}

if (pwdMatch($pwd, $pwdRepeat)!== false){
header("location: ../registration.php?error=passwordsdontmatch");
exit();
}

if (usernameExists($connection, $username, $email)!== false){
header("location: ../registration.php?error=usernametaken");
exit();
}

}