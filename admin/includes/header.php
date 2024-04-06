<?php
session_start();
include_once('database.php');
if (isset($_GET['action']) && ($_GET['action'] === 'logout')) {
    unset($_SESSION['is_loggedin']);
    unset($_SESSION['user_id']);
    unset($_SESSION['email']);
    unset($_SESSION['fullname']);
    header("Location: ../login.php");
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.4/dist/bootstrap-table.min.css">
</head>


<body id="reportsPage">
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] !== 'admin')) {
        header('Location: error.html');
        die();
    } else { ?>
        <div class="" id="home">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-xl navbar-light bg-light">
                            <a class="navbar-brand" href="index.php">
                                <i class="fas fa-3x fa-tachometer-alt tm-site-icon"></i>
                                <h1 class="tm-site-title mb-0">Dashboard</h1>
                            </a>
                            <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php">Dashboard
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="cars.php">Cars / Location</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="accounts.php">Accounts</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex" href="?action=logout">
                                            <i class="far fa-user mr-2 tm-logout-icon"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            <?php }; ?>