<style>
    /* Common styles for small boxes */
    .small-box {
        border-radius: 2px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        display: block;
        margin-bottom: 20px;
        position: relative;
        border-radius: 5px;
    }

    .small-box>.inner {
        padding: 10px;
    }

    .small-box h3 {
        font-size: 40px;
        font-weight: bold;
        margin: 0 0 10px 0;
        white-space: nowrap;
    }

    .small-box p {
        font-size: 16px;
        margin: 0;
    }

    /* Icon styles */
    .small-box .icon {
        color: rgba(0, 0, 0, 0.15);
        font-size: 64px;
        position: absolute;
        right: 10px;
        top: -3px;
        transition: top 0.3s ease;
    }

    .small-box .icon>i {
        font-size: 100%;
        position: relative;
    }

    /* Hide icon on mobile devices */
    @media only screen and (max-width: 767px) {
        .small-box .icon {
            display: none;
        }
    }

    /* Hover effect */
    .small-box:hover .icon {
        top: -10px;
    }

    /* Box shadow on hover */
    .small-box:hover {
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .bg-danger {
        background-color: #dc3545 !important;
        color: #fff;
    }

    /* Chart card header styles */
    .chart-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #f4f6f9;
        border-bottom: 1px solid #d2d6de;
        border-radius: 5px 5px 0 0;
    }

    .chart-card-title {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
    }

    .chart-card-tools .btn {
        background-color: transparent;
        border: none;
        font-size: 16px;
        cursor: pointer;
        color: #6c757d;
    }

    .chart-card-tools .btn:hover {
        color: #343a40;
    }

    .chart-card-body {
        padding: 20px;
    }

    .chart-card.collapsed .chart-card-body {
        display: none;
    }
</style>
<h3 class="mt-2">Dashboard</h3>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php if (isset($data['get_total_rooms'])) : ?>
                        <?= $data['get_total_rooms']; ?>
                    <?php endif; ?>
                </h3>
                <p>Total Rooms</p>
            </div>
            <div class="icon">
                <i class="fas fa-bed"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php if (isset($data['get_total_available_rooms'])) : ?>
                        <?= $data['get_total_available_rooms']; ?>
                    <?php endif; ?>
                </h3>
                <p>Available Rooms</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-open"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php if (isset($data['get_total_occupied_rooms'])) : ?>
                        <?= $data['get_total_occupied_rooms']; ?>
                    <?php endif; ?>
                </h3>
                <p>Occupied Rooms</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-closed"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>
                    <?php if (isset($data['get_total_housekeeping_rooms'])) : ?>
                        <?= $data['get_total_housekeeping_rooms']; ?>
                    <?php endif; ?>
                </h3>
                <p>Housekeeping</p>
            </div>
            <div class="icon">
                <i class="fas fa-broom"></i>
            </div>
        </div>
    </div>
</div>

<div class="card chart-card">
    <div class="chart-card-header">
        <h3 class="chart-card-title">Sales Chart</h3>
        <div class="chart-card-tools">
            <button class="btn btn-tool minimize-chart" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button class="btn btn-tool close-chart" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="chart-card-body">
        <canvas id="salesChart" width="500" height="160"></canvas>
    </div>
</div>

<script>
    // Fetched PHP data
    const salesData = {
        labels: <?php echo json_encode($chart_labels); ?>, // Labels with day name and date
        datasets: [{
            label: 'Total Sales',
            data: <?php echo json_encode($sales_data); ?>, // Sales data for each day
            fill: false,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgba(75, 192, 192, 1)'
        }]
    };

    // Get the canvas element
    const ctx = document.getElementById('salesChart').getContext('2d');
</script>

<script>
    // Add event listener to minimize chart button
    const minimizeButton = document.querySelector('.minimize-chart');
    minimizeButton.addEventListener('click', function() {
        const chartCard = document.querySelector('.chart-card');
        chartCard.classList.toggle('collapsed');
    });

    // Add event listener to close chart button
    const closeButton = document.querySelector('.close-chart');
    closeButton.addEventListener('click', function() {
        const chartCard = document.querySelector('.chart-card');
        chartCard.remove();
    });
</script>