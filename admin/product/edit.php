
<?php

if(isset($_GET['product_id'])) {
    $idProduct = $_GET['product_id'];

    $sql = "SELECT * FROM products where id = $idProduct";

    $result = mysqli_query($conn, $sql);
    $itemProduct = mysqli_fetch_assoc($result);

}

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
                       Sản phẩm <?= $itemProduct['product_name']; ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    <form id="form-edit-product" class="card" method="post" action="../admin/product/handle.php" enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa sản phẩm</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Tên sản phẩm:
                                </label>
                                <div>
                                    <input type="text" class="form-control" name="product_name" value="<?php echo $itemProduct['product_name']; ?>" required>
                                    <input type="hidden" value="<?= $_GET['product_id']; ?>" name="product_id">
                                </div>
                            </div>
                            <div class="mb-3">
                                        <label class="form-label">Danh mục sản phẩm
                                        </label>
                                        <select type="text" class="form-select" id="select-option-cate" name="product_category">
                                            <?php foreach ($categories as $itemCate) { ?>
                                                <option value="<?= $itemCate['id']; ?>" <?php if($itemCate['id'] == $itemProduct['category_id']) echo 'selected'; ?>>
                                                    <?= $itemCate['category_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Mô tả</label>
                                <div>
                                    <input type="text" class="form-control" name="product_description" value="<?= $itemProduct['description'];?>" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Chi tiết</label>
                                <div>
                                    <input type="text" class="form-control" name="product_detail" value="<?= $itemProduct['product_detail'];?>" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Ảnh 1</label>
                                <div class="preview-image-wrapper ">
                                    <img class="img-product-ad" src="<?= !empty($itemProduct["img1"]) ? '../' . PATH_URL_IMG_PRODUCT . "/" . $itemProduct["img1"] : '../' . PATH_URL_IMG_PRODUCT . "/16-150x150.jpg" ?>
" alt="" srcset="">
                                    <a class="btn_remove_image" title="Remove image">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                                <input type="file" id="myFile" name="up-load-img1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Ảnh 2</label>
                                <div class="preview-image-wrapper ">
                                    <img class="img-product-ad" src="<?= !empty($itemProduct["img2"]) ? '../' . PATH_URL_IMG_PRODUCT . "/" . $itemProduct["img2"] : '../' . PATH_URL_IMG_PRODUCT . "/16-150x150.jpg" ?>
" alt="" srcset="">
                                    <a class="btn_remove_image" title="Remove image">
                                        <i class="fa fa-times"></i>
                                    </a>

                                </div>
                                <input type="file" id="myFile" name="up-load-img2">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Ảnh 3</label>
                                <div class="preview-image-wrapper ">
                                    <img class="img-product-ad" src="<?= !empty($itemProduct["img3"]) ? '../' . PATH_URL_IMG_PRODUCT . "/" . $itemProduct["img3"] : '../' . PATH_URL_IMG_PRODUCT . "/16-150x150.jpg" ?>
" alt="" srcset="">
                                    <a class="btn_remove_image" title="Remove image">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                                <input type="file" id="myFile" name="up-load-img3">
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input type="submit" class="btn btn-primary " name="btn-edit-product" value="Cập nhật">
                            <a href="#" class="btn btn-green btn-primary">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
