<?php
session_start();
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Ugly Lil Website</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="../bootstrap-4.6.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href = "../main.css">
    </head>


    <body id="index-body" >

    <!-- Navbar Start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../index.php">
            <img src="../Images/logo.png" width="30" height="30"  class="d-inline-block align-top" alt="Logo">
            Symphony Official Store </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">HOME</a>
                </li>

                <?php
                if ((isset($_SESSION["users_username"]))&&($_SESSION["users_is_admin"]===1)){
                    echo "<li class='nav-item'><a class='nav-link' href='../profile.php'>MY ACCOUNT</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='../admin.php'>MY ADMIN</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='signout.inc.php'>SIGN OUT</a></li>";
                }
                elseif (isset($_SESSION["users_username"])){
                    echo "<li class='nav-item'><a class='nav-link' href='../profile.php'>MY ACCOUNT</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='signout.inc.php'>SIGN OUT</a></li>";
                }
                else{
                    echo "<li class='nav-item'><a class='nav-link' href='../signin.php'>SIGN IN</a></li>";
                }
                ?>


            </ul>
            <form class="form-inline my-2 my-lg-0 mx-1">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>

                <a href="../cart.php" class="btn btn-outline-secondary my-2 mx-2 my-sm-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
                </a>

            </form>
        </div>
    </nav>
    <!-- Navbar End-->


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
                <form method="post" action="createProduct.inc.php" enctype="multipart/form-data">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="" autocomplete="off">
                            </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                        <select name="category" class="form-control">
                            <option value="">Select a Category</option>
                            <?php
                            require_once 'dynamicCategories.inc.php';
                            ?>
                        </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="textAreaExample" rows="4" name="description" data-mdb-show-counter="true" maxlength="200"></textarea>
                            <div class="form-helper"></div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Stock</label>
                        <div class="input-group justify-content-end align-items-center rounded col-sm-9">
                            <input min="1" max="1000" type="number" step="1" value="" name="quantity" class="quantity-field border-0 text-center w-25 rounded"  autocomplete="off">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Buy Price</label>
                        <div class="col-sm-9 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">£</span>
                            </div>
                            <!-- oninput="restrict(this)"-->
                            <input min="0.00" type="number" class="form-control" name="buyPrice" value="" step=".01"  autocomplete="off">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Sell Price</label>
                        <div class="col-sm-9 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">£</span>
                            </div>
                            <input min="0.00" type="number" class="form-control" name="sellPrice" value="" step=".01">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control align-content-center" name="image" value="">
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="createProductSubmit" class="btn btn-secondary" value="Create">
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

if (invalidProductName($name)!== false){
header("location: ../admin.php?error=invalidproductname");
exit();
}

if (invalidProductStock($stock)!== false){
header("location: ../registration.php?error=invalidstock");
exit();
}

if (pwdMatch($pwd, $pwdRepeat)!== false){
header("location: ../registration.php?error=passwordsdontmatch");
exit();
}

if (productExists($connection, $name, $category)!== false){
header("location: ../admin.php?error=productexists");
exit();
}

    createProduct($connection, $name, $category, $description, $stock, $buyPrice, $sellPrice, $image);
    mysqli_close($connection);

}