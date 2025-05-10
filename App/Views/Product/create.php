<?php include_once __DIR__ . '/../Layout/adminHeader.php'; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm mới</h6>
    </div>
    <div class="card-body">
        <form action="store" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Ảnh sản phẩm</label>
                <input type="file" name="image" id="image" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
            <a href="index" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>




<?php include_once __DIR__ . '/../Layout/adminFooter.php'; ?>