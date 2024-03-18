</div>


</body>

</html>
<!-- Bootstrap JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>


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

    // Create the chart
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: salesData,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>



</body>

</html>
<script>
    var sidebarOpen = true; // Initial state of the sidebar
    var toggleBtn = document.querySelector('.toggle-btn');

    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        var content = document.querySelector('.content');

        sidebarOpen = !sidebarOpen; // Toggle the state

        if (sidebarOpen) {
            sidebar.style.left = '0';
            content.style.marginLeft = '260px';
            toggleBtn.style.marginLeft = '260px';
        } else {
            sidebar.style.left = '-260px';
            content.style.marginLeft = '0';
            toggleBtn.style.marginLeft = '15px';
        }
    }

    $(document).ready(function() {
        // Toggle dropdown when clicking on it
        $('.custom-dropdown').on('click', function(event) {
            $('.custom-dropdown').not($(this)).removeClass('open'); // Close other dropdowns
            $(this).toggleClass('open');
            event.stopPropagation(); // Prevent the click event from propagating to the document
        });

        // Close dropdown when clicking outside of it
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.custom-dropdown').length) {
                $('.custom-dropdown').removeClass('open');
            }
        });
    });

    // Define a variable to store the state of the sidebar
    var isSidebarOpen = true;

    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        var content = document.querySelector('.content');
        var toggleBtn = document.querySelector('.toggle-btn');

        if (window.innerWidth <= 767) {
            // Close sidebar if the screen size is smaller than or equal to 767px
            sidebar.style.width = '0';
            content.style.marginLeft = '0';
            toggleBtn.style.marginLeft = '10px'; // Adjust margin for better spacing
            isSidebarOpen = false;
        } else {
            // Toggle sidebar for larger screens
            if (isSidebarOpen) {
                sidebar.style.width = '0';
                content.style.marginLeft = '0';
                toggleBtn.style.marginLeft = '10px'; // Adjust margin for better spacing
                isSidebarOpen = false;
            } else {
                sidebar.style.width = '250px';
                content.style.marginLeft = '250px';
                toggleBtn.style.marginLeft = '260px'; // Adjust margin for better spacing
                isSidebarOpen = true;
            }
        }

        // Show or hide sidebar items based on the sidebar state
        var sidebarLinks = document.querySelectorAll('.sidebar a');
        for (var i = 0; i < sidebarLinks.length; i++) {
            sidebarLinks[i].style.display = isSidebarOpen ? 'block' : 'none';
        }
    }

    $(document).ready(function() {
        // Function to highlight the active link in the sidebar
        function highlightActiveLink() {
            var currentUrl = window.location.href;

            // Remove active class from all sidebar links
            $('.sidebar a').removeClass('active');

            // Iterate through each sidebar link
            $('.sidebar a').each(function() {
                // Check if the link should be excluded from highlighting
                if (!$(this).hasClass('exclude-from-highlight')) {
                    var linkUrl = $(this).attr('href');

                    // Check if the current URL contains the link URL
                    if (currentUrl.indexOf(linkUrl) !== -1) {
                        // Add the active class to the matching link
                        $(this).addClass('active');
                    }
                }
            });
        }

        // Call the function when the page loads
        highlightActiveLink();
    });
</script>