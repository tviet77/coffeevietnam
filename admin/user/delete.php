<?php
include '../../config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemId = $_POST['item_id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemId);

    if ($stmt->execute()) {
        echo "Tài khoản đã được xóa thành công!";
    } else {
        echo "Có lỗi xảy ra: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
