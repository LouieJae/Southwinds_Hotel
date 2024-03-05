<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Product Category</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Inventory</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="col-sm-6">
        <div class="row mb-2">
            <h1 class="m-0 text-dark">
                <a href="<?php echo site_url('Bookings/product'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-boxes"></i> Products</a>
                <a href="<?php echo site_url('Bookings/product_category'); ?>" class="btn btn-primary btn-sm btn-dark"><i class="fas fa-boxes"></i> Product Category</a>
            </h1>
        </div>
    </div>
</div>
<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Add Product Category
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Product Category Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-10 d-inline-block">
                        <input type="text" name="product_code" class="form-control form-control text" placeholder="Enter Product Category" value="<?php echo set_value('product_category'); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-danger"><i class="fas fa-trash"></i> Clear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>