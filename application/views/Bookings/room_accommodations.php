<style>
    /* Style for the card container */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        /* Distribute space between cards */
        align-items: flex-start;
        /* Align items to the top */
        /* spacing between cards */
        max-width: 100%;
        /* Ensure it doesn't overflow */
        overflow: auto;
        /* Add scrollbar if needed */
        padding: 14px;
        /* Add some padding */
    }

    /* Style for each card */
    .card {
        width: 200px;
        /* Set width to 200px */
        height: 178px;
        /* Set height to 240px */
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
        box-sizing: border-box;
        background-color: #f9f9f9;
        /* Center text */
        text-align: center;
        /* Add some margin */
        margin-bottom: 19px;
        position: relative;
        font-size: x-large;
        font-weight: bolder;
        color: #BF3131;
        cursor: pointer;
    }

    /* Style for the available sign */
    .status {
        /* Position the "Available" text absolutely */
        position: absolute;
        /* Position under the room number text */
        bottom: 0;
        /* Position at the bottom */
        left: 0;
        /* Align to the left */
        width: 100%;
        height: 12%;
        /* Make it span the whole width */
        font-size: 14px;
        color: white;
        background-color: green;
        /* Background color for "Available" */
        padding: 1px;
        /* Add padding */
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    /* Adjust image size */
    .card img {
        max-width: 100%;
        max-height: 45%;
        /* Ensure the image doesn't overflow */
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    /* Style for the card footer */
    .card-footer {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        text-align: center;
    }

    .card-footer button {
        margin: 0 5px;
        margin-bottom: 4px;
        /* Adjust spacing between buttons */
        padding: 2px 2px;
        font-size: 13px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-block;
        /* Display buttons inline */
    }

    /* Style for the add-ons button */
    .add-ons-button {
        background-color: blue;
    }

    .add-ons-button:hover {
        background-color: darkblue;
    }

    /* Style for the checkout button */
    .checkout-button {
        background-color: darkgray;
    }

    .checkout-button:hover {
        background-color: gray;
    }

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
<div class="card-container">
    <?php foreach ($get_all_room as $room) : ?>
        <div class="card" id="roomCard_<?php echo $room->room_id; ?>" data-toggle="modal" data-target="#roomModal_<?php echo $room->room_id; ?>" onclick="selectRoom(this.id)">
            Room
            <?php echo $room->room_no; ?>
            <img src="<?php echo base_url('assets/images/hotel_beach.jpg'); ?>" alt="">
            <div class="card-footer">
                <?php if ($room->status === 'occupied') : ?>
                    <button class="checkout-button">Checkout</button>
                <?php endif; ?>
            </div>
            <div class="status" style="background-color: <?php echo ($room->status == 'occupied') ? 'blue' : (($room->status == 'housekeeping') ? 'orange' : 'green'); ?>">
                <?php echo ucfirst($room->status); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include('roomModals.php') ?>
<?php include('checkoutModal.php') ?>

<script>
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

        // Find the closest cart for the clicked product
        const cart = event.currentTarget.closest('.product-cart-container').querySelector('.cart-card');
        const addedProductsTable = cart.querySelector('.added-products table tbody');

        // Check if the product is already in the cart
        const existingProductRow = addedProductsTable.querySelector(`tr[data-product-name="${productName}"]`);
        if (existingProductRow) {
            // Product already exists in the cart, show error message or handle it as required
            toastr.warning('This product is already on the cart.');
            return; // Stop execution
        }

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
    // Define an object to store added hours for each room
    const addedHours = {};

    // Function to update time every second
    function updateTime() {
        // Get the current time in Philippine time
        const currentTime = new Date(new Date().toLocaleString("en-US", {
            timeZone: "Asia/Manila"
        }));

        // Set the check-in time to the current time
        const checkInTime = new Date(currentTime);

        // Specify the checkout time (e.g., 5:00 PM)
        const checkoutTime = new Date(currentTime);
        checkoutTime.setHours(17, 0, 0); // Set checkout time to 5:00 PM

        // Calculate the difference between checkout time and current time
        let remainingTime = checkoutTime - currentTime;

        // Add previously added hours for each room
        for (const roomId in addedHours) {
            if (addedHours.hasOwnProperty(roomId)) {
                // Add hours to remaining time
                remainingTime += addedHours[roomId] * 60 * 60 * 1000; // Convert hours to milliseconds
            }
        }

        // Format remaining time
        const remainingHours = Math.floor(remainingTime / (1000 * 60 * 60));
        const remainingMinutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        const remainingSeconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
        const formattedRemainingTime = remainingHours + 'hrs ' + remainingMinutes + 'mins ' + remainingSeconds + 'secs';

        // Update the time for each room
        <?php foreach ($get_all_room as $room) : ?>
            document.getElementById('checkInTime_<?php echo $room->room_id; ?>').textContent = formatDate(checkInTime);
            document.getElementById('checkOutTime_<?php echo $room->room_id; ?>').textContent = formatDate(checkoutTime);
            document.getElementById('remainingTime_<?php echo $room->room_id; ?>').textContent = formattedRemainingTime;
        <?php endforeach; ?>
    }

    // Call updateTime function every second
    setInterval(updateTime, 1000);

    // Function to format date to 'HH:MM:SS AM/PM' format
    function formatDate(date) {
        const hours = date.getHours() % 12 || 12;
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const ampm = date.getHours() >= 12 ? 'PM' : 'AM';
        return hours + ':' + minutes + ' ' + ampm;
    }

    // Function to add hours to remaining time
    function addHours(roomId) {
        // Get the number of hours to add from the input field
        const hoursToAdd = parseInt(document.getElementById('addHours_' + roomId).value);

        // Update the added hours for the room
        if (addedHours.hasOwnProperty(roomId)) {
            addedHours[roomId] += hoursToAdd;
        } else {
            addedHours[roomId] = hoursToAdd;
        }

        // Update the displayed remaining time
        updateTime();
    }

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