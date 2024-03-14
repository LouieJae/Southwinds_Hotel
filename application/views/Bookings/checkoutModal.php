<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="addOnsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?php echo site_url('Bookings/check_out_submit/' . $checkout->check_in_id); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Room Number and ID -->
                    <p class="room-number">
                        Room Number:
                        <?php echo $checkout->room_no; ?>
                        <input type="hidden" name="room_no" value="<?php echo $checkout->room_no; ?>">
                        <br>
                        Status:
                        <?php echo ucfirst($checkout->status); ?>
                    </p>

                    <?php
                    // Assuming $checkin->check_in_time is in the format 'Y-m-d H:i:s' (e.g., '2024-03-12 23:00:00' for 11:00 PM)
                    // and $checkin->room_hour is the number of hours for the room stay (e.g., 2)
                    $checkInDateTime = new DateTime($checkout->check_in_time, new DateTimeZone('Asia/Manila')); // Replace 'Asia/Manila' with your server's timezone
                    $checkOutDateTime = clone $checkInDateTime;
                    $checkOutDateTime->modify('+' . $checkout->room_hour . ' hours'); // Add room hours to check-in time

                    // Get the current date and time in the server's timezone
                    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Manila')); // Replace 'Asia/Manila' with your server's timezone

                    // Calculate remaining time interval
                    $remainingInterval = $currentDateTime->diff($checkOutDateTime);

                    // Format remaining time
                    $remainingTimeFormatted = $remainingInterval->format('%H:%I:%S');
                    ?>
                    <!-- Check-in, Check-out, and Remaining Time -->
                    <div class="time-info">
                        <p>Check-In Time: <span id="checkInDateTime"><strong><?php echo $checkInDateTime->format('h:i A m/d/Y'); ?></strong></span></p>
                        <p>Check-Out Time: <span id="checkOutDateTime"><strong><?php echo $checkOutDateTime->format('h:i A m/d/Y'); ?></strong></span></p>
                        <p>Remaining Time: <span id="remainingTime"><?php echo $remainingTimeFormatted; ?></span></p>
                        <p>Overtime: <span id="overtime">0:00:00</span></p>
                    </div>

                    <!-- Container for product selection and cart -->
                    <div class="product-cart-container">
                        <div class="cart-carding">
                            <!-- Room Number and Selected Price -->
                            <div class="cart-content">
                                <!-- Room Number and Selected Price Container -->
                                <div class="cart-room-info">
                                    <div class="room-price-container">
                                        <!-- Room Number -->
                                        <p class="cart-room-number">Room Number: <?php echo $checkout->room_no; ?></p>
                                        <!-- Selected Price -->
                                        <p class="cart-selected-price">Price: <span class="price-value" name="room_price">₱<?php echo $checkout->room_price; ?></span></p>
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
                                                            <input type="hidden" name="product_names[]" value="">
                                                            <input type="hidden" name="product_quantities[]" value="">
                                                            <input type="hidden" name="product_prices[]" value="">
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
                                <p>Total: <span class="total-amount">₱<?php echo $checkout->total_amount; ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" onclick="return confirm('Are you sure you want to update this check in?')" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
                </div>
                <input type="hidden" name="room_price" value="<?php echo isset($checkout->room_price) ? $checkout->room_price : ''; ?>">
                <input type="hidden" name="check_in_id" value="<?php echo $checkout->check_in_id; ?>">
            </div>
    </div>
</div>