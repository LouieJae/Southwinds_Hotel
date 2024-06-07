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

    .colorings {
        background-color: #94BF4D;
    }

    /* Room card styles */
    .room-list {
        list-style: none;
        padding: 0;
    }

    .room-card {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 5px;
        margin-bottom: 10px;
        padding: 10px;
    }

    .room-details {
        font-size: 16px;
    }

    .room-number {
        margin: 0;
        font-weight: bold;
    }

    .room-status {
        margin: 0;
        color: #dc3545;
        /* Use a different color for attention-grabbing status */
        font-style: italic;
    }

    .chart-cards {
        height: 503px;
        overflow-y: auto;
        /* This will add a vertical scrollbar if needed */
    }

    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        /* Adjust as needed */
    }
</style>
<h3 class="mt-2">Dashboard</h3>
<audio id="alarmSound">
    <source src="<?= base_url('assets/southwinds_alarm.mp3') ?>" type="audio/mpeg">
</audio>
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box colorings">
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
        <div class="small-box colorings">
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
        <div class="small-box colorings">
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
        <div class="small-box colorings">
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

<div class="row">
    <div class="col-7">
        <div class="card chart-card">
            <div class="chart-card-header bg-primary">
                <h3 class="chart-card-title text-white">Sales Chart</h3>
            </div>
            <div class="chart-card-body">
                <canvas id="salesChart" width="500" height="420"></canvas>
            </div>
        </div>
    </div>
    <!-- Your existing HTML content -->
    <div class="col-5">
        <div class="card chart-cards">
            <div class="chart-card-header bg-danger sticky-header">
                <h3 class="chart-card-title">Overtime</h3>
            </div>

            <div class="chart-card-body" id="overtimeCard">
                <!-- Room list content -->
                <?php if (!empty($rooms_needing_attention)) : ?>
                    <div class="room-list">
                        <?php foreach ($rooms_needing_attention as $room) : ?>
                            <div class="room-card" data-room-number="<?php echo $room['room_no']; ?>">
                                <div class="room-details">
                                    <h4 class="room-number">Room Number: <?php echo $room['room_no']; ?></h4>
                                    <!-- Change the status to "Overtime" -->
                                    <p class="room-status">Status: Overtime</p>
                                    <!-- Display other relevant room details here -->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>No rooms need attention at the moment.</p>
                <?php endif; ?>
            </div>
        </div>
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

    // Function to handle click on room card
    function handleRoomCardClick(event) {
        event.preventDefault();
        // Extract room number from the clicked room card
        const roomNumber = this.querySelector('.room-number').textContent.split(': ')[1];
        // Redirect to the add-ons page with room number as a parameter
        window.location.href = `add_on`;
    }

    // Add event listeners to all room cards
    document.querySelectorAll('.room-card').forEach(function(card) {
        card.addEventListener('click', handleRoomCardClick);
    });
</script>
<script>
    // Function to play the alarm sound
    function playAlarm() {
        const alarmSound = document.getElementById('alarmSound');
        alarmSound.play();
    }

    // Function to check for overtime rooms and trigger alarm
    function checkForOvertime() {
        const roomCards = document.querySelectorAll('.room-card');
        let overtimeFound = false;

        roomCards.forEach(roomCard => {
            const roomStatus = roomCard.querySelector('.room-status').textContent.trim();
            if (roomStatus.toLowerCase().includes('overtime')) {
                overtimeFound = true;
            }
        });

        if (overtimeFound) {
            playAlarm();
        } else {
            console.log("No rooms are in overtime.");
        }
    }

    // Function to refresh the page every 10 seconds
    function refreshPage() {
        setInterval(function() {
            location.reload();
        }, 60000); // Refresh every 10 seconds
    }

    // Function to continuously check for overtime and trigger alarm
    function continuousCheck() {
        // Check for overtime every second
        setInterval(function() {
            checkForOvertime();
        }, 1000);
    }

    // Call the functions to check for overtime, refresh the page, and start continuous check
    checkForOvertime();
    refreshPage();
    continuousCheck();
</script>