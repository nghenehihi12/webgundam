<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CartController
{
    public function index()
    {
        // Xử lý xóa giỏ hàng nếu có yêu cầu POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_cart'])) {
            unset($_SESSION['cart']);
            $config = require 'config.php';

            $baseURL = $config['baseURL'];
            header('Location:' . $baseURL . '/cart/index'); // hoặc $baseURL . "cart" nếu cần redirect đầy đủ
            exit;
        }

        require_once './App/Model/ProductModel.php';
        $productModel = new ProductModel();

        $cartItems = [];

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $product = $productModel->getProductById($item['product_id']);
                $product['quantity'] = $item['quantity'];
                $cartItems[] = $product;
            }
        }

        include './App/Views/cart/index.php';
    }


    public function add()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['product_id'])
        ) {
            $productId = $_POST['product_id'];

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$productId] = [
                    'product_id' => $productId,
                    'quantity' => 1
                ];
            }
            $config = require 'config.php';

            $baseURL = $config['baseURL'];


            header('Location:' . $baseURL . '/home/index');
            exit;
        }
    }
}
