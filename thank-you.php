<?php
require './include/header.php';
?>
<?php
if (isset($_POST['btn-checkout-now'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $cart_id = $_SESSION['cart_id'];
    $price_total = $_SESSION['total_price'];
    $user_id = $_SESSION['user_id'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO orders (cart_id, user_id, firstname, lastname, address, phone, email, notes, status, total)
            VALUES ('$cart_id', '$user_id', '$firstname', '$lastname', '$address', '$phone', '$email', '$notes','0', '$price_total')";
    if (mysqli_query($conn, $sql)) {
        $order_id = mysqli_insert_id($conn);

        $success = "Cảm ơn bạn đã mua hàng, chúng tôi sẽ gửi hàng trong thời gian sớm nhất";

        //id, order_id, product_id, quantity, price
        $sql = "SELECT * FROM cart_details WHERE cart_id = $cart_id";
        $result = mysqli_query($conn, $sql);
        while ($cartItem = mysqli_fetch_assoc($result)) {
            $cartList[] = $cartItem;
        }

        foreach ($cartList as $cartItem) {
            $product_entry_id = $cartItem['product_entry_id'];
            $quantity = $cartItem['quantity'];
            $price = $cartItem['price'];
            $sql = "INSERT INTO order_detail (order_id ,productpe_id, quantity, price)
                    VALUES ('$order_id','$product_entry_id', '$quantity', '$price')";
            mysqli_query($conn, $sql);
        }

        $sql_delete_cart = "DELETE FROM carts WHERE id = $cart_id";
        mysqli_query($conn, $sql_delete_cart);
    } else {
        $fail = "Đặt hàng thất bại";
    }
}
?>
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h3 class="mb-3 mt-5 bread">
                        <?php
                        echo isset($success) ? $success : $fail;
                        ?>
                    </h3>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
require './include/footer.php';
?>
</body>
</html>
