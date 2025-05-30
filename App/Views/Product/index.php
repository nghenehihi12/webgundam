<?php include_once __DIR__ . '/../Layout/adminHeader.php'; ?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Grade</th>
                        <th>Product Name</th>
                        <th>Price (VND)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productList as $item): ?>
                        <tr>
                            <td><?= $item['Id'] ?></td>
                            <td>
                                <img src="<?= $assets . $item['image'] ?>" alt="<?= $item['Name'] ?>" style="width:48px; height:48px; object-fit:contain;">
                            </td>
                            <td><?= $item['category'] ?></td>
                            <td><?= $item['Name'] ?></td>
                            <td><?= number_format($item['Price'], 0, ',', '.') ?></td>
                            <td>
                                <form action="delete" method="POST">
                                    <input type="hidden"
                                        name="ProductID"
                                        value="<?= $item['Id'] ?>" />
                                    <button type="submit"
                                        style="border: none; background: none; cursor: pointer;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include_once __DIR__ . '/../Layout/adminFooter.php'; ?>