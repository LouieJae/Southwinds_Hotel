<div id="roomModals">
    <?php foreach ($get_all_room as $room) : ?>
        <!-- Modal for Room <?php echo $room->room_no; ?> -->
        <div class="modal fade" id="roomModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->{"2hr_price"}; ?>">2 Hours: $
                            <?php echo $room->{"2hr_price"}; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->{"3hr_price"}; ?>">3 Hours: $
                            <?php echo $room->{"3hr_price"}; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->{"6hr_price"}; ?>">6 Hours: $
                            <?php echo $room->{"6hr_price"}; ?>
                        </button>


                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->{"12hr_price"}; ?>">12 Hours:
                            $
                            <?php echo $room->{"12hr_price"}; ?>
                        </button>


                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->{"24hr_price"}; ?>">24 Hours:
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