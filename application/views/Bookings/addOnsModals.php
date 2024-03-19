<style>
    #checkOutDateTime {
        font-weight: bolder;
    }
</style>
<div class="modal fade" id="addOnsModal" tabindex="-1" role="dialog" aria-labelledby="addOnsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?php echo site_url('Bookings/add_ons_submit/' . $checkin->check_in_id); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOnsModalLabel">Add-Ons
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Room Number and ID -->
                    <p class="room-number">
                        Room Number:
                        <?php echo $checkin->room_no; ?>
                        <br>
                        Status:
                        <?php echo ucfirst($checkin->status); ?>
                    </p>

                    <?php
                    $checkInDateTime = new DateTime($checkin->check_in_time, new DateTimeZone('Asia/Manila')); // Replace 'Asia/Manila' with your server's timezone
                    $checkOutDateTime = clone $checkInDateTime;
                    $checkOutDateTime->modify('+' . $checkin->room_hour . ' hours'); // Add room hours to check-in time

                    // Get the current date and time in the server's timezone
                    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Manila')); // Replace 'Asia/Manila' with your server's timezone

                    // Calculate remaining time interval
                    $remainingInterval = $currentDateTime->diff($checkOutDateTime);

                    // Format remaining time
                    $remainingTimeFormatted = $remainingInterval->format('%H:%I:%S');
                    ?>
                    <!-- Check-in, Check-out, and Remaining Time -->
                    <div class="time-info">
                        <p>Check-In Date & Time: <span id="checkInDateTime"><strong><?php echo isset($checkin->check_in_time) ? date('h:i A m-d-Y', strtotime($checkin->check_in_time)) : ''; ?></strong></span></p>
                        <p>Check-Out Date & Time: <span id="checkOutDateTime"><strong><?php echo isset($checkin->check_out_time) ? date('h:i A m-d-Y', strtotime($checkin->check_out_time)) : ''; ?></strong></span></p>
                        <p>Remaining Time: <span id="remainingTime"><?php echo $remainingTimeFormatted; ?></span></p>
                        <!-- Display extended time of the room -->
                        <p>Extended Time: <span id="extendedTime">0 hour(s)</span></p>

                        <input type="hidden" name="check_out_time" id="checkOutTimeInput" value="<?php echo $checkOutDateTime->format('Y-m-d H:i:s'); ?>">

                        <!-- Input field to add hours -->
                        <input type="hidden" name="add_hour" value="0">

                        <!-- Input field to add hours -->
                        <input type="number" class="form-control col-md-3 d-inline-block" id="addHours" min="1" placeholder="Add Hours">
                        <!-- Button to add hours -->
                        <button type="button" class="btn btn-primary" onclick="addHoursToRemainingTime()">Add Hours</button>
                    </div>

                    <!-- Container for product selection and cart -->
                    <div class="product-cart-container">
                        <!-- Cart and total transaction card -->
                        <div class="product-card">
                            <h5>Add Ons</h5>
                            <!-- Search bar -->
                            <input type="text" class="form-control search-input" id="productSearch" oninput="filterProducts()" placeholder="Search Product">
                            <!-- Empty content for search results -->
                            <div class="search-results">
                                <!-- Content will be populated dynamically -->
                                <?php foreach ($products as $product) : ?>
                                    <button class="product-button" data-name="<?php echo $product->product_name; ?>" data-price="<?php echo $product->product_price; ?>">
                                        <span class="product-name">
                                            <?php echo $product->product_name; ?>
                                        </span>
                                        <span class="product-price">Price: ₱
                                            <?php echo $product->product_price; ?>
                                        </span>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="cart-card">
                            <!-- Room Number and Selected Price -->
                            <div class="cart-content">
                                <!-- Room Number and Selected Price Container -->
                                <div class="cart-room-info">
                                    <div class="room-price-container">
                                        <!-- Room Number -->
                                        <p class="cart-room-number">Room Number: <?php echo $checkin->room_no; ?></p>
                                        <!-- Selected Price -->
                                        <p class="cart-selected-price">Price: <span class="price-value" name="room_price">₱<?php echo $checkin->room_price; ?></span></p>
                                    </div>
                                    <!-- Add your cart items list here -->
                                    <div class="products-container">
                                        <div class="add-ons-label">
                                            <hr>
                                            <p class="fs-20 fw-bolder">Add Ons</p>
                                        </div>
                                        <div class="added-products" name="add_ons">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($view as $row) { ?>
                                                        <input type="hidden" name="add_ons[]" value="<?= $row->add_ons_id ?> ">
                                                        <tr>
                                                            <td><?= $row->product_name; ?></td>
                                                            <td>₱<?= $row->product_price; ?></td>
                                                            <td><?= $row->product_quantity; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <input type="hidden" name="product_names[]" value="">
                                                    <input type="hidden" name="product_quantities[]" value="">
                                                    <input type="hidden" name="product_prices[]" value="">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Amount -->
                            <div class="cart-total">
                                <p>Total: <span class="total-amount">₱<?php echo $checkin->total_amount; ?></span></p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" onclick="return confirm('Are you sure you want to add this add ons?')" class="btn btn-danger btn-sm"><i class="fas fa-shopping-basket"></i> Submit</button>
                </div>
                <input type="hidden" name="total_amount" value="<?php echo isset($checkin->total_amount) ? $checkin->total_amount : ''; ?>">
                <input type="hidden" name="room_price" value="<?php echo isset($checkin->room_price) ? $checkin->room_price : ''; ?>">
                <input type="hidden" name="check_in_id" value="<?php echo $checkin->check_in_id; ?>">
            </div>
        </form>
    </div>
</div>
<script>
    function updateRemainingTime() {
        // Get the check-out date and time element
        var checkOutDateTimeElement = document.getElementById('checkOutDateTime');
        var checkOutDateTime = new Date(checkOutDateTimeElement.innerText);

        // Get the current date and time
        var currentDateTime = new Date();

        // Calculate the remaining time
        var remainingTime = calculateRemainingTime(checkOutDateTime);

        // Check if remaining time is negative
        if (remainingTime.includes('-')) {
            // Display message indicating that time has passed
            var remainingTimeSpan = document.getElementById('remainingTime');
            remainingTimeSpan.textContent = 'Room time has passed';
            remainingTimeSpan.style.fontWeight = 'bold';
            clearInterval(intervalId); // Stop the interval
        } else {
            // Update the remaining time element
            var remainingTimeSpan = document.getElementById('remainingTime');
            remainingTimeSpan.textContent = remainingTime;
            remainingTimeSpan.style.fontWeight = 'bold';
        }
    }

    // Call updateRemainingTime function every second
    var intervalId = setInterval(updateRemainingTime, 1000);


    function addHoursToRemainingTime() {
        // Get the input field for adding hours
        var addHoursInput = document.getElementById('addHours');

        // Get the value entered by the user
        var hoursToAdd = parseInt(addHoursInput.value);

        // Check if the entered value is valid (greater than or equal to 1)
        if (hoursToAdd < 1 || isNaN(hoursToAdd)) {
            toastr.error('Please enter a valid positive number of hours.');
            return; // Exit the function if the input is invalid
        }

        // Clear the input field
        addHoursInput.value = '';

        // Display a message indicating that hours have been added to the room
        toastr.success(hoursToAdd + ' hour(s) added to this room');

        // Update the extended time
        var extendedTimeElement = document.getElementById('extendedTime');
        var currentExtendedTime = extendedTimeElement.textContent;
        var currentHours = parseInt(currentExtendedTime.split(' ')[0]); // Extract current hours
        var newHours = currentHours + hoursToAdd; // Add newly added hours
        extendedTimeElement.textContent = newHours + ' hour(s)'; // Update extended time display

        // Update the value of the add_hour input field
        var addHourInput = document.querySelector('input[name="add_hour"]');
        var currentAddHourValue = parseInt(addHourInput.value);
        var newAddHourValue = currentAddHourValue + hoursToAdd;
        addHourInput.value = newAddHourValue;

        // Get the total amount element
        var totalAmountElement = document.querySelector('.cart-total .total-amount');

        // Get the current total amount
        var currentTotalAmount = parseFloat(totalAmountElement.textContent.replace('₱', ''));

        // Calculate the total amount for the added hours
        var hourlyRate = 100; // Assuming the rate is 100 pesos per hour
        var totalAmountForHours = hourlyRate * hoursToAdd;

        // Calculate the new total amount
        var newTotalAmount = currentTotalAmount + totalAmountForHours;

        // Update the total amount element with the new total amount
        totalAmountElement.textContent = `₱${newTotalAmount.toFixed(2)}`;

        // Update the total amount input field value
        var totalAmountInput = document.querySelector('input[name="total_amount"]');
        totalAmountInput.value = newTotalAmount.toFixed(2);

        // Update the checkout date and time
        var checkOutDateTimeElement = document.getElementById('checkOutDateTime');
        var checkOutDateTime = new Date(checkOutDateTimeElement.innerText);

        // Add hours to the checkout date and time
        checkOutDateTime.setHours(checkOutDateTime.getHours() + hoursToAdd);

        // Format the new checkout date and time
        var formattedCheckOutDateTime = formatDate(checkOutDateTime);

        // Update the checkout date and time element
        checkOutDateTimeElement.innerText = formattedCheckOutDateTime;

        // Update the check_out_time input field value
        var checkOutTimeInput = document.querySelector('input[name="check_out_time"]');
        checkOutTimeInput.value = formattedCheckOutDateTime;

        // Update the room price element and input field
        var roomPriceElement = document.querySelector('.cart-selected-price .price-value');
        var currentRoomPrice = parseFloat(roomPriceElement.textContent.replace('₱', ''));
        var newRoomPrice = currentRoomPrice + 100 * hoursToAdd; // Assuming the rate is 100 pesos per hour
        roomPriceElement.textContent = `₱${newRoomPrice.toFixed(2)}`;

        // Update the room price input field value
        var roomPriceInput = document.querySelector('input[name="room_price"]');
        roomPriceInput.value = newRoomPrice.toFixed(2);

        // Recalculate remaining time
        var remainingTime = calculateRemainingTime(checkOutDateTime);

        // Update the remaining time element
        var remainingTimeSpan = document.getElementById('remainingTime');
        remainingTimeSpan.textContent = remainingTime;

        function formatDate(date) {
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            var hours = ('0' + date.getHours()).slice(-2);
            var minutes = ('0' + date.getMinutes()).slice(-2);
            var seconds = ('0' + date.getSeconds()).slice(-2);
            var formattedDate = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

            return formattedDate;
        }

    }

    // Function to calculate remaining time
    function calculateRemainingTime(checkOutDateTime) {
        var currentDateTime = new Date();
        var remainingMilliseconds = checkOutDateTime - currentDateTime;
        var remainingHours = Math.floor(remainingMilliseconds / (1000 * 60 * 60));
        remainingMilliseconds -= remainingHours * 1000 * 60 * 60;
        var remainingMinutes = Math.floor(remainingMilliseconds / (1000 * 60));
        remainingMilliseconds -= remainingMinutes * 1000 * 60;
        var remainingSeconds = Math.floor(remainingMilliseconds / 1000);

        // Format remaining time
        var remainingTimeFormatted = ('0' + remainingHours).slice(-2) + ':' + ('0' + remainingMinutes).slice(-2) + ':' + ('0' + remainingSeconds).slice(-2);

        return remainingTimeFormatted;
    }

    function formatDate(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // 12-hour clock, '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;

        var formattedDate = hours + ':' + minutes + ' ' + ampm + ' ' + (date.getMonth() + 1) + '-' + date.getDate() + '-' + date.getFullYear();

        return formattedDate;
    }

    function filterProducts() {
        // Get the search input value
        var searchInput = document.getElementById('productSearch').value.toLowerCase();

        // Get all product buttons
        var productButtons = document.querySelectorAll('.product-button');

        // Flag to track if any product matches the search input
        var productFound = false;

        // Loop through each product button
        productButtons.forEach(function(button) {
            // Get the product name from the button's data attribute
            var productName = button.dataset.name.toLowerCase();

            // Check if the product name contains the search input
            if (productName.includes(searchInput)) {
                // If the product matches the search input, display it
                button.style.display = 'block';
                productFound = true; // Set flag to true indicating a product was found
            } else {
                // If the product does not match the search input, hide it
                button.style.display = 'none';
            }
        });

        // Check if no product was found and the message does not exist
        var noProductMessage = document.querySelector('.search-results .no-product-message');
        if (!productFound && !noProductMessage) {
            // If no product was found and the message does not exist, create and append the message
            noProductMessage = document.createElement('p');
            noProductMessage.textContent = 'No product found.';
            noProductMessage.classList.add('no-product-message');
            // Append the message after the product container
            document.querySelector('.search-results').appendChild(noProductMessage);
        } else if (productFound && noProductMessage) {
            // If products were found and the message exists, remove the message
            noProductMessage.remove();
        }
    }
</script>