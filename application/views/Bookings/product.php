<h3>Inventory</h3>
<div class="card card-outline card-danger">
    <div class="card-header">
        <button id="addProductModalBtn" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            Add Product
        </button>

        <button id="addProductCategoryModalBtn" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop1">
            Add Product Category
        </button>

        <button id="addUomModalBtn" type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop2">
            Add UoM
        </button>

        <div class="row align-items-center">
            <div class="col-sm-6">

                <?php
                // Retrieve debugging information from session flashdata
                $debug_info = $this->session->flashdata('debug_info');

                if (!empty($debug_info)) {
                    echo '<pre>';
                    echo 'Form Data:';
                    print_r($debug_info['form_data']);
                    echo 'Validation Errors:';
                    echo $debug_info['validation_errors'];
                    echo '</pre>';
                }
                ?>

            </div>

        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">Product Code</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Product Category</th>
                        <th class="text-center">Remaining Quantity</th>
                        <th class="text-center">UoM</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Min Quantity</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($products) && !empty($products)) {
                        foreach ($products as $key => $pro) {
                            $product_id = $pro->product_id;
                            ?>
                            <tr class="text-center">
                                <td class="text-center">
                                    <?php echo $pro->product_code; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $pro->product_name; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $pro->product_category; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $pro->product_quantity; ?>/
                                    <?php echo $pro->beginning_quantity; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $pro->product_uom; ?>
                                </td>
                                <td class="text-center">₱
                                    <?php echo $pro->product_price; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $pro->minimum_quantity; ?>
                                </td>


                                <td class="text-center">
                                    <?php
                                    if ($pro->product_status == 1) {
                                        echo "Saleable";
                                    } else {
                                        echo "Not Saleable";
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="addReceivedQuantitiesBtn"
                                        data-productid="<?php echo $pro->product_id; ?>" style="color:green; padding-left:6px;"
                                        title="Click here to add product quantity" data-bs-toggle="modal"><i
                                            class="fas fa-plus-circle"></i></a>
                                    <a style="color:orange; padding-left:6px;" title="Click here to edit product details"><i
                                            class="fas fa-edit"></i></a>
                                    <a style="color:red; padding-left:6px;" title="Click here to delete product"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalContainer"></div>
    <?php include('add_product.php') ?>
    <?php include('add_product_category.php') ?>
    <?php include('add_uom.php') ?>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        function handleReceiveButtonClick(event) {
            event.preventDefault();
            var productId = this.getAttribute('data-productid');
            console.log("Clicked button product ID:", productId);
            loadModalContent('<?php echo base_url('Bookings/receive_quantity/'); ?>' + productId, productId);
        }
        var receiveButtons = document.querySelectorAll('.addReceivedQuantitiesBtn');
        receiveButtons.forEach(function (button) {
            button.addEventListener('click', handleReceiveButtonClick);
        });
    });

    function loadModalContent(url, productId) {
        console.log("loadModalContent function called with product ID:", productId);
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                document.querySelector('#modalContainer input[name="product_id"]').value = productId;
                $('#staticBackdropReceiving').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>