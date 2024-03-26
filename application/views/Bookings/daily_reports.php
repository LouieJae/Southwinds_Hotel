<h3 class="mt-2">Daily Reports</h3>

<div class="card card-outline card-danger">
    <!-- Room Report -->
    <div class="card" id="daily_reports">

        <div class="card-header">
            <div class="card-body" style="color: dark;">
                <div class="table-responsive">
                    <table class="table display" id="daily-datatables">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Sales</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_sales_by_date = array();
                            foreach ($daily_sales as $date => $sales) :
                                foreach ($sales as $sale) :
                                    if (!isset($total_sales_by_date[$date])) {
                                        $total_sales_by_date[$date] = $sale->daily_total_sales;
                                    } else {
                                        $total_sales_by_date[$date] += $sale->daily_total_sales;
                                    }
                                endforeach;
                            endforeach;

                            $start_date = new DateTime('2023-12-31');
                            $end_date = new DateTime();
                            $interval = new DateInterval('P1D');
                            $date_range = new DatePeriod($start_date, $interval, $end_date);

                            // Loop through each date and display sales or 0 if no sales recorded
                            foreach ($date_range as $date) {
                                $date_str = $date->format('Y-m-d');
                                $total_sales = isset($total_sales_by_date[$date_str]) ? $total_sales_by_date[$date_str] : 0;
                            ?>
                                <tr>
                                    <?php
                                    // Convert the date string to a DateTime object
                                    $dateObj = new DateTime($date_str);
                                    // Get the day name
                                    $dayName = $dateObj->format('l');
                                    ?>
                                    <td><?= $date_str ?> <strong><?= $dayName ?></strong></td>
                                    <?php if ($total_sales == 0) { ?>
                                        <td>-</td>
                                    <?php } else { ?>
                                        <td><strong>₱ <?= number_format($total_sales, 2) ?></strong></td>
                                    <?php } ?>
                                    <td>
                                        <div class="col-sm-6">
                                            <a href="<?php echo site_url('bookings/view_daily_reports/' . $date_str); ?>"><i class="fas fa-eye" style="color: #1C9C98" ;></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>