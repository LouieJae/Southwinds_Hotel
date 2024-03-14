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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Raleway&display=swap');

        body {
            font-family: 'Raleway', sans-serif;
            font-weight: 400;
            background-color: #F3EDC8;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Raleway', sans-serif;
            font-weight: 700;
        }

        html {
            font-size: 100%;
        }

        /* 16px */

        h1 {
            font-size: 4.210rem;
            color: #fff;
            /* 67.36px */
        }

        h2 {
            font-size: 3.158rem;
            /* 50.56px */
        }

        h3 {
            font-size: 2.369rem;
            color: #000;
            /* 37.92px */
        }

        h4 {
            font-size: 1.777rem;
            color: #fff;
            /* 28.48px */
        }

        h5 {
            font-size: 1.333rem;
            /* 21.28px */
        }

        small {
            font-size: 0.750rem;
            /* 12px */
        }

        /* For Webkit-based browsers (Chrome, Safari) */
        ::-webkit-scrollbar {
            width: 12px;
            /* Width of the scrollbar */
        }

        ::-webkit-scrollbar-track {
            background: #fff;
            /* Color of the track */
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            /* Color of the thumb */
            border-radius: 6px;
            /* Rounded corners */
        }

        /* Top Navbar Styles */
        .top-navbar {
            background-color: #7D0A0A;
            padding: 15px;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
            /* Add shadow to the top navbar */
            z-index: 2;
            /* Ensure the toggle button is above the sidebar */
        }

        .top-navbar a {
            color: #ffffff;
            text-decoration: none;
            margin-right: 15px;
        }

        .toggle-btn {
            font-size: 24px;
            color: white;
            cursor: pointer;
            margin-left: 260px;
            z-index: 2;
            /* Ensure the toggle button is above the sidebar */
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            /* Adjusted to initially show the sidebar */
            background-color: #EAD196;
            padding-top: 5px;
            /* Adjusted to accommodate the navbar */
            transition: left 0.3s ease;
            /* Add smooth transition effect */
            z-index: 1;
            /* Ensure the sidebar is below the toggle button */
        }

        .sidebar a {
            padding: 10px;
            padding-left: 20px;
            text-decoration: none;
            font-size: 17px;
            color: black;
            display: block;
            font-weight: bolder;
        }

        .sidebar a i {
            margin-right: 5px;
            /* Adjust the margin as needed */
        }

        .content {
            margin-left: 250px;
            /* Adjusted to match the initial state of the sidebar */
            padding: 16px;
            transition: margin-left 0.3s ease;
            /* Add smooth transition effect */
        }

        .sidebar-divider {
            border-top: 3px solid #384042;
            /* Line color */
            margin: 1px;
            /* Adjust as needed for spacing */
        }

        /* Custom Dropdown Styles */
        .custom-dropdown {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .custom-dropdown a.dropdown-toggle::after {
            display: none;
            /* Hide the default Bootstrap caret */
        }

        .custom-dropdown .custom-caret {
            display: inline-block;
            width: 0;
            height: 0;
            vertical-align: middle;
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
            border-left: 7px solid #000;

            margin-left: 5px;
            /* Adjust color and size as needed */
            /* Adjust the margin to increase the distance */
            transition: transform 0.3s ease;
            /* Add transition for arrow effect */
        }

        .custom-dropdown.open .custom-caret {
            transform: rotate(90deg);
            /* Rotate arrow for open state */
        }

        .custom-dropdown-content {
            display: none;
            position: absolute;
            background-color: #BF3131;
            /* Adjust background color as needed */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            width: 250px;
            /* Set the width to match the sidebar */
        }

        .custom-dropdown.open .custom-dropdown-content {
            display: block;
        }

        .custom-dropdown-content a.dropdown-item:hover {
            background-color: gray;
            color: #fff;
        }

        .custom-dropdown.open .custom-dropdown-content {
            display: block;
        }

        .sidebar a.active {
            color: #ffffff;
            /* Active link text color */
            background-color: #7D0A0A;
            /* Active link background color */
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <div class=" top-navbar">
        <div class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        <div>
            <div class="dropdowns">
                <a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="user-greeting">Hi,
                        <?= ucfirst($this->session->userdata('UserLoginSession')['username']) ?>! &nbsp;&nbsp;
                    </span>
                    <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-dark" href="#">User Profile</a>
                    <a class="dropdown-item text-dark" href="#">Settings</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item text-dark" href="<?= base_url('bookings/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="sidebar">
        <a href="<?= base_url('bookings/dashboard') ?>" class="brand-link d-flex align-items-center exclude-from-highlight">
            <img src="<?php echo base_url('assets/images/southwinds.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 t" style="opacity: .8; max-width: 100%; max-height: 60px;">
        </a>
        <hr class="sidebar-divider">
        <a href="<?= base_url('bookings/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

        <div class="custom-dropdown" id="inventoryDropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="">
                <i class="fas fa-bed"></i> Room Accommodations
                <div class="custom-caret"></div>
            </a>
            <div class="custom-dropdown-content">
                <a class="dropdown-item text-white" href="<?= base_url('bookings/room_accommodations') ?>">Rooms</a>
                <a class="dropdown-item text-white" href="<?= base_url('bookings/add_on') ?>">Check Ins</a>
            </div>
        </div>
        <a href="<?= base_url('bookings/product') ?>"><i class="fas fa-archive"></i> Inventory</a>
        <div class="custom-dropdown" id="purchaseDropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="">
                <i class="fas fa-chart-line"></i> Reports
                <div class="custom-caret"></div>
            </a>
            <div class="custom-dropdown-content">
                <a class="dropdown-item text-white" href="<?= base_url('bookings/daily_reports') ?>">Daily Report</a>
                <a class="dropdown-item text-white" href="<?= base_url('bookings/monthly_reports') ?>">Monthly Report</a>
                <a class="dropdown-item text-white" href="<?= base_url('bookings/per_room_reports') ?>">Per Room</a>
            </div>
        </div>
        <hr>
    </div>

    <div class="content">