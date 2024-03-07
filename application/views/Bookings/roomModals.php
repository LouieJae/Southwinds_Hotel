<form method="post" action="<?php echo site_url('bookings/checkin_submit'); ?>">
    <?php foreach ($get_all_room as $room) : ?>
        <!-- Modal for Room <?php echo $room->room_no; ?> -->
        <div class="modal fade" id="roomModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="post" action="<?php echo site_url('bookings/checkin_submit'); ?>">
                        <div class="modal-header">
                            <h5 class="modal-title" id="roomModalLabel_<?php echo $room->room_id; ?>">Check-In:</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Room Number -->
                            <p class="room-number" name="room_no">
                                Room Number:
                                <?php echo $room->room_no; ?>
                                <br>
                                <span class="room-info" name="status">Status:
                                    <?php echo ucfirst($room->status); ?>
                                </span>
                            </p>
                            <input type="hidden" name="room_no" value="<?php echo $room->room_no; ?>">
                            <input type="hidden" name="status" value="<?php echo ucfirst($room->status); ?>">
                            <input type="hidden" name="room_price" value="<?php echo $room->{'2hr_price'}; ?>">
                            <input type="hidden" name="prepared_by" value="<?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?>">
                            <input type="hidden" name="date" value="<?= date('Y-d-m'); ?>">

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
                                                <p class="cart-selected-price">Price: <span class="price-value" name="room_price">₱<?php echo $room->{"2hr_price"}; ?></span></p>
                                            </div>
                                            <!-- Add your cart items list here -->
                                            <div class="products-container">
                                                <div class="add-ons-label">
                                                    <hr>
                                                    <p class="fs-20 fw-bolder">Add Ons</p>
                                                </div>
                                                <div class="added-products" name="add_ons">
                                                    <input type="hidden" name="add_ons" value="">
                                                    <!-- Dynamically add products here -->
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
                            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger btn-sm">Check-In</button>
                        </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</form>

<script>
    // Prevent form submission when clicking on price buttons or selecting products
    $(document).ready(function() {
        $('.price-button').click(function(event) {
            event.preventDefault();
        });
        $('.product-button').click(function(event) {
            event.preventDefault();
        });
    });
</script>