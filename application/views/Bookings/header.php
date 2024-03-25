<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Southwinds Hotel</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/southwinds_logo.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS (version 5.15.4) from CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- jQuery (version 3.6.0) from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet" />
    <script src="<?= base_url('assets/js/scripts.js'); ?>"></script>
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
        background-color: #BF3131;
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
</style>

<script>

</script>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navings">
        <!-- Navbar Brand-->
        <a href="<?= base_url('bookings/dashboard') ?>" class="brand-link d-flex align-items-center exclude-from-highlight">
            <img src="<?= base_url('assets/images/southwinds2.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8; max-width: 90%; max-height: 65px" />
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
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">General</div>
                        <a id="nav-link" class="nav-link" href="<?= base_url('bookings/dashboard') ?>">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-bed"></i>
                            </div>
                            Room Accommodations
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse bg-secondary" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url('bookings/room_accommodations') ?>">Rooms</a>
                                <a class="nav-link" href="<?= base_url('bookings/add_on') ?>">Check In</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?= base_url('bookings/product') ?>">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-archive"></i>
                            </div>
                            Inventory
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#reports" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            Reports
                            <div class="sb-sidenav-collapse-arrow">
                                <i class="fas fa-angle-down"></i>
                            </div>
                        </a>
                        <div class="collapse bg-secondary" id="reports" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url('bookings/daily_reports') ?>">Daily Report</a>
                                <a class="nav-link" href="<?= base_url('bookings/monthly_reports') ?>">Monthly Report</a>
                                <a class="nav-link" href="<?= base_url('bookings/per_room_reports') ?>">Per Room</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">