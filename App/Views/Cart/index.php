<?php
$config = require 'config.php';
$base = $config['base'];
$baseURL = $config['baseURL'];
$assets = isset($config['assets']) ? $config['assets'] : '';

include './App/Views/Layout/homeHeader.php';
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hiển thị modal nếu có lỗi
if (isset($_SESSION['error'])): ?>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $_SESSION['error'] ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a href="<?= $baseURL ?>user/login" class="btn btn-primary">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mở Modal khi có thông báo lỗi
        var myModal = new bootstrap.Modal(document.getElementById('loginModal'), {
            keyboard: false
        });
        myModal.show();
    </script>

    <?php unset($_SESSION['error']); // Xoá thông báo sau khi hiển thị 
    ?>
<?php endif; ?>


<!-- Section: Cart -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="mb-4 text-center">🛒 Giỏ hàng của bạn</h2>

        <?php if (empty($cartItems)): ?>
            <div class="alert alert-info text-center">
                Chưa có sản phẩm nào trong giỏ hàng.
            </div>
        <?php else: ?>
            <?php $grandTotal = 0; ?>

            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item):
                        $total = $item['Price'] * $item['quantity'];
                        $grandTotal += $total;
                    ?>
                        <tr>
                            <td><?= $item['Name'] ?></td>
                            <td><?= number_format($item['Price'], 0) ?> VNĐ</td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($total, 0) ?> VNĐ</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-secondary">
                        <th colspan="3" class="text-end">Tổng cộng:</th>
                        <th><?= number_format($grandTotal, 0) ?> VNĐ</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Nút checkout -->
            <div class="text-end">
                <a href="<?= $baseURL ?>order/checkout" class="btn btn-success">🛍️ Tiến hành thanh toán</a>
            </div>
            <!-- Nút xóa giỏ hàng -->
            <form method="post" class=" mt-2 text-end">
                <button type="submit" name="clear_cart" class="btn btn-danger">🗑️ Xóa toàn bộ giỏ hàng</button>
            </form>

        <?php endif; ?>
    </div>
</section>

<?php include './App/Views/Layout/homeFooter.php'; ?>