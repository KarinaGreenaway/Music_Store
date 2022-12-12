<?php
include_once 'header.php';
?>

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

    <?php
    include_once 'createProduct.php';
    ?>

    <?php

    if (isset($_GET["error"])) {

        if ($_GET["error"] == "emptyinput") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Please fill in all fields.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "invalidstock") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Please enter a valid stock number.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "invalidprice") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Please enter valid prices.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "productexists") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>This product already exists.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "notadmin") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Oops! We could not verify that you are admin. Try signing in again.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        }elseif ($_GET["error"] == "stmtfailed") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Oops! There was a connection issue on our end. Try again later.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "createnone") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Product created successfully!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "updatenone") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Product updated successfully!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        } elseif ($_GET["error"] == "deletenone") {
            echo "
            <div class='alert alert-light alert-dismissible fade show' role='alert'>
                <strong>Product deleted successfully!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>    
            ";
        }
    }
    elseif (isset($_GET["delete"])) {
        $id = $_GET["delete"];
        echo "
        <form action='includes/updateProduct.inc.php' method='post'>
        <div class='alert alert-light alert-dismissible fade show' role='alert'>
            <strong>Are you sure you want to delete this product? All it's saved information will be deleted.</strong>
            <input  type='hidden' name='id' class='btn btn-secondary btn-block m-2' value='$id'/>
            <input  type='submit' name='deleteProductSubmitConfirmed' class='btn btn-secondary btn-block m-2' value='Yes'/>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>  
        ";
    }

    ?>

    <form action="includes/updateProduct.inc.php" method="post" id="productForm">
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
    </form>
</div>
<!--Product Table End-->

<?php
include_once 'footer.php';
?>