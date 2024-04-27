<?php
include './config/config.php';
session_start();
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartId = $_POST['cart_id'];
    $productEntryIds = $_POST['product_entry_id'];
    $quantities = $_POST['product-quantity'];

    $success = true;
    $errorMessage = '';

    foreach ($productEntryIds as $index => $productEntryId) {
        $quantity = $quantities[$index];

        $sql = "UPDATE cart_details SET quantity = $quantity WHERE product_entry_id = $productEntryId AND cart_id = $cartId";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            $success = false;
            $errorMessage = "Lỗi khi cập nhật giỏ hàng: " . mysqli_error($conn);
            break;
        }
    }

    // Trả về phản hồi dưới dạng JSON
    $response = array(
        'success' => $success,
        'message' => $success ? 'Cập nhật giỏ hàng thành công' : $errorMessage
    );
    echo json_encode($response);
}

?>