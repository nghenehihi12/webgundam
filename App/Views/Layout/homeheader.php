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

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Gundam</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= $base ?>/assets/assets/favicon.ico" />

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Core theme CSS -->
    <link href="<?= $base ?>assets/css/styles.css" rel="stylesheet" />

    <!-- Thêm link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Thêm link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?= $baseURL ?>home/index">ShopGundam</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">


                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a class="btn btn-outline-dark me-2" href="<?= $baseURL ?>user/logout">
                            <i class="bi-box-arrow-right me-1"></i> Logout
                        </a>
                    <?php else: ?>
                        <a class="btn btn-outline-dark me-2" href="<?= $baseURL ?>user/login">
                            <i class="bi-person-fill me-1"></i> Login
                        </a>
                    <?php endif; ?>


                    <form method="post" action="<?= $baseURL . 'cart/index' ?>"
                        class="d-flex">
                        <button class="btn btn-outline-dark" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                                <?= array_sum(array_column($_SESSION['cart'] ?? [], 'quantity')) ?>
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop Gundam</h1>
                <p class="lead fw-normal text-white-50 mb-0">Shop bán mô hình Gundam uy tín</p>
            </div>
        </div>
    </header>