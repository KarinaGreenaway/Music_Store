<!-- Button to trigger create product modal -->
<div class="container-fluid pb-3 pt-0 px-0 ">
    <a type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#addProduct">
        Add Product</a>
</div>
<!-- Button to trigger create product modal End -->

<!-- Create product modal -->
<form method="post" action="includes/createProduct.inc.php" id="createProductForm" enctype="multipart/form-data">

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
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="productName" value="" autocomplete="off">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                            <select name="category" class="form-control">
                                <option value="">Select a Category</option>
                                <?php
                                require_once 'includes/dynamicCategories.inc.php';
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="textAreaExample" rows="4" name="description" data-mdb-show-counter="true" maxlength="1000"></textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="createProductSubmit" id="createProductSubmit" class="btn btn-secondary" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Create product modal End-->

