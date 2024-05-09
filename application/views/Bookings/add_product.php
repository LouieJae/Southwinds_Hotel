<style>
    .modal-header {
        background-color: #89CBEE;
    }

    .modal-title {
        color: black;
        font-weight: bold;
    }

    .bold-label {
        font-weight: bolder;
    }
</style>
<form action="<?php echo site_url('Bookings/add_product_submit'); ?>" method="post">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Product Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-10 d-inline-block">
                        <label for="product_code" class="bold-label">Product Code</label>
                        <input type="text" id="product_code" name="product_code" value="<?= $product_code ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group col-10 d-inline-block">
                        <label for="product_code" class="bold-label">Product Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Product Category</label>
                        <select class="form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Category" name="product_category" required>

                            <option value="" selected hidden>Select Product Category</option>
                            <?php foreach ($procat as $pc) { ?>
                                <option value="<?= $pc->product_category ?>"><?= $pc->product_category ?> </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Product Price</label>
                        <input type="number" id="product_price" name="product_price" class="form-control" placeholder="Enter Product Price" min="0" required>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">UoM</label>
                        <select class="form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select UoM" name="product_uom" required>

                            <option value="" selected hidden>Select UoM</option>
                            <?php foreach ($uom as $u) { ?>
                                <option value="<?= $u->uom ?>"><?= $u->uom ?> </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Beginning Quantity</label>
                        <input type="number" id="beginning_quantity" name="beginning_quantity" class="form-control" placeholder="Enter Beginning Quantity" min="0" required>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Minimum Quantity</label>
                        <input type="number" id="minimum_quantity" name="minimum_quantity" class="form-control" placeholder="Enter Minimum Quantity" min="0" required>
                    </div>
                    <div class="custom-control custom-checkbox col-5 d-inline-block">
                        <input class="custom-control-input" name="product_status" type="checkbox" id="customCheckbox1" value="1">
                        <label for="customCheckbox1" class="custom-control-label">Saleable Product</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="return confirm('Are you sure you want to add this product?')" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>

                </div>

            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#beginning_quantity").change(function() {
            var beginningQuantity = parseInt($(this).val());
            var minQuantity = parseInt($("#minimum_quantity").val());
            if (minQuantity >= beginningQuantity) {
                toastr.error("Minimum Quantity must be less than Beginning Quantity");
                $(this).val('');
            } else if (beginningQuantity <= 0) {
                toastr.error("Please enter a number more than 0");
                $(this).val('');
            }
        });
    })

    $(document).ready(function() {
        $("#minimum_quantity").change(function() {
            var minQuantity = parseInt($(this).val());
            var beginningQuantity = parseInt($("#beginning_quantity").val());
            if (minQuantity >= beginningQuantity) {
                toastr.error("Minimum Quantity must be less than Beginning Quantity");
                $(this).val('');
            } else if (minQuantity <= 0) {
                toastr.error("Please enter a number more than 0");
                $(this).val('');
            }
        });
    });

    $(document).ready(function() {
        $("#product_price").change(function() {
            var productPrice = parseInt($(this).val());
            if (productPrice <= 0) {
                toastr.error("Please enter a number more than 0");
                $(this).val('');
            }
        });
    })
</script>