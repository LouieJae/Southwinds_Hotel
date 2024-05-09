<?php
// Convert the date string to a DateTime object
$dateObj = new DateTime($date);
// Get the day name
$dayName = $dateObj->format('l');
?>

<h3 class="mt-2">Room <?= $room_no ?>: <?= $date ?> (<?= $dayName ?>)</h3>

<div class="card card-outline card-danger">
    <!-- Room Report -->
    <div class="card" id="daily_reports">

        <div class="card-header">
            <a href="<?php echo site_url('bookings/view_daily_reports/' . $date); ?>" class="btn" style="background-color: #7D0A0A; color: white"> Back </a>
            <div class=" card-body" style="color: dark;">
                <div class="table-responsive">
                    <table class="table display" id="breakdown-datatables">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Actual Check Out Time</th>
                                <th>Rate</th>
                                <th>Total Hours</th>
                                <th>Products Ordered</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $prevCheckoutNo = null;
                            foreach ($breakdowns as $breakdown) {
                                // Check if it's a new checkout number
                                if ($prevCheckoutNo != $breakdown->checkout_no) {
                            ?>
                                    <tr>
                                        <td><?= $breakdown->checkout_no ?></td>
                                        <td><?= $breakdown->checkin_date ?></td>
                                        <td><?= $breakdown->checkout_date ?></td>
                                        <td><?= date('h:i A m/d/Y', strtotime($breakdown->actual_checkout_time)) ?></td>

                                        <td>₱ <?= isset($breakdown->room_price) ? number_format($breakdown->room_price, 2) : '' ?></td>
                                        <td><?= $breakdown->room_hour ?></td>
                                        <td>
                                            <?php
                                            if ($breakdown->product_name !== null && $breakdown->product_quantity !== null && $breakdown->product_price !== null) {
                                                echo $breakdown->product_name . ' (' . $breakdown->product_quantity . ') - ₱ ' . number_format($breakdown->product_price, 2);
                                            } else {
                                                echo 'No Products Ordered';
                                            }
                                            ?>
                                        </td>
                                        <td><strong>₱ <?= isset($breakdown->total_amount) ? number_format($breakdown->total_amount, 2) : '' ?></strong></td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <?= $breakdown->product_name ?> (<?= $breakdown->product_quantity ?>) - ₱ <?= isset($breakdown->product_price) ? number_format($breakdown->product_price, 2) : '' ?>
                                        </td>
                                        <td></td>
                                    </tr>
                            <?php
                                }
                                $prevCheckoutNo = $breakdown->checkout_no;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>