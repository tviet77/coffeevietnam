<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(./assets/images/bg_1.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Chào mừng</span>
                    <h1 class="mb-4">Trải nghiệm thử nghiệm cà phê tốt nhất</h1>
                    <p class="mb-4 mb-md-5">“Nơi đây chúng tôi không chỉ cung ứng những ly cà phê năng lượng tuyệt hảo mà còn cung ứng những giấc mơ.”</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem Menu</a></p>
                </div>

            </div>
        </div>
    </div>

    <div class="slider-item" style="background-image: url(./assets/images/bg_2.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Chào mừng</span>
                    <h1 class="mb-4">Không gian cà phê năng lượng</h1>
                    <p class="mb-4 mb-md-5">“Nơi đây chúng tôi không chỉ cung ứng những ly cà phê năng lượng tuyệt hảo mà còn cung ứng những giấc mơ.”</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem Menu</a></p>
                </div>

            </div>
        </div>
    </div>

    <div class="slider-item" style="background-image: url(./assets/images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Chào mừng</span>
                    <h1 class="mb-4">Trải nghiệm thử nghiệm cà phê tốt nhất</h1>
                    <p class="mb-4 mb-md-5">“Nơi đây chúng tôi không chỉ cung ứng những ly cà phê năng lượng tuyệt hảo mà còn cung ứng những giấc mơ.”</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem Menu</a></p>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading py-3">Khám phá</span>
                <h2 class="mt-5">Đồ uống bán chạy nhất</h2>
                <p>Thưởng thức đồ uống bán chạy nhất</p>
            </div>
        </div>
        <div class="row">
            <?php
            $num_products = 8;
            $sql = "SELECT * FROM products LIMIT $num_products";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                foreach ($result as $product) {
                    // get path image_url
                    $image_url = './' . PATH_URL_IMG_PRODUCT . "/" . $product["img1"]; ?>

                    <div class="col-md-3">
                        <div class="menu-entry">
                            <a href="detail_product.php?san-pham=<?= $product["slug"] ?>" class="img" style="background-image: url(' <?= $image_url; ?> ');"></a>
                            <div class="text text-center pt-4">

                                <h3><a class="product-name" href="detail_product.php?san-pham=<?= $product["slug"] ?>"><?= $product["product_name"] ?></a></h3>
                                <p class="desc"><?= $product["description"] ?></p>
                                <?php
                                $sql_price = "SELECT pe.price
                                  FROM product_entry pe
                                  WHERE pe.product_id =  " .$product["id"];
                                $result_price = mysqli_query($conn, $sql_price);
                                $quantities = array();

                                // loop array
                                while ($row_price = mysqli_fetch_assoc($result_price)) {
                                    $quantities[] = $row_price['price'];
                                }
                                ?>
                                <p class="price"><span><?= number_format($quantities[0], 0, '.', ',') ?> VNĐ</span></p>
                                <p><a href="detail_product.php?san-pham=<?= $product["slug"] ?>" class="btn btn-primary btn-outline-primary" id="btn-add-to-cart">Thêm vào giỏ hàng</a></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<section class="ftco-about d-md-flex">
    <div class="one-half img" style="background-image: url(./assets/images/about.jpg);"></div>
    <div class="one-half ftco-animate">
        <div class="overlap">
            <div class="heading-section ftco-animate ">
                <span class="subheading py-5">Khám phá</span>
                <h2 class="mb-5">Câu chuyện của chúng tôi</h2>
            </div>
            <div>
                <p>Khám phá ngay các sản phẩm cà phê nguyên chất Cafe VietNam là kết tinh từ những hạt cà phê hảo hạng nhất của vùng đại ngàn Tây Nguyên. Dù gu của bạn là say nồng đậm đà hay thanh thanh, nhẹ dịu, dù thuộc tuýp chuộng cafein cao hay thấp, Cafe VietNam vẫn có thể thoả mãn khẩu vị thưởng thức của bạn một cách tốt nhất.</p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pr-md-5">
                <div class="heading-section text-md-right ftco-animate">
                    <span class="subheading">Khám phá</span>
                    <h2 class="mb-4">Menu của chúng tôi</h2>
                    <p class="mb-4">Tách cà phê đậm vị mà bạn đang thưởng thức, chính là kết quả của những nỗ lực không ngừng nghỉ của chúng tôi trong hơn nửa thế kỉ qua. Ít ai biết rằng, quy trình chế biến cà phê luôn đòi hỏi sự tỉ mỉ rất cao. Bất kỳ một mắt xích nào trong quy trình chế biến không được chú trọng cũng có thể làm cho cả chuỗi bị ảnh hưởng, từ khâu vun trồng đến các biện pháp diệt trừ sâu bệnh, cho đến khâu thu hoạch, chế biến, vận chuyển, rang xay, đóng gói và cuối cùng là tách cà phê đậm vị.</p>
                    <p><a href="#" class="btn btn-primary btn-outline-primary px-4 py-3">View Full Menu</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="menu-entry">
                            <a href="#" class="img" style="background-image: url(./assets/images/menu-1.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry mt-lg-4">
                            <a href="#" class="img" style="background-image: url(./assets/images/menu-2.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry">
                            <a href="#" class="img" style="background-image: url(./assets/images/menu-3.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry mt-lg-4">
                            <a href="#" class="img" style="background-image: url(./assets/images/menu-4.jpg);"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(./assets/images/bg_2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="100">0</strong>
                                <span>Coffee Branches</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="85">0</strong>
                                <span>Number of Awards</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="10567">0</strong>
                                <span>Happy Customer</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <div class="icon"><span class="flaticon-coffee-cup"></span></div>
                                <strong class="number" data-number="900">0</strong>
                                <span>Staff</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-gallery">
    <div class="container-wrap">
        <div class="row no-gutters">
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(./assets/images/gallery-1.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(./assets/images/gallery-2.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(./assets/images/gallery-3.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(./assets/images/gallery-4.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section img" id="ftco-testimony" style="background-image: url(./assets/images/bg_1.jpg);"  data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading mb-4">Khách hàng nói gì</span>
                <h2 class="mb-4">Những đánh giá từ khách hàng</h2>
            </div>
        </div>
    </div>
    <div class="container-wrap">
        <div class="row d-flex no-gutters">
            <div class="col-lg align-self-sm-end ftco-animate">
                <div class="testimony">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small.&rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="../assets/images/person_2.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end">
                <div class="testimony overlay">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="../assets/images/person_2.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end ftco-animate">
                <div class="testimony">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small  line of blind text by the name. &rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="./assets/images/person_3.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end">
                <div class="testimony overlay">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however.&rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="./assets/images/person_2.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end ftco-animate">
                <div class="testimony">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small  line of blind text by the name. &rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="./assets/images/person_3.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
