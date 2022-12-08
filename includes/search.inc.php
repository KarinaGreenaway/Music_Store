<?php

require_once 'connection.php';
require_once 'functions.inc.php';

$search = $_POST['search'];

$sql = "SELECT * FROM product WHERE product_name LIKE '%$search%'";

$resultData= mysqli_query($connection,$sql);

if ($resultData->num_rows>0){
    while ($productRow = mysqli_fetch_assoc($resultData)) {

        $productName=$productRow["product_name"];
        $categoryName=$productRow["category_name"];
        $productPrice=$productRow["product_sell_price"];
        $productImage=$productRow["product_image"];

        echo "

        <div class='col-sm-6 col-md-4 col-lg-4 col-xl-3 pt-4'>
           <div class='card bg-light border-secondary border-2' style='height: 70vh' >
               <img class='card-img-top' src='admin/product_images/$productImage' alt='$productName Image' style='width: 100%; height: 30vh; object-fit: contain;'>
               <div class='card-body h-100 d-flex flex-column'>
                   <h5 class='card-title'>$productName</h5>
                   <h6 class='card-subtitle mb-2 text-muted'>$categoryName</h6>
                   <p class='card-text'>£$productPrice</p>
                   <a href='#' class='card-link text-secondary'>Read More</a>
        <a href='#' class='btn btn-dark mt-auto'>Add to Cart</a>
               </div>
           </div>
       </div>
       
        ";
    }
}

else{
    echo "0 records";
}




