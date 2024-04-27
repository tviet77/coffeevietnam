<?php
require './include/header.php';
?>

<section class="home-slider owl-carousel">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Giỏ hàng</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Trang chủ</a></span> <span>Giỏ hàng</span></p>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-cart">
    <div class="container">
        <?php
        if (isset($_SESSION["username"])) {
            // Check if user's cart already exists
            $sql = "SELECT * FROM carts WHERE customer_id = " . $_SESSION["user_id"];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                // Cart already exists, so get the cart ID
                $cartRow = mysqli_fetch_assoc($result);
                $cartId = $cartRow['id'];
                ?>
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <form class="cart-form" method="post" id="cart-form-detail">
                                <input type="hidden" name="cart_id" value="<?= $cartId ?>">
                                <table class="table">
                                    <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tạm tính</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * FROM cart_details WHERE cart_id = $cartId";
                                    $result = mysqli_query($conn, $sql);
                                    while ($cart = mysqli_fetch_assoc($result)) {
                                        $cartItems[] = $cart; // Thêm mục vào mảng
                                    }

                                    foreach ($cartItems as $cartItem) {
                                        $pe_id =  $cartItem['product_entry_id'];
                                        $sql = "select * from product_entry where id ='$pe_id'";
                                        $result = mysqli_query($conn, $sql);
                                        $rowProductPE = mysqli_fetch_assoc($result);
                                        $idProduct = $rowProductPE['product_id'];
                                        //get product name from product_id product_entry
                                        $sql = "select * from products where id = '$idProduct'";
                                        $result = mysqli_query($conn, $sql);
                                        $rowProduct = mysqli_fetch_assoc($result); ?>
                                        <tr class="text-center cart_item">
                                            <td class="product-remove">
                                                <a href="?remove_item=<?= $cartItem['id'] ?>" class="btn-remove-item"><span class="icon-close"></span>
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <h3><?= $rowProduct['product_name'] ?></h3>
                                                <input type="hidden" value="<?= $cartItem['id'] ?>">
                                                <input type="hidden" name="product_entry_id[]" value="<?= $cartItem['product_entry_id'] ?>">
                                            </td>

                                            <td class="product-quantity d-flex justify-content-center">
                                                <div class="input-group col-md-6 d-flex mb-3">
                                                        <span class="input-group-btn mr-2">
                                                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                                                <i class="icon-minus"></i>
                                                            </button>
                                                        </span>
                                                    <input type="text" name="product-quantity[]" class="quantity form-control input-number" value="<?= $cartItem['quantity'] ?>" min="1" max="100">
                                                    <span class="input-group-btn ml-2">
                                                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                                             <i class="icon-plus"></i>
                                                         </button>
                                                        </span>
                                                </div>
                                            </td>

                                            <td class="price"><?= $cartItem['price'] . " VNĐ"?></td>

                                            <td class="total"><?= $cartItem['price'] * $cartItem['quantity'] . " VNĐ" ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="d-flex justify-content-start">
                                                <a href="index.php" class="btn btn-light py-3 px-5 mr-3">Tiếp tục mua hàng</a>
                                                <input type="submit" class="btn btn-primary py-3 px-5" name="btn-update-cart" value="Cập nhật giỏ hàng">
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                        <?php
                        $sql = "SELECT SUM(quantity * price) AS total_price FROM cart_details WHERE cart_id = $cartId";
                        $result = mysqli_query($conn, $sql);
                        $priceTotal = mysqli_fetch_assoc($result);
                        $_SESSION['cart_id'] = $cartId;
                        $_SESSION['total_price'] = $priceTotal['total_price'];

                        ?>
                        <form class="cart-total mb-3" method="post" action="check-out.php">
                            <h3>Tổng giỏ hàng</h3>
                            <p class="d-flex">
                                <span>Tạm tính</span>
                                <span><?= $priceTotal['total_price'] ?></span>
                            </p>
                            <p class="d-flex">
                                <span>Phí vận chuyển</span>
                                <span>0</span>
                            </p>
                            <p class="d-flex">
                                <span>Giảm giá</span>
                                <span>0</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>TỔNG CỘNG</span>
                                <span><?= $priceTotal['total_price'] ?></span>

                            </p>
                            <p class="text-center">
                                <input class="btn btn-primary py-3 px-4" type="submit" name="btn-checkout" value="Tiến hành thanh toán">
                            </p>
                        </form>

                    </div>
                </div>
                <?php
            } else { ?>
                <p class="text-center">Giỏ hàng trống, vui lòng tiếp tục mua hàng</p>
                <?php
            }
        } else { ?>
            <p class="text-center">Vui lòng <a href="login.php">đăng nhập</a> để xem giỏ hàng</p>
            <?php
        }
        ?>
    </div>
</section>

<?php
require './include/footer.php';
?>
<script>
    $(document).ready(function () {
        $('.quantity-right-plus').click(function (e) {
            e.preventDefault();
            var quantityInput = $(this).closest('.input-group').find('.quantity');
            var quantity = parseInt(quantityInput.val());
            quantityInput.val(quantity + 1);
        });

        $('.quantity-left-minus').click(function (e) {
            e.preventDefault();
            var quantityInput = $(this).closest('.input-group').find('.quantity');
            var quantity = parseInt(quantityInput.val());
            if (quantity > 0) {
                quantityInput.val(quantity - 1);
            }
        });
    });

    $(document).ready(function() {
        $('input[name="btn-update-cart"]').click(function(e) {
            e.preventDefault();

            var formData = $('#cart-form-detail').serialize();
            console.log(formData);

            $.ajax({
                type: 'POST',
                url: 'update-cart.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi cập nhật giỏ hàng.');
                }
            });
        });

        $('.btn-remove-item').click(function(e) {
            e.preventDefault();

            var removeLink = $(this);
            var href = removeLink.attr('href');

            var params = href.split('?')[1].split('&');
            var removeItemValue;

            params.forEach(function(param) {
                var pair = param.split('=');
                if (pair[0] === 'remove_item') {
                    removeItemValue = pair[1];
                }
            });

            $.ajax({
                type: 'GET',
                url: 'remove-item-cart.php',
                data: { remove_item: removeItemValue },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        removeLink.closest('.cart_item').remove();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi xoá sản phẩm khỏi giỏ hàng.');
                }
            });

        });
    });



</script>
</body>
</html>
