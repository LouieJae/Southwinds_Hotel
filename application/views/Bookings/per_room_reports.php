<h3>Room Reports</h3>
<form method="POST" action="" class="form-row">
    <div class="form-group col-md-4">
        <label for="date_from" class="text-black">Date From:</label>
        <input type="date" id="date_from" name="date_from" class="form-control form-control-sm" required>
    </div>
    <div class="form-group col-md-4">
        <label for="date_to" class="text-black">Date To:</label>
        <input type="date" id="date_to" name="date_to" class="form-control form-control-sm" required>
    </div>
    <div class="form-group col-md-4">
        <label>&nbsp;</label>
        <button type="submit" class="btn btn-primary btn-block btn-sm">Search</button>
    </div>
</form>

<div class="card card-outline card-danger">
    <?php if (isset($_POST['date_from']) && isset($_POST['date_to'])) : ?>
        <?php
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        ?>
        <!-- Room Report -->
        <?php
        $grand_total_sales = 0; // Initialize grand total sales
        ?>

        <div class="card-header">
            <div class="card-body">
                <table class="table display cell-border" id="total-datatables">
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
                                foreach ($total as $sales) {
                                    if ($rr->room_id == $sales->room_id) {
                                        echo "<td><strong>₱ " . number_format($sales->total_sales, 2) . "</strong></td>";
                                        // Add to total sales for the room
                                        $total_sales += $sales->total_sales;
                                        $sales_found = true;
                                        break;
                                    }
                                }
                                if (!$sales_found) {
                                    echo "<td>-</td>"; // Display empty cell if no sales data found for the room
                                }
                                ?>
                            </tr>
                        <?php $grand_total_sales += $total_sales;
                        endforeach; ?>
                    </tbody>
                    <tf>
                        <td style=text-align:right><strong>Grand Total Sales:</strong></td>
                        <td><strong>₱ <?= number_format($grand_total_sales, 2) ?></strong></td>

                    </tf>
                </table>
            </div>
        </div>
    <?php else : ?>
        <p>No data found for the selected date range. Enter a new data range.</p>
    <?php endif; ?>

</div>