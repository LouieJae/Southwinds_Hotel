<style>
    /* Custom CSS for smaller buttons */
    .modal-content .btn-price {
        padding: 2px 5px;
        font-size: 15px;
        width: 130px;
        margin-right: 2px;
        /* Adjust the margin between buttons */
        display: inline-block;
        margin: 0;
        background-color: #EAD196;
        color: black;
        font-weight: bolder;
    }

    .room-number {
        font-weight: bolder;
        font-size: 25px;
    }

    .room-info {
        font-size: 18px;
    }

    .product-cart-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .product-card {
        flex: 0 0 calc(50% - 10px);
        /* Adjust width as needed */
        background-color: #f9f9f9;
        padding: 10px;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .cart-card {
        flex: 0 0 calc(50% - 10px);
        /* Adjust width as needed */
        background-color: #f9f9f9;
        padding: 10px;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .cart-carding {
        flex: 0 0 calc(100% - 10px);
        /* Adjust width as needed */
        background-color: #F3EDC8;
        padding: 10px;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .product-card input[type="text"] {
        margin-bottom: 10px;
    }

    .search-results {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        max-height: 200px;
        /* Adjust as needed */
        overflow-y: auto;
    }

    .cart-room-number {
        font-size: 12px;
        font-weight: bold;
    }

    .cart-selected-price {
        font-size: 12px;
        font-weight: bold;
        margin-left: 20px;
    }

    .cart-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: #F3EDC8;
    }

    .cart-content {
        display: flex;
        align-items: baseline;
        /* Align items on the baseline */
        margin-bottom: 10px;
    }

    .cart-room-info {
        flex: 1;
    }

    .cart-total {
        text-align: right;
        font-weight: bold;
    }

    .modal-title {
        font-size: 30px;
    }

    .product-button {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 5px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        text-align: left;
        position: relative;
    }

    .product-button span {
        pointer-events: none;
        /* Allow clicks to pass through the span */
    }

    .product-button:hover {
        background-color: #e0e0e0;
    }

    .product-name {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .product-price {
        color: #888;
        font-size: 12px;
        /* Adjust font size if needed */
        position: absolute;
        top: 5px;
        right: 10px;
    }


    .added-products {
        display: flex;
        flex-direction: column;
    }

    .added-products p {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        font-weight: bolder;
    }

    hr {
        margin-top: 1px;
    }

    /* CSS to style the room number and price container */
    .room-price-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cart-room-number {
        margin: 0;
    }

    .cart-selected-price {
        margin: 0;
    }

    /* CSS to control overflow and show/hide scroll button */
    .products-container {
        max-height: 200px;
        /* Adjust the height as needed */
        overflow-y: auto;
    }

    .scroll-button {
        display: none;
    }

    .products-container.overflow .scroll-button {
        display: block;
    }
</style>
<h3 class="mt-2">Check Ins</h3>
<div class="card card-outline card-danger">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="add_ons-datatables">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">Check In Time</th>
                        <th class="text-center">Room No</th>
                        <th class="text-center">Room Price</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Checkout Time</th>
                        <th class="text-center">Remaining Time</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Get the current time
                    $current_time = time();

                    if (isset($checkins) && !empty($checkins)) {
                        foreach ($checkins as $key => $check) {
                            $check_in_id = $check->check_in_id;
                            $status = ucfirst($check->status);

                            // Calculate remaining time
                            $check_in_time = strtotime($check->check_in_time);
                            $check_out_time = strtotime($check->check_out_time);
                            $remaining_time = $check_out_time - $current_time;

                            // Check if checkout time has passed
                            if ($current_time > $check_out_time) {
                                // Display "Room Time Passed" with badge
                                $remaining_time_html = '<span class="badge bg-danger">Room Time Passed</span>';
                            } else {
                                // Calculate remaining hours and minutes
                                $remaining_hours = floor($remaining_time / 3600);
                                $remaining_minutes = floor(($remaining_time % 3600) / 60);

                                // Display remaining time
                                $remaining_time_html = "$remaining_hours hours $remaining_minutes minutes";
                            }
                    ?>
                            <tr class="text-center">
                                <td class="text-center">
                                    <?php echo date('h:i A', $check_in_time); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $check->room_no; ?>
                                </td>
                                <td class="text-center">
                                    ₱<?php echo $check->room_price; ?>
                                </td>
                                <td class="text-center">
                                    ₱<?php echo $check->total_amount; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $status; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $check->check_out_time; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $remaining_time_html; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($status === 'Occupied') { ?>
                                        <a href="#" class="btn btn-secondary checkinBtn" data-checkinid="<?php echo $check->check_in_id; ?>" title="Click here to add product quantity" data-bs-toggle="modal">Add Ons</a>
                                        <a href="#" class="btn btn-danger checkoutBtn" data-checkoutid="<?php echo $check->check_in_id; ?>" title="Click here to proceed to checkout" data-bs-toggle="modal">Checkout</a>
                                    <?php } elseif ($status === 'Housekeeping') { ?>
                                        <a href="<?php echo site_url('Bookings/update_available/' . $check->check_in_id); ?>" class="btn btn-warning housekeepingBtn fw-bolder" onclick="return confirm('Are you sure this room done housekeeping?')" title="Click here to mark this room as available"></i> Done Housekeeping</a>
                                    <?php } ?>
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

    <?php include('addOnsModals.php') ?>
</div>
<script>
    $(document).ready(function() {
        $("#add_ons-datatables").DataTable({
            "order": [
                [0, "desc"]
            ],
            "lengthMenu": [10, 25, 50, 100]
        });
    });
</script>
<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success('<?php echo $this->session->flashdata('success'); ?>');
        <?php } elseif ($this->session->flashdata('error')) { ?>
            toastr.error('<?php echo $this->session->flashdata('error'); ?>');
        <?php } ?>
    });
    // Function to handle "Add Ons" button click
    function handleAddOnsButtonClick(event) {
        event.preventDefault();
        var checkinId = this.getAttribute('data-checkinid');
        console.log("Clicked button check in ID:", checkinId);
        loadModalContent('<?php echo base_url('Bookings/add_ons/'); ?>' + checkinId, checkinId);
    }

    // Function to load modal content
    function loadModalContent(url, checkinId) {
        console.log("loadModalContent function called with check In ID:", checkinId);
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                $('#addOnsModal').modal('show');
                // Add event listeners for product buttons after modal content is loaded
                addProductButtonListeners();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Function to add event listeners for product buttons
    function addProductButtonListeners() {
        document.querySelectorAll('.product-button').forEach(item => {
            item.addEventListener('click', handleProductButtonClick);
        });
    }

    // Function to handle "Checkout" button click
    function handleCheckoutButtonClick(event) {
        event.preventDefault();
        var checkoutId = this.getAttribute('data-checkoutid');
        console.log("Clicked button check in ID:", checkoutId);
        loadCheckoutModal('<?php echo base_url('Bookings/check_out/'); ?>' + checkoutId);
    }

    // Function to load checkout modal content
    function loadCheckoutModal(url) {
        console.log("loadCheckoutModal function called");
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                $('#checkoutModal').modal('show');
                // Add event listeners for adding hours and product buttons after modal content is loaded
                addCheckoutButtonListener();
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Add event listener for "Checkout" buttons
    document.querySelectorAll('.checkoutBtn').forEach(function(button) {
        button.addEventListener('click', handleCheckoutButtonClick);
    });

    // Initialize total amount variable
    let totalAmount = 0;

    // Event listener for input changes within the cart
    document.addEventListener('input', function(event) {
        const target = event.target;
        // Check if the changed input is a quantity input
        if (target.matches('.added-products input[type="number"]')) {
            const cartCard = target.closest('.cart-card');
            updateTotalAmount(cartCard);
        }
    });

    // Function to update the total amount and its corresponding input field
    function updateTotalAmount(cart) {
        const roomPrice = parseFloat(cart.querySelector('.cart-selected-price .price-value').textContent.replace('₱', ''));

        // Get all product rows in the cart
        const productRows = cart.querySelectorAll('.added-products table tbody tr');

        // Initialize total amount
        let totalAmount = roomPrice;

        // Iterate over each product row
        productRows.forEach(row => {
            // Get the price and quantity for each product
            const priceText = row.querySelector('td:nth-child(2)').textContent;
            const productPrice = parseFloat(priceText.replace('₱', ''));

            let productQuantity = 0;
            const quantityInput = row.querySelector('input[type="number"]');
            if (quantityInput) {
                productQuantity = parseInt(quantityInput.value);
            } else {
                const quantityCell = row.querySelector('td:nth-child(3)');
                productQuantity = parseInt(quantityCell.textContent.trim());
            }

            // Add the product price multiplied by its quantity to the total amount
            totalAmount += productPrice * productQuantity;
        });

        // Display the updated total amount
        const totalAmountElement = cart.querySelector('.cart-total .total-amount');
        totalAmountElement.textContent = `₱${totalAmount.toFixed(2)}`;

        // Update the value of the total amount input field
        const totalAmountInput = document.querySelector('input[name="total_amount"]');
        totalAmountInput.value = totalAmount.toFixed(2);
    }



    // Add event listener to all pricing buttons
    document.querySelectorAll('.price-button').forEach(item => {
        item.addEventListener('click', event => {
            const price = parseFloat(event.currentTarget.dataset.price); // Parse price to float
            const cartContent = event.currentTarget.closest('.modal-content');
            const cartPriceInput = cartContent.querySelector('input[name="room_price"]');
            cartPriceInput.value = price; // Update input value with the clicked price
            const cartPriceElement = cartContent.querySelector('.cart-selected-price');
            cartPriceElement.querySelector('.price-value').textContent = '₱' + price.toFixed(2); // Set price with 2 decimal places
            updateTotalAmount(cartContent); // Update displayed total amount
        });
    });

    // Function to handle click on product button
    function handleProductButtonClick(event) {
        // Prevent the default behavior of the button
        event.preventDefault();

        // Get the clicked product details
        const productName = event.currentTarget.dataset.name;
        const productPrice = parseFloat(event.currentTarget.dataset.price);

        // Log the product details to ensure they are retrieved correctly
        console.log("Product Name:", productName);
        console.log("Product Price:", productPrice);

        // Find the closest cart for the clicked product
        const cart = event.currentTarget.closest('.product-cart-container').querySelector('.cart-card');
        console.log("Cart:", cart);

        const addedProductsTable = cart.querySelector('.added-products table tbody');

        // Log the addedProductsTable to ensure it's retrieved correctly
        console.log("Added Products Table:", addedProductsTable);

        // Check if the product is already in the cart
        const existingProductRow = addedProductsTable.querySelector(`tr[data-product-name="${productName}"]`);
        if (existingProductRow) {
            // Product already exists in the cart, show error message or handle it as required
            toastr.warning('This product is already on the cart.');
            return; // Stop execution
        }

        // Log that a new row will be created
        console.log("Creating a new row for the product...");

        // Create a new row for the product
        const newRow = document.createElement('tr');
        newRow.dataset.productName = productName; // Set data attribute to track the product name

        // Create cells for product name, price, quantity, and delete button
        const productNameCell = document.createElement('td');
        productNameCell.textContent = productName;

        const productPriceCell = document.createElement('td');
        productPriceCell.textContent = `₱${productPrice.toFixed(2)}`; // Set the price text

        const productQuantityCell = document.createElement('td');
        const quantityInput = document.createElement('input');
        quantityInput.type = 'number';
        quantityInput.value = 1; // Default quantity is 1
        quantityInput.style.width = '80px'; // Set width of quantity input
        productQuantityCell.appendChild(quantityInput);

        const deleteButtonCell = document.createElement('td');
        const deleteButton = document.createElement('button');
        deleteButton.classList.add('delete-button'); // Add a class for styling
        deleteButton.innerHTML = '<i class="fas fa-trash"></i>'; // Set delete icon
        deleteButton.addEventListener('click', function() {
            newRow.remove(); // Remove the row when delete button is clicked
            updateTotalAmount(cart); // Update total amount after deletion
        });
        deleteButtonCell.appendChild(deleteButton);

        // Append cells to the row
        newRow.appendChild(productNameCell);
        newRow.appendChild(productPriceCell); // Append the price cell
        newRow.appendChild(productQuantityCell);
        newRow.appendChild(deleteButtonCell);

        // Append the new row to the table body
        addedProductsTable.appendChild(newRow);

        // Update total amount
        updateTotalAmount(cart, productPrice); // Pass the product price to updateTotalAmount function

        // Add product name, price, and quantity to hidden inputs for form submission
        const productNamesInput = cart.querySelector('input[name="product_names[]"]');
        const productPricesInput = cart.querySelector('input[name="product_prices[]"]');
        const productQuantitiesInput = cart.querySelector('input[name="product_quantities[]"]');

        // Append each product name, price, and quantity as separate values
        const productNameInput = document.createElement('input');
        productNameInput.type = 'hidden';
        productNameInput.name = 'product_names[]';
        productNameInput.value = productName;
        productNamesInput.parentNode.appendChild(productNameInput);

        const productPriceInput = document.createElement('input');
        productPriceInput.type = 'hidden';
        productPriceInput.name = 'product_prices[]';
        productPriceInput.value = productPrice.toFixed(2);
        productPricesInput.parentNode.appendChild(productPriceInput);

        const productQuantityInput = document.createElement('input');
        productQuantityInput.type = 'hidden';
        productQuantityInput.min = 0;
        productQuantityInput.name = 'product_quantities[]';
        productQuantityInput.value = quantityInput.value;
        productQuantitiesInput.parentNode.appendChild(productQuantityInput);

        // Update product quantity when the input changes
        quantityInput.addEventListener('change', function() {
            if (quantityInput.value < 0) {
                toastr.error('Quantity cannot be negative.');
                quantityInput.value = 1; // Reset quantity to 1
            } else {
                productQuantityInput.value = quantityInput.value;
                updateTotalAmount(cart, productPrice); // Update total amount after quantity change
            }
        });

        // Add event listener to quantity input to restrict certain characters
        quantityInput.addEventListener('input', function(event) {
            // Get the value entered by the user
            const inputValue = event.target.value;

            // Check if the entered value contains any restricted characters
            if (/[=_\-*]/.test(inputValue)) {
                // If restricted characters are found, show a toastr alert
                toastr.error('Quantity cannot contain special characters.');

                // Reset the quantity to 1
                event.target.value = 1;
            }
        });

        deleteButton.addEventListener('click', function() {
            newRow.remove(); // Remove the row when delete button is clicked
            // Remove corresponding hidden input fields
            productNameInput.remove();
            productPriceInput.remove();
            productQuantityInput.remove();
            updateTotalAmount(cart); // Update total amount after deletion
        });
    }


    // Add event listeners to the product buttons
    document.querySelectorAll('.product-button').forEach(item => {
        item.addEventListener('click', handleProductButtonClick);
    });

    // Add event listeners for "Add Ons" buttons
    document.querySelectorAll('.checkinBtn').forEach(function(button) {
        button.addEventListener('click', handleAddOnsButtonClick);
    });

    // Add event listener for radio buttons
    document.querySelectorAll('input[name="inlineRadioOptions"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const cartContent = document.querySelector('.modal-content');
            const priceSpan = cartContent.querySelector('.cart-selected-price .price-value');

            if (this.value === 'option1') { // VIP option selected
                const originalPrice = parseFloat(cartContent.querySelector('input[name="room_price"]').value);
                const discountedPrice = originalPrice - (originalPrice * 0.05); // Apply 5% discount
                priceSpan.textContent = '₱' + discountedPrice.toFixed(2); // Update displayed price

                // Update total amount
                updateTotalAmount(cartContent);
            } else if (this.value === 'option2') { // None option selected
                const originalPrice = parseFloat(cartContent.querySelector('input[name="room_price"]').value);
                priceSpan.textContent = '₱' + originalPrice.toFixed(2); // Reset displayed price

                // Update total amount
                updateTotalAmount(cartContent);
            }
        });
    });
</script>