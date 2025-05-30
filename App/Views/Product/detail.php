<?php include './App/Views/Layout/homeHeader.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row g-4 align-items-start">
                <!-- Card hình ảnh sản phẩm -->
                <div class="col-md-5">
                    <div class="card shadow-lg border-0 h-100 text-center p-4">
                        <img src="<?= $assets . $product['image'] ?>" class="img-fluid rounded shadow" alt="<?= $product['Name'] ?>" style="max-height:350px;object-fit:contain;" />
                    </div>
                </div>
                <!-- Card thông tin sản phẩm -->
                <div class="col-md-7">
                    <div class="card shadow-lg border-0 h-100 p-4">
                        <h2 class="mb-1 fw-bold"><?= htmlspecialchars($product['Name']) ?></h2>
                        <h4 class="text-danger mb-4"><?= number_format($product['Price'], 0, ',', '.') ?> VND</h4>
                        <form method="post" action="<?= $baseURL ?>cart/add">
                            <input type="hidden" name="product_id" value="<?= $product['Id'] ?>">
                            <button type="submit" class="btn btn-dark btn-lg mb-4 px-5">Đặt hàng</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Mô tả -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-semibold">Thông tin sản phẩm:</h5>
                    <p class="mt-2"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './App/Views/Layout/homeFooter.php'; ?>