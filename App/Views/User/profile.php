<?php
$config = require 'config.php';
$baseURL = $config['baseURL'];

if (session_status() === PHP_SESSION_NONE) session_start();

// Giả sử bạn đã lưu dữ liệu người dùng trong session khi login
$username = $_SESSION['username'] ?? '';
$fullname = $_SESSION['fullname'] ?? '';
$email    = $_SESSION['email'] ?? '';
$password = $_SESSION['password'] ?? ''; // Có thể đã lưu dạng hash

// Để hiển thị password đã hash, ta chỉ hiển thị *** hoặc cố định chuỗi 8*
$password_display = str_repeat('*', 8);
?>

<?php include './App/Views/Layout/homeHeader.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Thông tin tài khoản</h2>
    <div class="card p-4 shadow-sm">
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
        <div class="mb-3">
            <label class="form-label fw-bold">Mật khẩu:</label>
            <div class="d-flex align-items-center">
                <input type="password" class="form-control me-2" value="********" readonly style="width: 200px;">
                <a href="<?= $baseURL ?>user/changePassword" class="btn btn-sm btn-outline-primary">Đổi mật khẩu</a>
            </div>
        </div>
        <div class="mb-3">
            <a class="btn btn-outline-dark me-2" href="<?= $baseURL ?>user/logout">
                <i class="bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>

    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password-field');
        if (input.type === 'password') {
            input.type = 'text';
            input.value = '<?= $password ?>'; // Không khuyến khích với password hash
        } else {
            input.type = 'password';
            input.value = '<?= $password_display ?>';
        }
    }
</script>







<?php include './App/Views/Layout/homeFooter.php'; ?>