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
                    <!-- Check-in, Check-out, and Remaining Time -->
                    <div class="time-info">
                        <p>Check-In Time: <span id="checkInTime"><?php echo date('h:i A', strtotime($checkin->check_in_time)); ?></span></p>
                        <p>Check-Out Time: <span id="checkOutTime">00:00:00</span></p>
                        <p>Remaining Time: <span id="remainingTime">00:00:00</span></p>
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
</div>