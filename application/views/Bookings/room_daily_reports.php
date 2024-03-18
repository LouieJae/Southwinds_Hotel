<?php
// Convert the date string to a DateTime object
$dateObj = new DateTime($date);
// Get the day name
$dayName = $dateObj->format('l');
?>



<h3>Daily Sales Per Room : <?= $date ?> (<?= $dayName ?>)</h3>

<?php
// Initialize grand total sales
$grand_total_sales = 0;
?>

<div class="card card-outline card-danger">
    <div class="card-header">


        <!--h5>Date: </h5-->


        <a href="<?php echo site_url('bookings/daily_reports'); ?>" class="btn btn-dark"> Back </a>


        <div class="card-body" style="color: dark;">
            <table class="table display" id="per_room_daily-datatables">
                <thead>
                    <tr>
                        <th>Room No.</th>
                        <th style=text-align:left>Total Sales</th>
                        <th style=text-align:left>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($room as $rr) : ?>
                        <tr>
                            <th>Room <?= $rr->room_no ?></th>
                            <?php
                            $total_sales = 0;
                            $sales_found = false;
                            foreach ($daily_room as $sales) {
                                if ($rr->room_no == $sales->room_no) {
                                    echo "<td><strong>₱ " . number_format($sales->daily_total_sales_per_room, 2) . "</strong></td>";
                                    // Add to total sales for the room
                                    $total_sales += $sales->daily_total_sales_per_room;
                                    $sales_found = true;
                                    break;
                                }
                            }
                            if (!$sales_found) {
                                echo "<td>-</td>"; // Display zero if no sales data found for the room
                            }
                            ?>
                            <td>
                                <div class="col-sm-6">
                                    <a href="<?php echo site_url('bookings/view_daily_breakdowns/' . $date . '/' . $rr->room_no); ?>" class="btn btn-info btn-sm"><i class="fas fa-door-open"></i> View</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $grand_total_sales += $total_sales;
                    endforeach; ?>
                </tbody>
                <tf>
                    <tr>

                        <td style=text-align:right><strong>Grand Total Sales:</strong></td>
                        <td><strong>₱ <?= number_format($grand_total_sales, 2) ?></strong></td>
                        <td><strong></strong></td>
                    </tr>
                </tf>
            </table>
        </div>
    </div>


</div>