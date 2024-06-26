<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Southwinds Hotel</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/logo1.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS (version 5.15.4) from CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- jQuery (version 3.6.0) from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link href="<?= base_url('assets/css/styles3.css'); ?>" rel="stylesheet" />

</head>

<style>
    /* Success notification style */
    .toast-success {
        background-color: #28a745 !important;
        /* Green background color */
    }

    /* Error notification style */
    .toast-error {
        background-color: #dc3545 !important;
        /* Red background color */
    }

    /* Warning notification style */
    .toast-warning {
        background-color: #ffc107 !important;
        /* Yellow background color */
    }

    /* Active sidebar item style */
    .nav-link.active {
        background-color: #95BE56;
        /* Change the background color to red */
        color: white;
        /* Optionally change text color */
    }

    /* Adjusting nested sidebar items */
    .sb-sidenav-menu-nested .nav-link.active {
        margin-left: -25px;
        /* Adjust margin to align nested items with parent */
        text-align: center;
    }

    /* Hide icon on mobile devices */
    @media only screen and (max-width: 767px) {
        .small-box .icon {
            display: none;
        }
    }

    /* Hide icon on mobile devices */
    @media only screen and (max-width: 767px) {
        .user-greeting {
            display: none;
        }
    }
</style>

<script>

</script>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navings">
        <!-- Navbar Brand-->
        <a href="<?= base_url('bookings/dashboard') ?>" class="brand-link d-flex align-items-center exclude-from-highlight">
            <img src="<?= base_url('assets/images/logonew.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 mb-1 ml-1" style="opacity: 10.0; max-width: 85%; max-height: 65px" />
        </a>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars text-white"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <!-- Navbar-->
        <span class="user-greeting text-white">Hi,
            <?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?>! &nbsp;
        </span>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-white"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('bookings/logout') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">General</div>
                        <?php if (isset($_SESSION['UserLoginSession']['roles']) && ($_SESSION['UserLoginSession']['roles'] == USER_ROLE_ADMIN || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_FRONT_DESK)) : ?>
                            <a id="nav-link" class="nav-link text-dark" href="<?= base_url('bookings/dashboard') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt text-dark"></i>
                                </div>
                                Dashboard
                            </a>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['UserLoginSession']['roles']) && $_SESSION['UserLoginSession']['roles'] == USER_ROLE_ADMIN || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_FRONT_DESK) : ?>
                            <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-bed text-dark"></i>
                                </div>
                                Room Accommodations
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse bg-secondary" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white" href="<?= base_url('bookings/room_accommodations') ?>">Rooms</a>
                                    <a class="nav-link text-white" href="<?= base_url('bookings/add_on') ?>">Check In</a>
                                </nav>
                            </div>
                            <a class="nav-link text-dark" href="<?= base_url('bookings/product') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-archive text-dark"></i>
                                </div>
                                Inventory
                            </a>
                            <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#reports" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chart-line text-dark"></i>
                                </div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse bg-secondary" id="reports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white" href="<?= base_url('bookings/daily_reports') ?>">Daily Report</a>
                                    <a class="nav-link text-white" href="<?= base_url('bookings/monthly_reports') ?>">Monthly Report</a>
                                    <a class="nav-link text-white" href="<?= base_url('bookings/per_room_reports') ?>">Per Room</a>
                                </nav>
                            </div>
                            <a class="nav-link text-dark" href="<?= base_url('bookings/activity_logs') ?>">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-clock text-dark"></i>
                                </div>
                                Activity Logs
                            </a>
                        <?php elseif (isset($_SESSION['UserLoginSession']['roles']) && $_SESSION['UserLoginSession']['roles'] == USER_ROLE_MANAGER || $_SESSION['UserLoginSession']['roles'] == USER_ROLE_FRONT_DESK) : ?>
                            <a class="nav-link collapsed text-dark" href="#" data-bs-toggle="collapse" data-bs-target="#reports" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chart-line text-dark"></i>
                                </div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="collapse bg-secondary" id="reports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link text-white" href="<?= base_url('bookings/daily_reports') ?>">Daily Report</a>
                                    <a class="nav-link text-white" href="<?= base_url('bookings/monthly_reports') ?>">Monthly Report</a>
                                    <a class="nav-link text-white" href="<?= base_url('bookings/per_room_reports') ?>">Per Room</a>
                                </nav>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">