<?php

require_once __DIR__ . '/../Model/ChartModel.php';


class AdminController
{
    public function dashboard()
    {
        $chartModel = new ChartModel();
        $earnings = $chartModel->getEarningsPerMonth();
        include './App/Views/Admin/dashboard.php';
    }

    public function orderList()
    {
        require_once __DIR__ . '/../Model/OrderModel.php';
        $orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders(); // Lấy dữ liệu từ model
        include __DIR__ . '/../Views/Admin/orderlist.php'; // Truyền $orders sang view
    }

    public function userList()
    {
        require_once __DIR__ . '/../Model/UserModel.php';
        $userModel = new UserModel();
        $users = $userModel->getAllUsers(); // Lấy danh sách user từ DB
        include __DIR__ . '/../Views/Admin/userlist.php'; // Truyền $users sang view
    }

    public function report()
    {
        require_once __DIR__ . '/../Model/OrderModel.php';
        $orderModel = new OrderModel();
        $ordersPerDay = $orderModel->getOrderCountPerDay(30); // Truyền vào index view

        include __DIR__ . '/../Views/Admin/report.php';
    }
}
