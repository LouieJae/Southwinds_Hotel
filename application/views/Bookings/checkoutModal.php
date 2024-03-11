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
                                            <p class="cart-room-number">Room Number: <?php echo $room->room_no; ?></p>
                                            <!-- Selected Price -->
                                            <p class="cart-selected-price">Price: <span class="price-value" name="room_price">₱<?php echo $room->twohr_price; ?></span></p>
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
                                                        <!-- Dynamically add products here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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