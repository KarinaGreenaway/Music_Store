<?php
include_once 'header.php';
?>

<!-- Header-->
<header class="bg-dark text-white py-4">
    <div class="container px-3 px-lg-4 my-4">
    <?php

    if (isset($_SESSION['users_status'])) {
        $message = $_SESSION['users_status'];
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Hey! $message </strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";
        unset($message);
    }
    ?>

<?php

if (!empty($errorMessage)) {
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Hey! $errorMessage </strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
    unset($errorMessage);
}
?>


        <div class="text-center text-white">
            <?php
            if (isset($_SESSION["users_username"])){
                echo "<h3 class='font-weight-light'>Welcome to Your Admin ".$_SESSION["users_username"]."!</h3>";
            }
            ?>
            <?php
            if (isset($_SESSION["users_status"])){
                echo "<h3 class='font-weight-light'>Welcome to Your Admin ".$_SESSION["users_status"]."!</h3>";
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