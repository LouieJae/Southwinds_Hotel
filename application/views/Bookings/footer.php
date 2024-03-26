</div>
</main>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Latest compiled and minified JavaScript for Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

<!-- Your custom scripts -->
<script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales data

    // Your DataTable initialization scripts
    $(document).ready(function() {
        $('#user-datatables').dataTable({
            "lengthMenu": [5, 10, 25, 50, 75, 100]
        });

        // Initialize DataTable for Module 1
        $('#user-datatables-module1').DataTable({
            "lengthMenu": [5, 10, 25, 50, 75, 100]
        });

        // Initialize DataTable for Module 2
        $('#user-datatables-module2').DataTable({
            "lengthMenu": [5, 10, 25, 50, 75, 100]
        });

        // Initialize DataTable for Module 3
        $('#per_room_monthly-datatables').DataTable({
            "lengthMenu": [8, 20],
            responsive: true
        });

        // Initialize DataTable for Module 4
        $('#per_room_daily-datatables').DataTable({
            "lengthMenu": [8, 28],

            responsive: true
        });
        // Initialize DataTable for Module 4
        $(document).ready(function() {
            var table = $('#monthly-datatables').DataTable({
                "lengthMenu": [12],
                "scrollY": "500px",
                responsive: true,
                ordering: false
            });

            var totalPages = table.page.info().pages; // Get the total number of pages
            table.page(totalPages - 1).draw('page'); // Set the initial page to the last page
        });
        $(document).ready(function() {
            var table = $('#daily-datatables').DataTable({
                "lengthMenu": [7],

                responsive: true,
                ordering: false
            });

            var totalPages = table.page.info().pages; // Get the total number of pages
            table.page(totalPages - 1).draw('page'); // Set the initial page to the last page
        });
        $('#total-datatables').dataTable({
            "lengthMenu": [8, 25, 50],
            responsive: true
        });

        $(document).ready(function() {
            var table = $('#breakdown-datatables').DataTable({
                "lengthMenu": [10, 25, 50],

                responsive: true,
                ordering: false
            });
        });

        // Additional DataTable configurations
        $('#ledger-table').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 25, 50],
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-right"></i>',
                    previous: '<i class="fa fa-angle-left"></i>'
                }
            }
        });
    });

    $(document).ready(function() {
        // Get the current page URL
        var currentPageUrl = window.location.href;

        // Loop through each sidebar link
        $("#layoutSidenav_nav a.nav-link").each(function() {
            var linkUrl = $(this).attr("href");

            // Check if the current page URL matches the link's URL
            if (currentPageUrl.includes(linkUrl)) {
                $(this).addClass("active");
                // If there's a match, add the "active" class to the link
            }
        });
    });

    let salesChart;

    // Function to create the appropriate chart based on screen size
    function createChart() {
        const width = window.innerWidth;
        const isMobile = width <= 767;

        const chartType = isMobile ? 'bar' : 'line';

        if (salesChart) {
            salesChart.destroy();
        }

        salesChart = new Chart(ctx, {
            type: chartType,
            data: salesData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Create the initial chart
    createChart();

    // Update the chart if the window is resized
    window.addEventListener('resize', createChart);

    // Update the chart if the window is resized
    window.addEventListener('resize', function() {
        if (salesChart) {
            salesChart.destroy();
        }
        createChart();
    });
</script>