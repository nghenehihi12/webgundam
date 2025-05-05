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
                GROUP BY MONTH(order_date)
                ORDER BY month ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $earnings = array_fill(1, 12, 0); // 12 tháng mặc định 0
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $earnings[(int)$row['month']] = (float)$row['total'];
        }

        return $earnings;
    }
}
?>