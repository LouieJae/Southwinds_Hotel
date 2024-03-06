<style>
    .modal-header {
        background-color: #7D0A0A;
    }

    .modal-title {
        color: white;
    }

    .bold-label {
        font-weight: bolder;
    }
</style>
<form action="<?php echo site_url('Bookings/edit_product_submit/' . $product->product_id); ?>" method="post">
    <div class="modal fade" id="staticBackdropEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-10 d-inline-block">
                        <label for="product_code" class="bold-label">Product Code</label>
                        <input type="text" id="product_code" name="product_code" value="<?= set_value('product_code', $product->product_code); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group col-10 d-inline-block">
                        <label for="product_code" class="bold-label">Product Name</label>
                        <input type="text" id="product_name" name="product_name" value="<?= set_value('product_name', $product->product_name); ?>" class="form-control" placeholder="Enter Product Name" required>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Product Category</label>
                        <select class="form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select Category" name="product_category" required>

                            <option value="<?= set_value('product_category', $product->product_category); ?>" selected hidden><?= set_value('product_category', $product->product_category); ?></option>
                            <?php foreach ($procat as $pc) { ?>
                                <option value="<?= $pc->product_category ?>"><?= $pc->product_category ?> </option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Product Price</label>
                        <input type="number" id="product_price" name="product_price" value="<?= set_value('product_price', $product->product_price); ?>" class="form-control" placeholder="Enter Product Price" required>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">UoM</label>
                        <select class="form-control " data-live-search="true" data-style="btn-sm btn-outline-secondary" title="Select UoM" name="product_uom" required>

                            <option value="<?= set_value('product_uom', $product->product_uom); ?>" selected hidden><?= set_value('product_uom', $product->product_uom); ?></option>
                            <?php foreach ($uom as $u) { ?>
                                <option value="<?= $u->uom ?>"><?= $u->uom ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Beginning Quantity</label>
                        <input type="number" id="beginning_quantity" name="beginning_quantity" value="<?= set_value('beginning_quantity', $product->beginning_quantity); ?>" class="form-control" placeholder="Enter Beginning Quantity" required>
                    </div>
                    <div class="form-group col-5 d-inline-block">
                        <label for="product_code" class="bold-label">Minimum Quantity</label>
                        <input type="number" id="minimum_quantity" name="minimum_quantity" value="<?= set_value('minimum_quantity', $product->minimum_quantity); ?>" class="form-control" placeholder="Enter Minimum Quantity" required>
                    </div>
                    <?php $product_status = $product->product_status;
                    if ($product_status == '1') { ?>
                        <div class="custom-control custom-checkbox col-5 d-inline-block">
                            <input class="custom-control-input" name="product_status" type="checkbox" id="customCheckbox1" value="1" checked>
                            <label for="customCheckbox1" class="custom-control-label">Saleable Product</label>
                        </div>
                    <?php } else { ?>
                        <div class="custom-control custom-checkbox col-5 d-inline-block">
                            <input class="custom-control-input" name="product_status" type="checkbox" id="customCheckbox1" value="1">
                            <label for="customCheckbox1" class="custom-control-label">Saleable Product</label>
                        </div>
                    <?php } ?>
                </div>
                <input type="hidden" name="product_id" class="form-control form-control text" required>
                <div class="modal-footer">
                    <button type="submit" name="submit" onclick="return confirm('Are you sure you want to update this product?')" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
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
            }
        });
    });
</script>