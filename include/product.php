<?php
    $productSlug = $_GET['san-pham'];
    $sql = "select * from products where slug ='$productSlug'";
    $result = mysqli_query($conn, $sql);
    $rowProduct = mysqli_fetch_assoc($result);
?>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">

                <div class="home-slider owl-carousel">
                    <?php if (!empty($rowProduct["img1"])): ?>
                        <div class="slider-item" style="background-image: url(<?= isset($rowProduct["img1"]) ? '../' . PATH_URL_IMG_PRODUCT . "/" . $rowProduct["img1"] : '../' . PATH_URL_IMG_PRODUCT . "/16-150x150.jpg" ?>);">
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            </div>
            <form id="add-to-cart-form" class="col-lg-6 product-details pl-md-5 ftco-animate" method="post">
                <input type="hidden" name="id_product_entry" value="<?= $rowProduct['id'] ?>">
                <h3 class="product-name" data-product-id="<?= $rowProduct['id'] ?>"><?= $rowProduct['product_name'] ?></h3>
                <p class="product-price"><span id="value-price"></span><span style="color: greenyellow" class="ml-2">VND</span></p>
                <p><?= $rowProduct['description'] ?></p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="form-group d-flex">
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <?php
                                    $sql_price = "SELECT pe.price,s.id, s.name_size FROM product_entry pe INNER JOIN size s ON pe.size_id = s.id WHERE pe.product_id = 2";
                                    $result_price = mysqli_query($conn, $sql_price);

                                    while ($row_price = mysqli_fetch_assoc($result_price)) {
                                        $prices[] = $row_price;
                                    }
                                ?>
                                <select name="product-option-size" id="product-option-size" class="form-control">
                                    <?php
                                        foreach ($prices as $price) {
                                            echo '<option data-price="' . $price['price'] . '" value="' . $price['price'] . '">' . $price['name_size'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="icon-plus"></i>
	                 </button>
	             	</span>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary py-3 px-5" name="btn-add-to-cart" value="Thêm vào giỏ hàng">
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-start" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Chi tiết sản phẩm</a>

                            <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Thông tin khác</a>

                            <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Bình luận</a>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center">

                        <div class="tab-content ftco-animate" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <div class="menu-wrap">
                                            <div class="text">
                                                <p><?= $rowProduct['product_detail']  ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p>Building</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p>Building</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading mb-4">Khám phá</span>
                <h2 class="mb-4">Sản phẩm tương tự</h2>
            </div>
        </div>
        <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            while ($productItem = mysqli_fetch_assoc($result)) {
                $productList[] = $productItem;
            }

        ?>
        <div class="row">
            <?php for ($i = 0; $i < min(4, count($productList)); $i++): ?>
                <div class="col-md-3">
                    <div class="menu-entry">
                        <a href="detail_product.php?san-pham=<?= $productList[$i]['slug'] ?>" class="img" style="background-image: url(<?= isset($productList[$i]['img1']) ? '../' . PATH_URL_IMG_PRODUCT . "/" . $productList[$i]['img1'] : '../' . PATH_URL_IMG_PRODUCT . "/16-150x150.jpg"; ?>);"></a>
                        <div class="text text-center pt-4">
                            <h3><a href="#"><?php echo $productList[$i]['product_name']; ?></a></h3>
                            <p><?php echo $productList[$i]['description']; ?></p>
                            <p><a href="detail_product.php?san-pham=<?= $productList[$i]['slug'] ?>" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>

    </div>
</section>

