<?php
include_once 'header.php';
?>

<!-- Header-->
<header class="bg-dark text-white py-4" >
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <?php
            if (isset($_SESSION["users_username"])){
                echo "<p class='lead fw-normal text-white-50 mb-0'>Welcome ".$_SESSION["users_username"]."!</p>";
            }
            ?>
            <h1 class="display-4 fw-lighter">Amazing Offers on Amazing Quality </h1>
            <p class="lead fw-normal text-white-50 mb-0">Premium Instruments & Music Sheets</p>
        </div>
    </div>
</header>
<!-- Header End-->


<!-- In case of admin errors-->
<?php
if ($_GET["error"] == "queryfailed"){
    echo "
    <div class='alert alert-secondary alert-dismissible fade show' role='alert'>
    <strong>Oh No!</strong> We had an issue connecting you to Your Admin, try again later.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
    ";
}
?>
<!-- In case of admin errors End-->


<!--Product Gallery-->
<div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
    <h4 class="text-light text-center font-weight-lighter mb-3"> Shop Our Products</h4>


   <div class="row px-4">
       <!--Fetching products-->
       <?php
       require_once 'includes/products.inc.php';
       ?>

   </div>
</div>
<!--Product Gallery End-->


<?php
include_once 'footer.php';
?>