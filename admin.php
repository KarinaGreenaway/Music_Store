<?php
session_start();
?>

<?php
include_once 'header.php';
?>

<!-- Header-->
<header class="bg-dark text-white py-4" >
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

    <div class="container-fluid pb-3 pt-0 px-0 ">
        <!--<a class="btn btn-outline-secondary" href="include/createProduct.inc.php" role="button">Add Product</a>-->
        <!-- Button trigger modal -->
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
                                <input type="text" class="form-control" name="description" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Stock</label>
                            <div class="">
                                <input type="text" class="form-control" name="stock" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Buy Price</label>
                            <div class="">
                                <input type="text" class="form-control" name="buyPrice" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sell Price</label>
                            <div class="">
                                <input type="text" class="form-control" name="sellPrice" value="">
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
                    <button type="button" class="btn btn-secondary">Create</button>
                </div>
            </div>
        </div>
    </div>



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


<?php
include_once 'footer.php';
?>