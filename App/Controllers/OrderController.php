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

        $config = require __DIR__ . '/../../config.php';

        // Kiểm tra nếu người dùng chưa đăng nhập (chưa có user_id trong session)
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Bạn cần đăng nhập trước khi thanh toán.';
            header('Location: ' . $config['baseURL'] . 'cart/index');
            exit;
        }

        // Nếu đã đăng nhập, tiếp tục xử lý đơn hàng
        $orderModel = new OrderModel();
        $productModel = new ProductModel();
        $total = 0;

        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $_SESSION['error'] = 'Giỏ hàng của bạn đang trống.';
            header('Location: ' . $config['baseURL'] . 'cart/index');
            exit;
        }

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

        $config = require __DIR__ . '/../../config.php';

        if (!isset($_SESSION['user_id'])) {
            header("Location: " . $config['baseURL'] . "user/login");
            exit;
        }

        // Lấy danh sách đơn hàng của người dùng
        $orderModel = new OrderModel();
        $orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

        $baseURL = $config['baseURL'];
        include './App/Views/Order/history.php';
    }

    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'];
            $status = $_POST['status'];
            if (isset($status) && !empty($status)) {
                $orderModel = new OrderModel();
                $orderModel->updateStatus($orderId, $status);
            }
            $config = require __DIR__ . '/../../config.php';
            header('Location: ' . $config['baseURL'] . 'admin/orderList');
            exit();
        }
    }
}
