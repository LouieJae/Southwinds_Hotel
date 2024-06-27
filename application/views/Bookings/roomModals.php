<style>
    .modal-header {
        background-color: #89CBEE;
    }

    .modal-title {
        color: black;
        font-weight: bold;
    }

    .bold-label {
        font-weight: bolder;
    }
</style>

<?php foreach ($get_all_room as $room) : ?>
    <!-- Modal for Room <?php echo $room->room_no; ?> -->
    <div class="modal fade" id="roomModal_<?php echo $room->room_id; ?>" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel_<?php echo $room->room_id; ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo site_url('bookings/checkin_submit'); ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roomModalLabel_<?php echo $room->room_id; ?>">Check-In:</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                        <input type="hidden" name="room_hour" value="2">
                        <input type="hidden" name="status" value="<?php echo ucfirst($room->status); ?>">
                        <input type="hidden" name="room_price" value="<?php echo $room->threehr_price; ?>">
                        <input type="hidden" name="prepared_by" value="<?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?>">
                        <input type="hidden" name="date" value="<?= date('Y-d-m'); ?>">
                        <input type="hidden" name="check_in_time" value="<?php echo date('Y-m-d H:i:s'); ?>">
                        <input type="hidden" name="check_out_time" value="">

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->threehr_price; ?>" data-hour="3">3 Hours: $
                            <?php echo $room->threehr_price; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->sixhr_price; ?>" data-hour="6">6 Hours:
                            $
                            <?php echo $room->sixhr_price; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->twelvehr_price; ?>" data-hour="12">12 Hours:
                            $
                            <?php echo $room->twelvehr_price; ?>
                        </button>

                        <button class="btn btn-sm btn-price btn-block p-1 price-button" data-price="<?php echo $room->twentyfourhr_price; ?>" data-hour="24">24 Hours:
                            $
                            <?php echo $room->twentyfourhr_price; ?>
                        </button>

                        <br>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="vip">
                            <label class="form-check-label" for="inlineRadio1" style="color: #FF0000"><strong>VIP</strong></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="regular">
                            <label class="form-check-label" for="inlineRadio2" style="color: #0077b6"><strong>Regular</strong></label>
                        </div>

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
                                            <p class="cart-selected-price">Price: <span class="price-value" name="room_price">₱<?php echo $room->threehr_price; ?></span></p>
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
                                                        <input type="hidden" name="add_ons" value="<?= $add_ons_no ?>">
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
                        <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" onclick="return confirm('Are you sure you want to check in?')" class="btn btn-danger btn-sm"><i class="fas fa-door-closed"></i>Check-In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        // Calculate default checkout time on page load
        var defaultHourValue = 3; // Default duration in hours
        var now = new Date();
        var checkoutTime = new Date(now.getTime() + defaultHourValue * 60 * 60 * 1000);
        var checkoutYear = checkoutTime.getFullYear();
        var checkoutMonth = ('0' + (checkoutTime.getMonth() + 1)).slice(-2); // Months are zero-based
        var checkoutDate = ('0' + checkoutTime.getDate()).slice(-2);
        var checkoutHours = ('0' + checkoutTime.getHours()).slice(-2);
        var checkoutMinutes = ('0' + checkoutTime.getMinutes()).slice(-2);
        var checkoutSeconds = ('0' + checkoutTime.getSeconds()).slice(-2);
        var checkoutDateTimeString = checkoutYear + '-' + checkoutMonth + '-' + checkoutDate + ' ' + checkoutHours + ':' + checkoutMinutes + ':' + checkoutSeconds;

        // Set default value for the checkout time field
        $('input[name="check_out_time"]').val(checkoutDateTimeString);

        // Event listener for duration buttons
        $('.price-button').click(function(event) {
            event.preventDefault();
            var hourValue = $(this).data('hour');
            $('input[name="room_hour"]').val(hourValue);

            // Calculate checkout time based on selected duration
            var checkoutTime = new Date(now.getTime() + hourValue * 60 * 60 * 1000);
            var checkoutYear = checkoutTime.getFullYear();
            var checkoutMonth = ('0' + (checkoutTime.getMonth() + 1)).slice(-2); // Months are zero-based
            var checkoutDate = ('0' + checkoutTime.getDate()).slice(-2);
            var checkoutHours = ('0' + checkoutTime.getHours()).slice(-2);
            var checkoutMinutes = ('0' + checkoutTime.getMinutes()).slice(-2);
            var checkoutSeconds = ('0' + checkoutTime.getSeconds()).slice(-2);
            var checkoutDateTimeString = checkoutYear + '-' + checkoutMonth + '-' + checkoutDate + ' ' + checkoutHours + ':' + checkoutMinutes + ':' + checkoutSeconds;

            // Update checkout time field value
            $('input[name="check_out_time"]').val(checkoutDateTimeString);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.price-button').click(function(event) {
            event.preventDefault();
            var hourValue = $(this).data('hour');
            $('input[name="room_hour"]').val(hourValue);
        });
    });
</script>

