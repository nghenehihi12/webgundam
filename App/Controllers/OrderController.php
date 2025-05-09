<?php
require_once __DIR__ . '/../Model/OrderModel.php';
require_once __DIR__ . '/../Model/ProductModel.php';

class OrderController
{
    public function checkout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Kiểm tra nếu người dùng chưa đăng nhập (chưa có user_id trong session)
        if (!isset($_SESSION['user_id'])) {
            // Lưu thông báo lỗi vào session để hiển thị trên trang đăng nhập
            $_SESSION['error'] = 'Bạn cần đăng nhập trước khi thanh toán.';

            // Chuyển hướng về trang đăng nhập
            header('Location: ' . $GLOBALS['config']['baseURL'] . 'cart/index');
            exit;
        }

        // Nếu đã đăng nhập, tiếp tục xử lý đơn hàng
        $orderModel = new OrderModel();
        $productModel = new ProductModel();
        $total = 0;

        foreach ($_SESSION['cart'] as $item) {
            $product = $productModel->getProductById($item['product_id']);
            $total += $product['Price'] * $item['quantity'];
        }

        $orderId = $orderModel->createOrder($_SESSION['user_id'], $total);

        foreach ($_SESSION['cart'] as $item) {
            $product = $productModel->getProductById($item['product_id']);
            $orderModel->addOrderItem($orderId, $item['product_id'], $item['quantity'], $product['Price']);
        }

        unset($_SESSION['cart']);
        include './App/Views/Order/checkout_success.php';
    }


    public function history()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $config = require './config.php';
            header("Location: " . $config['baseURL'] . "user/login");
            exit;
        }

        // Lấy danh sách đơn hàng của người dùng
        $orderModel = new OrderModel();
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

        $config = require './config.php';
        $baseURL = $config['baseURL'];

        include './App/Views/Order/history.php';
    }
}
