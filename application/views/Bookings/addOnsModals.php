<div id="addOnsModals">
    <?php foreach ($get_all_room as $room) : ?>
        <div class="modal fade" id="addOnsModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog" aria-labelledby="addOnsModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
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
                            <input type="number" class="form-control col-md-3 d-inline-block" id="addHours_<?php echo $room->room_id; ?>" min="1" step="1" placeholder="Add hours">
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