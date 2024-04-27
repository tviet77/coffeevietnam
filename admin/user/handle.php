<?php
include '../../config/config.php';
session_start();

if (isset($_POST["btn-edit-user"])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST["user_name"];
    $role_user = $_POST["role_user"];
    $user_email = $_POST["user_email"];
    $user_full_name = $_POST["user_full_name"];
    $user_phone = $_POST["user_phone"];

    $sql = "UPDATE users SET username = '$user_name', role_id = '$role_user', email = '$user_email', full_name = '$user_full_name', phone_number = '$user_phone' WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {
        echo '<script>alert("Cập nhật tài khoản thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=user";</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

if (isset($_POST["btn-add-user"])) {
    $user_id = $_POST['user_id'];
    $user_name = $_POST["user_name"];
    $user_password = md5($_POST["user_password"]);
    $role_user = $_POST["role_user"];
    $user_email = $_POST["user_email"];
    $user_full_name = $_POST["user_full_name"];
    $user_phone = $_POST["user_phone"];

    $sql = "INSERT INTO users (username, role_id, email, full_name, phone_number, password) VALUES ('$user_name', '$role_user', '$user_email', '$user_full_name', '$user_phone', '$user_password')";
    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {
        echo '<script>alert("Thêm tài khoản thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=user";</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>