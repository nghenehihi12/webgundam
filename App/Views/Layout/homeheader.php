<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = $config['assets'];
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ShopLacLoi</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= $baseURL ?>Assets/css/styles.css" rel="stylesheet" />
</head>

<?php
$currentPage = basename($_SERVER['REQUEST_URI']);
?>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top " style="background-color: #343a40;">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?= $baseURL ?>home/index">ShopLacLoi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= $baseURL . 'home/index' ?>">Shop it</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $baseURL . 'user/contact' ?>">Liên hệ</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Grade Gundam</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?= $baseURL . 'home/index' ?>">All Grade</a></li>
                            <li><a class="dropdown-item" href="<?= $baseURL . 'home/index?grade=HG' ?>">HG</a></li>
                            <li><a class="dropdown-item" href="<?= $baseURL . 'home/index?grade=MG' ?>">MG</a></li>
                            <li><a class="dropdown-item" href="<?= $baseURL . 'home/index?grade=PG' ?>">PG</a></li>
                            <li><a class="dropdown-item" href="<?= $baseURL . 'home/index?grade=RG' ?>">RG</a></li>


                        </ul>
                    </li>

                </ul>

                <div class="d-flex align-items-center">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                    ?>
                        <div class="nav-item dropdown me-3">
                            <a class="nav-link dropdown-toggle text-white" id="navbarDropdownProfile" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person fs-4 text-white"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                                <li><a class="dropdown-item" href="<?= $baseURL ?>user/profile"><?= $_SESSION['username'] ?></a></li>
                                <li><a class="dropdown-item" href="<?= $baseURL ?>order/history">Lịch sử đơn hàng</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="<?= $baseURL ?>user/logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php
                    } else {
                    ?>
                        <a class="btn btn-outline-light me-3" href="<?= $baseURL ?>user/login">Login</a>
                    <?php
                    }
                    ?>

                    <form method="post" action="<?= $baseURL . 'cart/index' ?>" class="d-flex ms-2">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                                <?= array_sum(array_column($_SESSION['cart'] ?? [], 'quantity')) ?>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
    </nav>

    <!-- Header
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop Gundam</h1>
                <p class="lead fw-normal text-white-50 mb-0">Shop bán mô hình Gundam uy tín</p>
            </div>
        </div>
    </header> -->
    <div class="wrapper">