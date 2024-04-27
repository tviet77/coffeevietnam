<?php
    include './config/config.php';
    session_start();
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['remove_item'])) {
    $removeItemId = intval($_GET['remove_item']);

    $sql = "DELETE FROM cart_details WHERE id = $removeItemId";

    if (mysqli_query($conn, $sql)) {
        $response = array(
            'success' => true,
            'message' => 'Sản phẩm đã được xoá khỏi giỏ hàng.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Có lỗi xảy ra khi xoá sản phẩm khỏi giỏ hàng: ' . mysqli_error($conn)
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Yêu cầu không hợp lệ.'
    );
}

echo json_encode($response);
?>

