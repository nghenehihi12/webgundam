<?php
// Phân trang
$ordersPerPage = 10;
$totalOrders = count($orders);
$totalPages = ceil($totalOrders / $ordersPerPage);
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$start = ($page - 1) * $ordersPerPage;
$ordersToShow = array_slice($orders, $start, $ordersPerPage);
?>

<?php include_once __DIR__ . '/../Layout/adminHeader.php'; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Mã hóa đơn</th>
                        <th>User ID</th>
                        <th>Tổng tiền (VND)</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stt = $start + 1;
                    if (!empty($ordersToShow)):
                        foreach ($ordersToShow as $order):
                    ?>
                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><?= htmlspecialchars($order['id']) ?></td>
                                <td><?= htmlspecialchars($order['user_id']) ?></td>
                                <td><?= number_format($order['total_amount'], 0, ',', '.') ?></td>
                                <td>
                                    <?php
                                    $status = $order['status'];
                                    $badgeClass = 'secondary';
                                    if ($status == 'Đang xử lý') $badgeClass = 'warning';
                                    elseif ($status == 'Đã giao') $badgeClass = 'success';
                                    elseif ($status == 'Đã hủy') $badgeClass = 'danger';
                                    ?>
                                    <span class="badge bg-<?= $badgeClass ?> text-white">
                                        <?= htmlspecialchars($status) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($order['order_date'] ?? '') ?></td>
                                <td>
                                    <form method="post" action="<?= $baseURL ?>order/updateOrderStatus">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <select name="status" class="form-select form-select-sm d-inline w-auto">
                                            <option value="Đặt hàng" <?= $order['status'] == 'Đặt hàng' ? 'selected' : ''; ?>>Đặt hàng</option>
                                            <option value="Đang xử lý" <?= $order['status'] == 'Đang xử lý' ? 'selected' : ''; ?>>Đang xử lý</option>
                                            <option value="Đã giao" <?= $order['status'] == 'Đã giao' ? 'selected' : ''; ?>>Đã giao</option>
                                            <option value="Đã hủy" <?= $order['status'] == 'Đã hủy' ? 'selected' : ''; ?>>Đã hủy</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    else:
                        ?>
                        <tr>
                            <td colspan="7">Không có hóa đơn nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>

<?php include_once __DIR__ . '/../Layout/adminFooter.php'; ?>