<?php
include '../../config/config.php';
session_start();

if (isset($_POST['btn-handle-order'])) {
    $id = $_POST['order-id'];
    $status = $_POST['status-order'];

    $sql = "UPDATE orders SET status = $status WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {

        echo '<script>alert("Cập nhật đơn hàng thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=order";</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

}