<script>
    $(document).ready(function() {
        var originalRoomPrice = <?php echo $room->threehr_price; ?>;
        var currentPrice = originalRoomPrice;
        var currentHourValue = 3;
        var vipRoomPrice = currentPrice;

        // Function to check if a price button has been clicked
        function isPriceButtonClicked() {
            return $('.price-button').hasClass('active');
        }

        // Function to check if a radio button has been selected
        function isRadioButtonSelected() {
            return $('input[name="inlineRadioOptions"]:checked').length > 0;
        }

        // Function to update room price and total amount
        function updateRoomPriceAndTotalAmount(discountPercent) {
            var roomPrice = currentPrice;
            if (discountPercent) {
                // Calculate discounted price for VIP
                roomPrice = roomPrice - (roomPrice * discountPercent / 100);
            }
            // Update room price display
            $('input[name="room_price"]').val(roomPrice.toFixed(2));
            $('.price-value').text('₱' + roomPrice.toFixed(2));
            // Update total amount
            updateTotalAmount(roomPrice);
        }

        // Function to update total amount
        function updateTotalAmount(roomPrice) {
            var productTotal = 0;
            // Calculate total amount based on room price and add-ons
            $('input[name="product_prices[]"]').each(function() {
                var price = parseFloat($(this).val());
                if (!isNaN(price)) {
                    productTotal += price;
                }
            });
            // Calculate total amount
            var totalAmount = roomPrice + productTotal;
            $('.cart-total p').text('Total: ₱' + totalAmount.toFixed(2));
        }

        // Event listener for form submission
        $('form').submit(function(event) {
            // Check if no price button has been clicked
            if (!isPriceButtonClicked()) {
                // Prevent form submission
                event.preventDefault();
                // Show an error message
                toastr.error('Please select a pricing option before checking in.');
                return false;
            }

            // Check if no radio button has been selected
            if (!isRadioButtonSelected()) {
                // Prevent form submission
                event.preventDefault();
                // Show an error message
                toastr.error('Please select VIP or Regular before checking in.');
                return false;
            }
        });

        // Event listener for radio buttons
        $('input[name="inlineRadioOptions"]').change(function() {
            if (!isPriceButtonClicked()) {
                // Show an error message and prevent selecting the radio option
                toastr.error('Please select a pricing option before choosing VIP or Regular.');
                // Uncheck the radio button
                $(this).prop('checked', false);
            } else {
                if ($(this).val() === 'vip') {
                    // Apply 5% discount for VIP
                    updateRoomPriceAndTotalAmount(5);
                } else {
                    // Regular price
                    updateRoomPriceAndTotalAmount(0);
                }
            }
        });

        // Event listener for price buttons
        $('.price-button').click(function(event) {
            event.preventDefault();
            currentPrice = parseFloat($(this).data('price'));
            currentHourValue = parseInt($(this).data('hour'));
            $('input[name="room_hour"]').val(currentHourValue);
            // Mark the clicked button as active
            $('.price-button').removeClass('active');
            $(this).addClass('active');
            // Uncheck the radio buttons
            $('input[name="inlineRadioOptions"]').prop('checked', false);
            // Calculate checkout time based on selected duration
            var checkoutTime = new Date(Date.now() + currentHourValue * 60 * 60 * 1000);
            var checkoutYear = checkoutTime.getFullYear();
            var checkoutMonth = ('0' + (checkoutTime.getMonth() + 1)).slice(-2); // Months are zero-based
            var checkoutDate = ('0' + checkoutTime.getDate()).slice(-2);
            var checkoutHours = ('0' + checkoutTime.getHours()).slice(-2);
            var checkoutMinutes = ('0' + checkoutTime.getMinutes()).slice(-2);
            var checkoutSeconds = ('0' + checkoutTime.getSeconds()).slice(-2);
            var checkoutDateTimeString = checkoutYear + '-' + checkoutMonth + '-' + checkoutDate + ' ' + checkoutHours + ':' + checkoutMinutes + ':' + checkoutSeconds;

            // Update checkout time field value
            $('input[name="check_out_time"]').val(checkoutDateTimeString);
            // Update room price display
            updateRoomPriceAndTotalAmount(0);
        });
    });
</script>

<!-- Inside your existing script tags -->
<script>
    $(document).ready(function() {
        // Function to check if a price button has been clicked
        function isPriceButtonClicked() {
            return $('.price-button').hasClass('active');
        }

        // Event listener for form submission
        $('form').submit(function(event) {
            // Check if no price button has been clicked
            if (!isPriceButtonClicked()) {
                // Prevent form submission
                event.preventDefault();
                // Show an error message
                toastr.error('Please select a pricing option before checking in.');
            }
        });

        // Event listener for radio buttons
        $('input[name="inlineRadioOptions"]').change(function() {
            // Check if no price button has been clicked
            if (!isPriceButtonClicked()) {
                // Show an error message and prevent selecting the radio option
                toastr.error('Please select a pricing option before choosing VIP or Regular.');
                // Uncheck the radio button
                $(this).prop('checked', false);
            } else {
                // Continue with selecting VIP or Regular option
                // Your existing code for handling VIP and Regular selections
            }
        });

        // Event listener for price buttons
        $('.price-button').click(function(event) {
            event.preventDefault();
            var hourValue = $(this).data('hour');
            $('input[name="room_hour"]').val(hourValue);
            // Mark the clicked button as active
            $('.price-button').removeClass('active');
            $(this).addClass('active');
            // Calculate checkout time based on selected duration
            var checkoutTime = new Date(now.getTime() + hourValue * 60 * 60 * 1000);
            var checkoutYear = checkoutTime.getFullYear();
            var checkoutMonth = ('0' + (checkoutTime.getMonth() + 1)).slice(-2); // Months are zero-based
            var checkoutDate = ('0' + checkoutTime.getDate()).slice(-2);
            var checkoutHours = ('0' + checkoutTime.getHours()).slice(-2);
            var checkoutMinutes = ('0' + checkoutTime.getMinutes()).slice(-2);
            var checkoutSeconds = ('0' + checkoutTime.getSeconds()).slice(-2);
            var checkoutDateTimeString = checkoutYear + '-' + checkoutMonth + '-' + checkoutDate + ' ' + checkoutHours + ':' + checkoutMinutes + ':' + checkoutSeconds;

            // Update checkout time field value
            $('input[name="check_out_time"]').val(checkoutDateTimeString);
        });
    });
</script>