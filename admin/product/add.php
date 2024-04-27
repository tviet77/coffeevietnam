<?php
$sql = 'select * from product_categories';
$result = mysqli_query($conn, $sql);

while ($itemCate = mysqli_fetch_assoc($result)) {
    $categories[] = $itemCate;

}
?>

<div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Sản phẩm mới
                        </h2>
                    </div>
                </div>
            </div>
        </div><div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12">
                        <form id="form-add-category" class="card" method="post" action="../admin/product/handle.php" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">Thêm mới danh mục</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Tên sản phẩm:
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" name="product_name" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Danh mục sản phẩm
                                    </label>
                                    <select type="text" class="form-select" id="select-option-cate" name="product_category">
                                        <?php foreach ($categories as $itemCate) { ?>
                                            <option value="<?= $itemCate['id']; ?>" >
                                                <?= $itemCate['category_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Mô tả
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" name="product_description" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Chi tiết
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" name="product_detail" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Ảnh 1</label>
                                    <input type="file" id="myFile" name="product-img1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Ảnh 2</label>
                                    <input type="file" id="myFile" name="product-img2">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Ảnh 3</label>
                                    <input type="file" id="myFile" name="product-img3">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Slug (Đường dẫn của sản phẩm):</label>
                                    <p>Đường dẫn link sẽ tự động được tạo giống với tên sản phẩm...
                                    </p>
                                    <div>
                                        <input type="text" class="form-control" disabled="" name="product_slug">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Giá Size Nhỏ</label>
                                    <input type="text" class="form-control" name="price_small" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Giá Size Vừa</label>
                                    <input type="text" class="form-control" name="price_medium" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Giá Size Lớn</label>
                                    <input type="text" class="form-control" name="price_large" required>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input type="submit" class="btn btn-primary " name="btn-add-product" value="Thêm mới">
                                <a href="#" class="btn btn-green btn-primary">Trở về</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
