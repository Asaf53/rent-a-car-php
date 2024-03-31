<?php
session_start();
include_once('database.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <link rel="shortcut icon" href="assets/img/logo/logo.png" type="image/png">
    <title>Rent a Car</title>
</head>

<body>
    <nav class="navbar navbar-expand-md px-lg-5 p-3 bg-white text-danger">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/logo/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarToggler">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="cars.php">Cars</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <div class="ms-auto">
                    <ul class="navbar-nav mb-lg-0 d-flex flex-row align-items-center justify-content-center">
                        <li class="nav-item me-3"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link border border-outline-primary rounded-0 py-2 px-3"
                                href="register.php">Sign In</a></li>
                    </ul>
                    <!-- <div class="dropdown-center bg-white shadow-sm p-2 rounded-5">
                        <button class="btn btn-transparent m-0 p-0 border-0 d-flex align-items-center" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-user mb-0 pb-0 h3"></i>
                        </button>
                        <ul class="dropdown-menu mb-0 pb-0">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </nav>
