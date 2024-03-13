<div id="addOnsModals">
    <div class="modal fade" id="addOnsModal" tabindex="-1" role="dialog" aria-labelledby="addOnsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                    // Assuming $checkin->check_in_time is in the format 'Y-m-d H:i:s' (e.g., '2024-03-12 23:00:00' for 11:00 PM)
                    // and $checkin->room_hour is the number of hours for the room stay (e.g., 2)
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
                        <p>Check-In Date & Time: <span id="checkInDateTime"><strong><?php echo $checkInDateTime->format('h:i A m-d-Y'); ?></strong></span></p>
                        <p>Check-Out Date & Time: <span id="checkOutDateTime"><strong><?php echo $checkOutDateTime->format('h:i A m-d-Y'); ?></strong></span></p>
                        <p>Remaining Time: <span id="remainingTime"><?php echo $remainingTimeFormatted; ?></span></p>

                        <!-- Input field to add hours -->
                        <input type="number" class="form-control col-md-3 d-inline-block" id="addHours" min="1" step="1" placeholder="Add hours">
                        <!-- Button to add hours -->
                        <button class="btn btn-primary">Add Hours</button>
                    </div>

                    <!-- Container for product selection and cart -->
                    <div class="product-cart-container">
                        <!-- Cart and total transaction card -->
                        <div class="product-card">
                            <h5>Add Ons</h5>
                            <!-- Search bar -->
                            <input type="text" class="form-control search-input" placeholder="Search Product">
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
                                                    <input type="hidden" name="product_names[]" value="">
                                                    <input type="hidden" name="product_quantities[]" value="">
                                                    <input type="hidden" name="product_prices[]" value="">
                                                    <?php foreach ($view as $row) { ?>
                                                        <tr>
                                                            <td><?= $row->product_name; ?></td>
                                                            <td>₱<?= $row->product_price; ?></td>
                                                            <td><?= $row->product_quantity; ?></td>
                                                        </tr>
                                                    <?php } ?>
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
                    <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to update remaining time every second
    function updateRemainingTime() {
        // Get the remaining time span element
        var remainingTimeSpan = document.getElementById('remainingTime');

        // Get the remaining time string
        var remainingTime = remainingTimeSpan.innerHTML;

        // Split the remaining time string into hours, minutes, and seconds
        var timeParts = remainingTime.split(':');
        var hours = parseInt(timeParts[0]);
        var minutes = parseInt(timeParts[1]);
        var seconds = parseInt(timeParts[2]);

        // Decrement seconds
        seconds--;

        // Update minutes and hours if necessary
        if (seconds < 0) {
            seconds = 59;
            minutes--;
            if (minutes < 0) {
                minutes = 59;
                hours--;
                if (hours < 0) {
                    // If remaining time is negative, stop updating
                    clearInterval(intervalId);
                    remainingTimeSpan.innerHTML = 'Your time has passed';
                    return;
                }
            }
        }

        // Format new remaining time string
        var newRemainingTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

        // Update remaining time in the span element
        remainingTimeSpan.innerHTML = newRemainingTime;

        // Apply CSS style to make the remaining time bolder
        remainingTimeSpan.style.fontWeight = 'bold';
    }

    // Call updateRemainingTime function every second
    var intervalId = setInterval(updateRemainingTime, 1000);
</script>