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
        <link rel="stylesheet" href="bootstrap-4.6.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href = "main.css">
    </head>


    <body id="index-body" >

    <!-- Navbar Start-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">
            <img src="Images/logo.png" width="30" height="30"  class="d-inline-block align-top" alt="Logo">
            Symphony Official Store </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">HOME</a>
                </li>

                <?php
                if ((isset($_SESSION["users_username"]))&&($_SESSION["users_is_admin"]===1)){
                    echo "<li class='nav-item'><a class='nav-link' href='profile.php'>MY ACCOUNT</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='admin.php'>MY ADMIN</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='includes/signout.inc.php'>SIGN OUT</a></li>";
                }
                elseif (isset($_SESSION["users_username"])){
                    echo "<li class='nav-item'><a class='nav-link' href='profile.php'>MY ACCOUNT</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='includes/signout.inc.php'>SIGN OUT</a></li>";
                }
                else{
                    echo "<li class='nav-item'><a class='nav-link' href='signin.php'>SIGN IN</a></li>";
                }
                ?>


            </ul>
            <form class="form-inline my-2 my-lg-0 mx-1">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>

                <a href="cart.php" class="btn btn-outline-secondary my-2 mx-2 my-sm-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span class="badge bg-light text-dark ms-1 rounded-pill">0</span>
                </a>

            </form>
        </div>
    </nav>
    <!-- Navbar End-->

    <!-- Header-->
    <header class="bg-dark text-white py-4">
        <div class="container px-3 px-lg-4 my-4">
            <div class="text-center text-white">
                <?php
                if (isset($_SESSION["users_username"])){
                    echo "<h3 class='font-weight-light'>Welcome to Your Admin ".$_SESSION["users_username"]."!</h3>";
                }
                ?>
            </div>
        </div>
    </header>
    <!-- Header End-->

    <!--Product Table-->
    <div class="container-fluid p-md-4 p-lg-5">
        <h5 class="text-light py-2 px-0">Product Table:</h5>

        <!-- Create Product Button and Modal-->
        <div class="container-fluid pb-3 pt-0 px-0 ">
            <a type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addProduct">
                Add Product</a>
        </div>

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
                        <form method="post" action="includes/createProduct.inc.php" enctype="multipart/form-data">

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
                                        <option value="">Select a Category</option>
                                        <option value="">Select a Category</option>
                                        <option value="">Select a Category</option>
                                        <option value="">Select a Category</option>
                                        <option value="">Select a Category</option>
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
                        <button name="createProductSubmit" type="button" class="btn btn-secondary">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Product Button and Modal End -->
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Buy Price</th>
                    <th scope="col">Sell Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <!--Fetching product table rows-->
                <?php
                require_once 'includes/productTable.inc.php';
                ?>
                <!--Fetching product table rows End-->
                </tbody>
            </table>
        </div>
    </div>
    <!--Product Table End-->




    <footer>
    </footer>

    <!-- Bootstrap JS -->
    <script src="bootstrap-4.6.2-dist/jquery.js"></script>
    <script src="bootstrap-4.6.2-dist/popper.js"></script>
    <script src="bootstrap-4.6.2-dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap JS End -->
    </body>
    </html>

