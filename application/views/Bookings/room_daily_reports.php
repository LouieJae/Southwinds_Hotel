<h3>Daily Per Room</h3>

<?php
// Initialize grand total sales
$grand_total_sales = 0;
?>

<div class="card card-outline card-danger">
    <div class="card-header">
        <?php
        // Convert the date string to a DateTime object
        $dateObj = new DateTime($date);
        // Get the day name
        $dayName = $dateObj->format('l');
        ?>

        <h5>Date: <?= $date ?> (<?= $dayName ?>)</h5>
        <div class="card-body" style="color: dark;">
            <table class="table display" id="per_room_daily-datatables">
                <thead>
                    <tr>
                        <th>Room No.</th>
                        <th>Total Sales</th>
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
                                if ($rr->room_id == $sales->room_id) {
                                    echo "<td><strong>₱" . $sales->daily_total_sales_per_room . "</strong></td>";
                                    // Add to total sales for the room
                                    $total_sales += $sales->daily_total_sales_per_room;
                                    $sales_found = true;
                                    break;
                                }
                            }
                            if (!$sales_found) {
                                echo "<td>₱0</td>"; // Display zero if no sales data found for the room
                            }
                            ?>
                        </tr>
                    <?php
                        $grand_total_sales += $total_sales;
                    endforeach; ?>
                </tbody>
                <tf>
                    <tr>
                        <td><strong>Grand Total Sales:</strong></td>
                        <td><strong>₱<?= $grand_total_sales ?></strong></td>
                    </tr>
                </tf>
            </table>
        </div>
    </div>


</div>