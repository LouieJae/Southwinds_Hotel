<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>COMPANY</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/store.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS (version 5.15.4) from CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- DataTables Bootstrap 5 CSS (version 1.13.6) from CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Toastr CSS (latest version) from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- jQuery (version 3.6.0) from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JavaScript (latest version) from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css?family=IBM Plex Sans:700|IBM Plex Sans:400');

        body {
            font-family: 'IBM Plex Sans';
            font-weight: 400;
            background-color: #454d55;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'IBM Plex Sans';
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
            background-color: #28282B;
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
            background-color: #ffffff;
            padding-top: 5px;
            /* Adjusted to accommodate the navbar */
            transition: left 0.3s ease;
            /* Add smooth transition effect */
            z-index: 1;
            /* Ensure the sidebar is below the toggle button */
            box-shadow: 10px 0 6px rgba(0, 0, 0, 0.1);
            /* Add shadow to the sidebar */
        }

        .sidebar a {
            padding: 10px;
            padding-left: 20px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            font-weight: bolder;
        }

        .sidebar a i {
            margin-right: 10px;
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
            border-left: 8px solid #000;
            /* Adjust color and size as needed */
            margin-left: 85px;
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
            background-color: #28282B;
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
            background-color: transparent !important;
            color: inherit !important;
        }

        .custom-dropdown.open .custom-dropdown-content {
            display: block;
        }

        .sidebar a.active {
            color: #ffffff;
            /* Active link text color */
            background-color: #28282B;
            /* Active link background color */
        }
    </style>
</head>

<body>

    <!-- Top Navbar -->
    <div class="top-navbar">
        <div class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </div>
        <div>
            <div class="dropdowns">
                <a class="dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item text-dark" href="#">User Profile</a>
                    <a class="dropdown-item text-dark" href="#">Settings</a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item text-dark" href="<?= base_url('port') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="sidebar">

        <a href="<?= base_url('main') ?>" class="brand-link d-flex align-items-center exclude-from-highlight">
            <img src="<?php echo base_url('assets/images/store.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 t" style="opacity: .8; max-width: 100%; max-height: 60px;">
        </a>

        <hr class="sidebar-divider">
        <a href="<?= base_url('main/user') ?>"><i class="fas fa-user"></i> User</a>
        <a href="<?= base_url('main/supplier') ?>"><i class="fas fa-truck"></i> Supplier</a>
        <a href="<?= base_url('main/product') ?>"><i class="fas fa-box"></i> Product</a>

        <!-- Purchase Dropdown -->
        <div class="custom-dropdown" id="purchaseDropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="">
                <i class="fas fa-shopping-cart"></i> Purchase
                <div class="custom-caret"></div>
            </a>
            <div class="custom-dropdown-content">
                <a class="dropdown-item text-white" href="<?= base_url('main/purchase_order') ?>">Purchase Request</a>
                <a class="dropdown-item text-white" href="<?= base_url('main/goods_received') ?>">Goods Received</a>
                <a class="dropdown-item text-white" href="<?= base_url('main/goods_return') ?>">Goods Return</a>
            </div>
        </div>

        <!-- Inventory Dropdown -->
        <div class="custom-dropdown" id="inventoryDropdown">
            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="">
                <i class="fas fa-archive"></i> Inventory
                <div class="custom-caret"></div>
            </a>
            <div class="custom-dropdown-content">
                <a class="dropdown-item text-white" href="<?= base_url('main/inventory_adjustment') ?>">Inventory Adjustment</a>
                <a class="dropdown-item text-white" href="<?= base_url('main/inventory_ledger') ?>">Inventory Ledger</a>
            </div>
        </div>

        <a href="<?= base_url('main/stock_requisition') ?>"><i class="fas fa-clipboard-list"></i> Stock Requisition</a>
        <a href="<?= base_url('main/sales') ?>"><i class="fas fa-shopping-basket"></i> Sales</a>
        <a href="<?= base_url('main/pos') ?>"><i class="fas fa-cash-register"></i> POS</a>
        <a href="<?= base_url('main/reports') ?>"><i class="fas fa-chart-bar"></i> Reports</a>
        <a href="<?= base_url('main/backup') ?>"><i class="fas fa-database"></i> Backup & Restore</a>
    </div>


    <div class="content">