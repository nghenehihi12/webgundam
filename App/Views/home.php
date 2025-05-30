<?php
$currentPage = 'home';
include_once 'Layout/homeheader.php';

// Ensure required variables are defined to avoid undefined variable errors
if (!isset($productList)) $productList = [];
if (!isset($assets)) $assets = '';
if (!isset($baseURL)) $baseURL = '';

// Lọc sản phẩm theo grade nếu có tham số grade trên URL
$grade = isset($_GET['grade']) ? $_GET['grade'] : '';
if ($grade) {
    $productList = array_filter($productList, function ($product) use ($grade) {
        return isset($product['category']) && $product['category'] === $grade;
    });
}
?>

<?php if ($grade): ?>
    <h2 class="text-center mt-4 mb-2">
        Sản phẩm thuộc dòng <span class="text-danger"><?= htmlspecialchars($grade) ?></span>
    </h2>
<?php else: ?>
    <h2 class="text-center mt-4 mb-2">
        Tất cả sản phẩm
    </h2>
<?php endif; ?>

<!-- Section: Products -->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-1">
        <div class="row gx-4 gx-lg-5 gy-4 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($productList as $product): ?>
                <div class="col mb-3">
                    <div class="card h-100">
                        <img class="card-img-top" src="<?= $assets . $product['image'] ?>" alt="<?= $product['Name'] ?>" />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"> <?= $product['Name'] ?></h5>
                                <?= number_format($product['Price'], 0) ?> VNĐ
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="<?= $baseURL ?>product/detail/<?= $product['Id'] ?>">Xem chi tiết</a>
                            </div>
                        </div>
                        <div class="text-center">
                            <form method="post" action="<?= $baseURL . 'cart/add' ?>">
                                <input type="hidden" name="product_id" value="<?= $product['Id'] ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include_once 'Layout/homeFooter.php';
?>