<h3>Monthly Per Room : <?= date('F Y', strtotime($date . '-01')) ?></h3>
<?php
// Initialize grand total sales
$grand_total_sales = 0;
?>
<div class="card card-outline card-danger">
    <div class="card-header">
        <a href="<?php echo site_url('bookings/monthly_reports'); ?>" class="btn btn-dark"> Back </a>
        <div class="card-body" style="color: dark;">
            <table class="table display" id="per_room_monthly-datatables">
                <thead>
                    <tr>
                        <th>Room No.</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($room as $rr) : ?>
                        <tr>
                            <td>Room <?= $rr->room_no ?></td>
                            <?php

                            $total_sales = 0;
                            $sales_found = false;
                            foreach ($monthly_room as $room_sale) {
                                if ($room_sale->room_id == $rr->room_id) {
                                    echo "<td><strong>₱ " . number_format($room_sale->total_sales, 2) . "</strong></td>";
                                    $total_sales = $room_sale->total_sales;
                                    $sales_found = true;
                                    break;
                                }
                            }
                            if (!$sales_found) {
                                echo "<td>-</td>";
                            }
                            ?>
                        </tr>
                    <?php
                        $grand_total_sales += $total_sales;
                    endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td style=text-align:right><strong>Grand Total Sales:</strong></td>
                        <td><strong>₱ <?= number_format($grand_total_sales, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>