<?php
include_once 'header.php';
?>

<div class="container-fluid">
    <div class="d-flex list-group list-group-horizontal justify-content-center" >
        <!-- Update Product-->
        <form method="post" action="includes/updateProduct.inc.php" id="editProductForm" enctype="multipart/form-data">
            <div class="d-flex list-group list-group-horizontal justify-content-center mt-4" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editProductForm" aria-hidden="true">
                <div class=" bg-dark border-secondary text-light">
                    <?php

                    require_once 'includes/connection.php';

                    $id = "";
                    $name = "";
                    $category = "";
                    $description = "";
                    $stock = "";
                    $buyPrice = "";
                    $sellPrice = "";
                    $image = "";
                    $tmp_image = "";

                    $errorMessage = "";
                    $successMessage = "";

                    $id = $_GET["id"];
                    $sql="SELECT * FROM product WHERE product_id='$id'";

                        $productData=mysqli_query($connection, $sql);

                        if (!$productData){
                            echo " <h1 class='alert alert-danger'>Could not fetch your account data. Try again later.</h1> ";
                        }
                        else {
                            while ($productRow = mysqli_fetch_assoc($productData)) {
                            $name = $productRow["product_name"];
                            $category = $productRow["category_name"];
                            $description = $productRow["product_description"];
                            $stock = $productRow["product_stock"];
                            $buyPrice = $productRow["product_buy_price"];
                            $sellPrice = $productRow["product_sell_price"];
                            $image = $productRow["product_image"];
                            }
                        }
                    ?>

                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalScrollableTitle'>Edit Product</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span class='text-light' aria-hidden='true'>&times;</span>
                        </button>
                    </div>
            
                    <div class='modal-body'>
                        <input type="hidden" name="id" value="<?php echo $id;?>">     
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Name</label>
                            <div class='col-sm-9'>
                                <input type='text' class='form-control' name='productName' autocomplete='off' value="<?php echo $name;?>">
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Category</label>
                            <div class='col-sm-9'>
                                <select name='category' class='form-control' placeholder="<?php echo $category;?>" readonly>
                                    <option><?php echo $category;?></option>
                                    <?php
                                    require_once 'includes/dynamicCategories.inc.php';
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Description</label>
                            <div class='col-sm-9'>
                                <textarea class='form-control' id='textAreaExample' rows='4' name='description' data-mdb-show-counter='true' maxlength='1000'><?php echo $description;?></textarea>
                                <div class='form-helper'></div>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Stock</label>
                            <div class='input-group justify-content-end align-items-center rounded col-sm-9'>
                                <input min='1' max='1000' type='number' step='1' value='<?php echo $stock;?>' name='quantity' class='quantity-field border-0 text-center w-25 rounded'  autocomplete='off'>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Buy Price</label>
                            <div class='col-sm-9 input-group'>
                                <div class='input-group-prepend'>
                                    <span class='input-group-text'>£</span>
                                </div>  
                                <input min='0.00' type='number' class='form-control' name='buyPrice' value='<?php echo $buyPrice;?>' step='.01'  autocomplete='off'>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Sell Price</label>
                            <div class='col-sm-9 input-group'>
                                <div class='input-group-prepend'>
                                    <span class='input-group-text'>£</span>
                                </div>
                                <input min='0.00' type='number' class='form-control' name='sellPrice' value='<?php echo $sellPrice;?>' step='.01'>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Image</label>
                            <div class='col-sm-9'>
                                <input type='file' class='form-control align-content-center' name='image' value='<?php echo $image;?>'>
                            </div>
                        </div>
                        <div class='row mb-3'>
                            <label class='col-sm-3 col-form-label'>Current Image</label>
                            <div class='col-sm-9'>
                                <img src="admin/product_images/<?php echo $image;?>" alt="Current Product Image" class="mt-2" style="width:128px;height:128px;">
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <a type='button' class='btn btn-secondary' href="admin.php" >Close</a>
                            <input type='submit' name='updateProductSubmit' id='updateProductSubmit' class='btn btn-secondary' value='Update'>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Update Product End-->
    </div>
</div>

<?php
include_once 'footer.php';
?>
