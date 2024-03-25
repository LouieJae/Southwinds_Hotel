<style>
    .modal-header {
        background-color: #BF3131;
    }

    .modal-title {
        color: white;
    }
</style>




<form action="<?php echo site_url('Bookings/receive_quantity/' . $product->product_id); ?>" method="post">
    <div class="modal fade" id="staticBackdropReceiving" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Product Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-7 d-inline-block">
                        <label for="product_name" class="bold-label">Product Name: <?= $product->product_name ?> </label>
                    </div>
                    <div class="form-group col-7 d-inline-block">
                        <label for="product_quantity" class="bold-label">Current Quantity: <?= $product->product_quantity ?></label>

                    </div>
                    <div class="form-group col-10 d-inline-block">
                        <input type="number" id="product_quantity" name="product_quantity" class="form-control form-control text" placeholder="Enter Quantity" min="1" required>
                    </div>
                    <input type="hidden" name="product_id" class="form-control form-control text" placeholder="Enter Quantity" required>
                    <div class="modal-footer">
                        <button type="submit" onclick="return confirm('Are you sure you want to add quantity to this product?')" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#product_quantity").change(function() {
            var quantity = parseInt($(this).val());
            if (quantity <= 0) {
                toastr.error("Please enter a number more than 0");
                $(this).val('');
            }
        });
    })
</script>