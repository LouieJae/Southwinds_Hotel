<?php
// Initialize grand total sales
$grand_total_sales = 0;
?>

<h3>Reports</h3>

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
<ul class="nav nav-tabs" id="moduleTabs">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#module1">Daily</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#module2">Weekly</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#module3">Monthly</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#module4">Yearly</a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="moduleTabContent">
    <!-- Daily Report -->
    <div class="tab-pane fade show active" id="module1">
        <?php if (isset($_POST['date_from']) && isset($_POST['date_to'])) : ?>
            <?php
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];
            $ledger = $this->report_model->get_sales_by_day_of_week($date_from, $date_to);
            ?>
            <div class="card-header">
                <div class="card-body" style="color: dark;">
                    <table class="table" id="user-datatables">
                        <thead>
                            <tr>
                                <th>Room No.</th>
                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($room as $rr) : ?>
                                <tr>
                                    <td>Room <?= $rr->room_no ?></td>
                                    <?php
                                    // Initialize total sales for the current room
                                    $total_sales = 0;
                                    // Loop through each day of the week
                                    $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                    foreach ($days as $day) {
                                        // Search for sales data for the current room and day
                                        $sales_found = false;
                                        foreach ($sales_data as $sale) {
                                            if ($sale->room_id == $rr->room_id && $sale->day == $day) {
                                                // Display sales for the current day
                                                echo "<td>₱" . $sale->total_sales . "</td>";
                                                // Add to total sales for the room
                                                $total_sales += $sale->total_sales;
                                                $sales_found = true;
                                                break;
                                            }
                                        }
                                        // If no sales data found for the current day, display empty cell
                                        if (!$sales_found) {
                                            echo "<td></td>";
                                        }
                                    }
                                    ?>
                                    <!-- Display total sales for the room -->
                                    <td>₱ <?= $total_sales ?></td>
                                </tr>
                            <?php
                                // Add the total sales of the current room to the grand total
                                $grand_total_sales += $total_sales;
                            endforeach;
                            ?>
                            <!-- Display the grand total sales -->

                        </tbody>
                        <tf>
                            <td colspan="7"></td>
                            <td><strong>Grand Total Sales:</strong></td>
                            <td><strong>₱ <?= $grand_total_sales ?></strong></td>
                        </tf>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <p>No data found for the selected date range.</p>
        <?php endif; ?>
    </div>

    <!-- Weekly Report -->
    <div class="tab-pane fade" id="module2">
        <div class="card-header">
            <div class="card-body">
                <table class="table" id="user-datatables-module1">
                    <thead>
                        <tr>
                            <th>Room No.</th>
                            <th>Week 1</th>
                            <th>Week 2</th>
                            <th>Week 3</th>
                            <th>Week 4</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($room as $rm) : ?>
                            <!-- Replace the following rows with dynamic data from your backend -->
                            <tr>
                                <td><?= $rm->room_no ?></td>
                                <td>₱<?= $rm->room_no ?></td>
                                <td>₱<?= $rm->room_no ?></td>
                                <td>₱<?= $rm->room_no ?></td>
                                <td>₱<?= $rm->room_no ?></td>
                                <td>₱<?= $rm->room_no ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Monthly Report -->
    <div class="tab-pane fade" id="module3">
        <div class="card-header">
            <div class="card-body">
                <table class="table" id="user-datatables-module2">
                    <thead>
                        <tr>
                            <th>Room No.</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($room as $rm) : ?>
                            <!-- Replace the following rows with dynamic data from your backend -->
                            <tr>
                                <td><?= $rm->room_no ?></td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                                <td>₱</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Yearly Report -->
    <div class="tab-pane fade" id="module4">
        <!-- Yearly Report content here -->
    </div>
</div>