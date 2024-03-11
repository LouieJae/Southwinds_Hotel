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
<h3>Check Ins</h3>
<div class="card card-outline card-danger">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-stripped table-sm" id="user-datatables">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">Room No</th>
                        <th class="text-center">Room Price</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Check In Time</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (isset($checkin) && !empty($checkin)) {
                        foreach ($checkin as $key => $check) {
                            $check_in_id = $check->check_in_id;
                    ?>
                            <tr class="text-center">
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
                                    <?php echo date('h:i A', strtotime($check->check_in_time)); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo ucfirst($check->status); ?>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-secondary checkinBtn" data-checkinid="<?php echo $check->check_in_id; ?>" title="Click here to add product quantity" data-bs-toggle="modal">Add Ons</a>
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
    // Initialize total amount variable
    let totalAmount = 0;

    // Event delegation for quantity inputs in the cart
    document.addEventListener('input', function(event) {
        if (event.target.matches('.cart-card input[type="number"]')) {
            const cartCard = event.target.closest('.cart-card');
            updateTotalAmount(cartCard);
        }
    });

    // Function to update total amount in the cart
    function updateTotalAmount(cartCard) {
        // Get the room price from the cart card
        const roomPrice = parseFloat(cartCard.querySelector('.price-value').textContent.trim().substring(1));

        // Calculate total price of added products
        let totalPrice = 0;
        const addedProductRows = cartCard.querySelectorAll('.added-products table tbody tr');
        addedProductRows.forEach(row => {
            const priceCell = row.querySelector('td:nth-child(2)');
            const quantityInput = row.querySelector('input[type="number"]');
            const price = parseFloat(priceCell.textContent.trim().substring(1));
            const quantity = parseInt(quantityInput.value);
            totalPrice += price * quantity;
        });

        // Update total amount in the cart
        cartCard.querySelector('.cart-total p').textContent = 'Total: ₱' + (roomPrice + totalPrice).toFixed(2);
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
        productPriceCell.textContent = `₱${productPrice.toFixed(2)}`;

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
        newRow.appendChild(productPriceCell);
        newRow.appendChild(productQuantityCell);
        newRow.appendChild(deleteButtonCell);

        // Append the new row to the table body
        addedProductsTable.appendChild(newRow);

        // Update total amount
        updateTotalAmount(cart);

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
        productQuantityInput.name = 'product_quantities[]';
        productQuantityInput.value = quantityInput.value;
        productQuantitiesInput.parentNode.appendChild(productQuantityInput);

        // Update product quantity when the input changes
        quantityInput.addEventListener('change', function() {
            productQuantityInput.value = quantityInput.value;
            updateTotalAmount(cart); // Update total amount after quantity change
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
</script>
<script>
    // Add event listener to all room cards
    document.querySelectorAll('.card').forEach(item => {
        item.addEventListener('click', event => {
            const roomStatus = event.currentTarget.querySelector('.status').textContent.trim();
            // Check if the room status is not occupied and not in housekeeping
            if (roomStatus !== 'Occupied' && roomStatus !== 'Housekeeping') {
                const roomId = event.currentTarget.id.split('_')[1];
                // Show the modal for the selected room
                $('#roomModal_' + roomId).modal('show'); // Assuming you're using jQuery
            } else if (roomStatus === 'Housekeeping') {
                // Room is in housekeeping, show a toastr notification
                toastr.warning('This room is currently in housekeeping. Please select another room.');
            } else {
                // Room is occupied, show a toastr notification
                toastr.error('This room is currently occupied. Please select another room.');
            }
        });
    });

    // Function to handle click on add-ons button
    function handleAddOnsClick(event) {
        // Prevent the default behavior of the button
        event.preventDefault();
        // Open the add-ons modal
        $('#addOnsModal').modal('show'); // Assuming you're using jQuery
        // Stop event propagation to prevent opening the room modal
        event.stopPropagation();
    }

    // Function to handle click on checkout button
    function handleCheckoutClick(event) {
        // Prevent the default behavior of the button
        event.preventDefault();
        // Open another modal or perform any other action
        console.log("Checkout button clicked");
        // For example, open another modal
        // document.getElementById('otherModal').modal('show');
        // Stop event propagation to prevent opening the room modal
        event.stopPropagation();
    }

    // Add event listeners to the buttons
    document.querySelectorAll('.add-ons-button').forEach(item => {
        item.addEventListener('click', handleAddOnsClick);
    });

    document.querySelectorAll('.checkout-button').forEach(item => {
        item.addEventListener('click', handleCheckoutClick);
    });
    // Function to handle add-ons button click
    function handleAddOnsClick(event) {
        // Prevent the default behavior of the button
        event.preventDefault();
        // Get the room ID from the clicked add-ons button
        const roomId = event.currentTarget.closest('.card').id.split('_')[1];
        // Open the corresponding add-ons modal with the room number
        $('#addOnsModal_' + roomId).modal('show'); // Assuming you're using jQuery
        // Stop event propagation to prevent opening the room modal
        event.stopPropagation();
    }

    // Add event listeners to the add-ons buttons
    document.querySelectorAll('.add-ons-button').forEach(item => {
        item.addEventListener('click', handleAddOnsClick);
    });

    // Remove data-toggle attribute from cards with occupied rooms
    document.querySelectorAll('.card').forEach(item => {
        const roomStatus = item.querySelector('.status').textContent.trim();
        if (roomStatus === 'Occupied') {
            item.removeAttribute('data-toggle');
        }
    });

    // Remove data-toggle attribute from cards with occupied rooms
    document.querySelectorAll('.card').forEach(item => {
        const roomStatus = item.querySelector('.status').textContent.trim();
        if (roomStatus === 'Housekeeping') {
            item.removeAttribute('data-toggle');
        }
    });
    // Function to handle click on checkout button
    function handleCheckoutClick(event) {
        // Prevent the default behavior of the button
        event.preventDefault();
        // Get the room ID from the clicked checkout button
        const roomId = event.currentTarget.closest('.card').id.split('_')[1];
        // Open the corresponding checkout modal
        $('#checkoutModal_' + roomId).modal('show'); // Assuming you're using jQuery
        // Stop event propagation to prevent opening the room modal
        event.stopPropagation();
    }

    // Add event listeners to the checkout buttons
    document.querySelectorAll('.checkout-button').forEach(item => {
        item.addEventListener('click', handleCheckoutClick);
    });

    // Add event listener to the confirm checkout buttons in the checkout modals
    <?php foreach ($get_all_room as $room) : ?>
        document.getElementById('confirmCheckoutBtn_<?php echo $room->room_id; ?>').addEventListener('click', function() {
            // Perform checkout operation for room <?php echo $room->room_id; ?> here
            console.log('Checkout confirmed for room <?php echo $room->room_id; ?>'); // For demonstration purposes
            // Close the corresponding checkout modal
            $('#checkoutModal_<?php echo $room->room_id; ?>').modal('hide'); // Assuming you're using jQuery
        });
    <?php endforeach; ?>
</script>
<script>
    // Add event listener to remove modal backdrop after modal is hidden
    $('.modal').on('hidden.bs.modal', function(e) {
        $(this).data('bs.modal', null); // Reset modal data to prevent caching
        $('.modal-backdrop').remove(); // Remove modal backdrop
    });

    $(document).ready(function() {
        $('.search-input').keyup(function() {
            var searchText = $(this).val().toLowerCase();
            $('.product-button').each(function() {
                var productName = $(this).find('.product-name').text().toLowerCase();
                if (productName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>