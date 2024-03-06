<div id="checkoutModal">
    <?php foreach ($get_all_room as $room) : ?>
        <div class="modal fade" id="checkoutModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
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
                        <button type="button" class="btn btn-primary" id="confirmCheckoutBtn_<?php echo $room->room_id; ?>">Confirm Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>