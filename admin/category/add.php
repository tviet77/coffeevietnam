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
        </div><div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-12">
                        <form id="form-add-category" class="card" method="post" action="../admin/category/handle.php">
                            <div class="card-header">
                                <h3 class="card-title">Thêm mới danh mục</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Tên nhóm danh mục:
                                    </label>
                                    <div>
                                        <input type="text" class="form-control" name="category_name" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Slug (Đường dẫn của nhóm danh mục):</label>
                                    <p>Đường dẫn link sẽ tự động được tạo giống với tên danh mục...
                                    </p>
                                    <div>
                                        <input type="text" class="form-control" disabled="" name="category_slug">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Mô tả</label>
                                    <div>
                                        <input type="text" class="form-control" name="category_description">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input type="submit" class="btn btn-primary " name="btn-add-category" value="Thêm mới">
                                <a href="#" class="btn btn-green btn-primary">Trở về</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
