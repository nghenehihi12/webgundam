<?php
require_once __DIR__ . '/../../Core/database.php';

class ChartModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getEarningsPerMonth()
    {
        $sql = "SELECT MONTH(order_date) as month, SUM(total_amount) as total
                FROM orders
                WHERE status = 'Đã giao'
                GROUP BY MONTH(order_date)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Khởi tạo mảng 12 tháng với giá trị 0
        $earnings = array_fill(1, 12, 0);
        foreach ($results as $row) {
            $earnings[(int)$row['month']] = (float)$row['total'];
        }
        // Đảm bảo trả về mảng từ tháng 1 đến 12
        return $earnings;
    }
}
