<style>
    .analytics-container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .card {
        flex-basis: calc(25% - 20px);
        margin-bottom: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        background-color: #BF3131;
    }

    .card:hover {
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 20px;
        margin-bottom: 10px;
        text-align: center;
        color: #fff;
    }

    .card-text {
        font-size: 60px;
        font-weight: bold;
        text-align: center;
        color: #fff;
    }

    .fa-icon {
        font-size: 36px;
        margin-right: 10px;
        color: #fff;
    }

    .chart-card {
        flex-basis: 100%;
        margin-bottom: 20px;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        color: #000;
    }

    .chart-card-body {
        padding: 20px;
    }

    @media only screen and (max-width: 768px) {
        .card {
            flex-basis: calc(50% - 20px);
        }
    }

    @media only screen and (max-width: 576px) {
        .card {
            flex-basis: calc(100% - 20px);
        }
    }
</style>

<h3>Dashboard</h3>
<div class="analytics-container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-bed fa-icon"></i>Total Rooms</h5>
            <p class="card-text"><span id="totalRooms">
                    <?= $get_total_rooms ?>
                </span></p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-door-open fa-icon"></i>Available Rooms</h5>
            <p class="card-text"><span id="availableRooms">
                    <?= $get_total_available_rooms ?>
                </span></p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-door-closed fa-icon"></i>Occupied Rooms</h5>
            <p class="card-text"><span id="occupiedRooms"></span>
                <?= $get_total_occupied_rooms ?>
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-exclamation-triangle fa-icon"></i>Rooms Low in Stock</h5>
            <p class="card-text"><span id="lowStockRooms"></span></p>
        </div>
    </div>
</div>

<!-- New card for the chart -->
<div class="card chart-card">
    <div class="chart-card-body">
        <canvas id="roomChart" width="400" height="127"></canvas>
    </div>
</div>

<script>
    // Sample data (replace with your actual data)
    const totalRooms = 100;
    const availableRooms = 70;
    const occupiedRooms = 20;
    const lowStockRooms = 5;

    // Update the DOM with the analytics data
    document.getElementById('lowStockRooms').textContent = lowStockRooms;
</script>