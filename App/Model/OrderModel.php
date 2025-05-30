<?php
require_once __DIR__ . '/../../Core/database.php';
class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function getAllOrders()
    {
        $stmt = $this->db->prepare("SELECT * FROM orders ORDER BY order_date DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($userId, $totalAmount)
    {
        $sql = "INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, 'Đặt hàng')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $totalAmount]);
        return $this->db->lastInsertId();
    }

    public function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$orderId, $productId, $quantity, $price]);
    }

    public function getOrdersByUserId($userId)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$status, $orderId]);
    }
    public function getOrderCountPerDay($days = 30)
    {
        $stmt = $this->db->prepare("
            SELECT DATE(order_date) as order_day, COUNT(*) as order_count
            FROM orders
            WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL :days DAY)
            GROUP BY order_day
            ORDER BY order_day ASC
        ");
        $stmt->bindValue(':days', $days, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
