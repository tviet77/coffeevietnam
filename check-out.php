<?php
require './include/header.php';
?>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <form id="checkout-form" action="thank-you.php" class="billing-form ftco-bg-dark p-3 p-md-5" method="post">
                    <h3 class="mb-4 billing-heading">Chi tiết thanh toán</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Họ</label>
                                <input type="text" class="form-control" name="firstname" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Tên</label>
                                <input type="text" class="form-control" name="lastname" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Điện thoại</label>
                                <input type="text" class="form-control" name="phone" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="notes">Ghi chú</label>
                                <textarea class="form-control" id="" cols="30" rows="10" name="notes"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6">
                            <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Thanh toán</h3>
                                <input type="submit" class="btn btn-primary py-3 px-4" name="btn-checkout-now" value="Thanh toán ngay">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
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

            // Lấy dữ liệu từ form
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
