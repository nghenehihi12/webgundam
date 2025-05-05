<?php

require_once __DIR__ . '/../Model/ChartModel.php';


class AdminController
{
    public function dashboard()
    {
        $chartModel = new ChartModel();
        $earnings = $chartModel->getEarningsPerMonth();
        // var_dump($earnings);
        // die;

        // Load giao diện dashboard
        include './App/Views/Admin/dashboard.php';
    }
}
