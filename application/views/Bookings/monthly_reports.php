<h3>Monthly Report</h3>

<div class="card card-outline card-danger">
    <!-- Room Report -->
    <div class="card" id="monthly_reports">

        <div class="card-header">
            <div class="card-body" style="color: dark;">
                <table class="table display" id="monthly-datatables">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Monthly Total Sales</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php ksort($monthly_sales); ?>
                    <tbody>
                        <?php foreach ($monthly_sales as $year_month => $sales) :
                            $total_sales = isset($sales[0]) ? $sales[0]->total_sales : "-" ?>
                            <tr>
                                <td><?= date('F Y', strtotime($year_month . '-01')) ?> </td>
                                <?php if ($total_sales == "-") { ?>
                                    <td>-</td>
                                <?php } else { ?>
                                    <td><strong>₱ <?= number_format($total_sales, 2) ?></strong></td>
                                <?php } ?>
                                <td>
                                    <div class="col-sm-6">
                                        <a href="<?php echo site_url('bookings/view_monthly_reports/' . $year_month); ?>" class="btn btn-info btn-sm"><i class="fas fa-door-open"></i> View</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {

        var totalPages = table.page.info().pages; // Get the total number of pages
        table.page(totalPages - 1).draw('page'); // Set the initial page to the last page
    });
</script>