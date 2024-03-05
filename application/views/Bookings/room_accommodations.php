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
        font-size: 10px;
        width: 100px;
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
        flex: 0 0 calc(60% - 10px);
        /* Adjust width as needed */
        background-color: #f9f9f9;
        padding: 10px;
        margin-top: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .cart-card {
        flex: 0 0 calc(40% - 10px);
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

    .cart-selected-price {
        width: 100px;
        /* Fix the width of the price container */
        text-align: right;
    }

    .cart-selected-price p {
        margin: 0;
        /* Remove default margin */
    }

    .cart-total {
        text-align: right;
        font-weight: bold;
    }

    .modal-title {
        font-size: 30px;
    }
</style>

<div class="card-container">
    <?php foreach ($get_all_room as $room): ?>
        <div class="card" id="roomCard_<?php echo $room->room_id; ?>" data-toggle="modal"
            data-target="#roomModal_<?php echo $room->room_id; ?>" onclick="selectRoom(this.id)">
            Room
            <?php echo $room->room_no; ?>
            <img src="<?php echo base_url('assets/images/hotel_beach.jpg'); ?>" alt="">
            <div class="card-footer">
                <?php if ($room->status === 'occupied'): ?>
                    <button class="add-ons-button">Add-ons</button>
                    <button class="checkout-button">Checkout</button>
                <?php endif; ?>
            </div>
            <div class="status"
                style="background-color: <?php echo ($room->status == 'occupied') ? 'blue' : (($room->status == 'housekeeping') ? 'orange' : 'green'); ?>">
                <?php echo ucfirst($room->status); ?>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div id="roomModals">
    <?php foreach ($get_all_room as $room): ?>
        <!-- Modal for Room <?php echo $room->room_no; ?> -->
        <div class="modal fade" id="roomModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog"
            aria-labelledby="roomModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roomModalLabel_<?php echo $room->room_id; ?>">Check-In:</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Room Number -->
                        <p class="room-number">
                            Room Number:
                            <?php echo $room->room_no; ?>
                            <br>
                            <span class="room-info">Status:
                                <?php echo ucfirst($room->status); ?>
                            </span>
                        </p>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button"
                            data-price="<?php echo $room->{"2hr_price"}; ?>">2 Hours: $
                            <?php echo $room->{"2hr_price"}; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button"
                            data-price="<?php echo $room->{"3hr_price"}; ?>">3 Hours: $
                            <?php echo $room->{"3hr_price"}; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button"
                            data-price="<?php echo $room->{"6hr_price"}; ?>">6 Hours: $
                            <?php echo $room->{"6hr_price"}; ?>
                        </button>


                        <button class="btn btn-sm btn-price btn-block p-1 price-button"
                            data-price="<?php echo $room->{"12hr_price"}; ?>">12 Hours:
                            $
                            <?php echo $room->{"12hr_price"}; ?>
                        </button>


                        <button class="btn btn-sm btn-price btn-block p-1 price-button"
                            data-price="<?php echo $room->{"24hr_price"}; ?>">24 Hours:
                            $
                            <?php echo $room->{"24hr_price"}; ?>
                        </button>

                        <!-- Add other pricing buttons similarly -->


                        <!-- Container for product selection and cart -->
                        <div class="product-cart-container">
                            <!-- Cart and total transaction card -->

                            <div class="product-card">
                                <h5>Add Ons</h5>
                                <!-- Search bar -->
                                <input type="text" class="form-control" placeholder="Search Product">
                                <!-- Empty content for search results -->
                                <div class="search-results">
                                    <!-- Content will be populated dynamically -->
                                </div>
                            </div>

                            <div class="cart-card">
                                <!-- Room Number and Selected Price -->
                                <div class="cart-content">
                                    <!-- Room Number -->
                                    <div class="cart-room-info">
                                        <p class="cart-room-number">Room Number:
                                            <?php echo $room->room_no; ?>
                                        </p>
                                    </div>
                                    <!-- Selected Price -->
                                    <div class="cart-selected-price">
                                        <p>Price:<span class="price-value">
                                                ₱
                                                <?php echo $room->{"2hr_price"}; ?>
                                            </span></p>
                                        <!-- Add your cart items list and total transaction calculation here -->
                                    </div>
                                </div>
                                <!-- Total Amount -->
                                <div class="cart-total">
                                    <p>Total: <!-- Calculate and display total amount here --></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Check-In</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div id="addOnsModals">
    <?php foreach ($get_all_room as $room): ?>
        <div class="modal fade" id="addOnsModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog"
            aria-labelledby="addOnsModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOnsModalLabel_<?php echo $room->room_id; ?>">Add-Ons
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Room Number and ID -->
                        <p class="room-number">
                            Room Number:
                            <?php echo $room->room_no; ?>
                            <br>
                            Status:
                            <?php echo ucfirst($room->status); ?>
                        </p>
                        <!-- Check-in, Check-out, and Remaining Time -->
                        <div class="time-info">
                            <p>Check-In Time: <span id="checkInTime_<?php echo $room->room_id; ?>">00:00:00</span></p>
                            <p>Check-Out Time: <span id="checkOutTime_<?php echo $room->room_id; ?>">00:00:00</span></p>
                            <p>Remaining Time: <span id="remainingTime_<?php echo $room->room_id; ?>">00:00:00</span></p>
                            <!-- Input field to add hours -->
                            <input type="number" class="form-control col-md-3 d-inline-block"
                                id="addHours_<?php echo $room->room_id; ?>" min="1" step="1" placeholder="Add hours">
                            <!-- Button to add hours -->
                            <button class="btn btn-primary" onclick="addHours(<?php echo $room->room_id; ?>)">Add
                                Hours</button>
                        </div>

                        <!-- Container for product selection and cart -->
                        <div class="product-cart-container">
                            <!-- Cart and total transaction card -->

                            <div class="product-card">
                                <h5>Add Ons</h5>
                                <!-- Search bar -->
                                <input type="text" class="form-control" placeholder="Search Product">
                                <!-- Empty content for search results -->
                                <div class="search-results">
                                    <!-- Content will be populated dynamically -->
                                </div>
                            </div>

                            <div class="cart-card">
                                <!-- Room Number and Selected Price -->
                                <div class="cart-content">
                                    <!-- Room Number -->
                                    <div class="cart-room-info">
                                        <p class="cart-room-number">Room Number:
                                            <?php echo $room->room_no; ?>
                                        </p>
                                    </div>
                                    <!-- Selected Price -->
                                    <div class="cart-selected-price">
                                        <p>Price:<span class="price-value">
                                                ₱

                                            </span></p>
                                        <!-- Add your cart items list and total transaction calculation here -->
                                    </div>
                                </div>
                                <!-- Total Amount -->
                                <div class="cart-total">
                                    <p>Total: <!-- Calculate and display total amount here --></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div id="checkoutModal">
    <?php foreach ($get_all_room as $room): ?>
        <div class="modal fade" id="checkoutModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog"
            aria-labelledby="checkoutModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel_<?php echo $room->room_id; ?>">Checkout
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Room Number and ID -->
                        <p class="room-number">
                            Room Number:
                            <?php echo $room->room_no; ?>
                            <br>
                            Status:
                            <?php echo ucfirst($room->status); ?>
                        </p>
                        <!-- Check-in, Check-out, and Remaining Time -->
                        <div class="time-info">
                            <p>Check-In Time: <span id="checkInTime_<?php echo $room->room_id; ?>">00:00:00</span></p>
                            <p>Check-Out Time: <span id="checkOutTime_<?php echo $room->room_id; ?>">00:00:00</span></p>
                            <p>Remaining Time: <span id="remainingTime_<?php echo $room->room_id; ?>">00:00:00</span></p>
                            <p>Extend: <span id="remainingTime_<?php echo $room->room_id; ?>">2hr</span></p>
                        </div>

                        <!-- Container for product selection and cart -->
                        <div class="product-cart-container">
                            <!-- Cart and total transaction card -->

                            <div class="product-card">
                                <h5>Add Ons</h5>
                            </div>

                            <div class="cart-card">
                                <!-- Room Number and Selected Price -->
                                <div class="cart-content">
                                    <!-- Room Number -->
                                    <div class="cart-room-info">
                                        <p class="cart-room-number">Room Number:
                                            <?php echo $room->room_no; ?>
                                        </p>
                                    </div>
                                    <!-- Selected Price -->
                                    <div class="cart-selected-price">
                                        <p>Price:<span class="price-value">
                                                ₱

                                            </span></p>
                                        <!-- Add your cart items list and total transaction calculation here -->
                                    </div>
                                </div>
                                <!-- Total Amount -->
                                <div class="cart-total">
                                    <p>Total: <!-- Calculate and display total amount here --></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            id="confirmCheckoutBtn_<?php echo $room->room_id; ?>">Confirm Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<script>
    // Initialize total amount variable
    let totalAmount = 0;

    // Initialize previous price variable
    let previousPrice = 0;

    // Add event listener to all pricing buttons
    document.querySelectorAll('.price-button').forEach(item => {
        item.addEventListener('click', event => {
            const price = parseFloat(event.currentTarget.dataset.price); // Parse price to float
            const cartPriceElement = event.currentTarget.closest('.modal-content').querySelector('.cart-selected-price');
            cartPriceElement.querySelector('.price-value').textContent = '₱' + price.toFixed(2); // Set price with 2 decimal places
            totalAmount -= previousPrice; // Subtract previous price
            totalAmount += price; // Add new price
            previousPrice = price; // Update previous price
            updateTotalAmount(); // Update displayed total amount
        });
    });

    // Function to update total amount
    function updateTotalAmount() {
        document.querySelectorAll('.cart-total p').forEach(item => {
            item.textContent = 'Total: ₱' + totalAmount.toFixed(2); // Set total amount with 2 decimal places
        });
    }
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
                // Room is in housekeeping, show an alert
                alert('This room is currently in housekeeping. Please select another room.');
            } else {
                // Room is occupied, show an alert
                alert('This room is currently occupied. Please select another room.');
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
    <?php foreach ($get_all_room as $room): ?>
        document.getElementById('confirmCheckoutBtn_<?php echo $room->room_id; ?>').addEventListener('click', function () {
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
        const currentTime = new Date(new Date().toLocaleString("en-US", { timeZone: "Asia/Manila" }));

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
        <?php foreach ($get_all_room as $room): ?>
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
</script>

<script>
    // Add event listener to remove modal backdrop after modal is hidden
    $('.modal').on('hidden.bs.modal', function (e) {
        $(this).data('bs.modal', null); // Reset modal data to prevent caching
        $('.modal-backdrop').remove(); // Remove modal backdrop
    });
</script>