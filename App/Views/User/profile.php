<?php
$config = require 'config.php';
$baseURL = $config['baseURL'];

if (session_status() === PHP_SESSION_NONE) session_start();

$username = $_SESSION['username'] ?? '';
$fullname = $_SESSION['fullname'] ?? '';
$email    = $_SESSION['email'] ?? '';
?>

<?php include './App/Views/Layout/homeHeader.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Thông tin tài khoản</h2>

    <div class="card p-4 shadow-sm mb-5">
        <div class="mb-3">
            <label class="form-label fw-bold">Tên đăng nhập:</label>
            <div><?= htmlspecialchars($username) ?></div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Họ tên:</label>
            <div><?= htmlspecialchars($fullname) ?></div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Email:</label>
            <div><?= htmlspecialchars($email) ?></div>
        </div>
    </div>

    <!-- Bọc toàn bộ phần đổi mật khẩu trong thẻ card -->
    <div class="card p-4 shadow-sm mt-4">
        <h4 class="mb-3">Đổi mật khẩu</h4>

        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= $baseURL ?>user/changePassword">
            <div class="mb-3">
                <label class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">✔ Cập nhật mật khẩu</button>
        </form>
    </div>

    <div class="mt-4 text-end">
        <a href="<?= $baseURL ?>user/logout" class="btn btn-danger">
            <i class="bi bi-box-arrow-right me-1"></i> Đăng xuất
        </a>
    </div>


    <?php include './App/Views/Layout/homeFooter.php'; ?>