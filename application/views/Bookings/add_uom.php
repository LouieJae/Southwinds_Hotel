<style>
    .modal-header {
        background-color: #BF3131;
    }

    .modal-title {
        color: white;
    }
</style>

<form action="<?php echo site_url('Bookings/add_uom_submit'); ?>" method="post">
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Unit of Measure Registration </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-10 d-inline-block">
                        <input type="text" name="uom" class="form-control form-control text" placeholder="Enter UoM" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>

                </div>
            </div>
        </div>
    </div>
</form>

<script>

</script>