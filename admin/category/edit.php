<?php
if(isset($_GET['cate_id'])) {
    $idCategory = $_GET['cate_id'];

    $sql = "SELECT * FROM product_categories where id = $idCategory";

    $result = mysqli_query($conn, $sql);
    $itemCategory = mysqli_fetch_assoc($result);
}
?>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Nhóm danh mục
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    <form id="form-edit-category" class="card" method="post" action="../admin/category/handle.php">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa danh mục</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Tên nhóm danh mục:
                                </label>
                                <div>
                                    <input type="text" class="form-control" name="category_name" value="<?php echo $itemCategory['category_name']; ?>" required>
                                    <input type="hidden" value="<?= $_GET['cate_id']; ?>" name="cate_id">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Slug (Đường dẫn của nhóm danh mục):</label>
                                <p>Đường dẫn link sẽ tự động được tạo giống với tên danh mục...
                                </p>
                                <div>
                                    <input type="text" class="form-control" disabled="" name="category_slug" value="<?= $itemCategory['slug']; ?>">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Mô tả</label>
                                <div>
                                    <input type="text" class="form-control" name="category_description" value="<?= $itemCategory['description'];?>" >
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input type="submit" class="btn btn-primary " name="btn-edit-category" value="Cập nhật">
                            <a href="#" class="btn btn-green btn-primary">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
