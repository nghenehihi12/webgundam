<?php
require_once __DIR__ . '/../Model/ProductModel.php';
class ProductController
{
    public function index()
    {
        $product = new ProductModel();
        $productList = $product->getAllProducts();
        include __DIR__ . '/../Views/Product/index.php';
    }
    public function create()
    {
        include __DIR__ . '/../Views/Product/create.php';
    }

    public function delete()
    {
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' &&
            isset($_POST['ProductID'])
        ) {
            $productId = $_POST['ProductID'];
            $product = new ProductModel();
            $product->deleteProduct($productId);
        }
        // Chuyển hướng về trang danh sách
        header("Location:index");
        exit;
    }

    public function store()
    {
        $name = $_POST['name'] ?? '';
        $category = $_POST['category'] ?? ''; // Lấy grade
        $price = $_POST['price'] ?? 0;
        $description = $_POST['description'] ?? '';
        $image = '';

        // Kiểm tra và xử lý upload ảnh
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
            $imageSize = $_FILES['image']['size'];

            if (in_array(strtolower($imageExt), $allowedExts) && $imageSize <= 5 * 1024 * 1024) {
                $image = basename($_FILES['image']['name']);
                $uploadDir = __DIR__ . '/../../assets/images/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image)) {
                    echo "Lỗi khi tải ảnh lên.";
                    exit;
                }
            } else {
                echo "Ảnh không hợp lệ hoặc kích thước quá lớn.";
                exit;
            }
        }

        // Gọi Model để lưu thông tin sản phẩm vào DB
        $product = new ProductModel();
        $product->insertProduct($name, $category, $price, 'images/' . $image, $description);

        // Chuyển hướng về trang danh sách sau khi thêm thành công
        header("Location:index");
        exit;
    }

    public function detail($id)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=productdb", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM products WHERE Id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die('Sản phẩm không tồn tại');
        }

        include './App/Views/Product/detail.php';
    }
}
