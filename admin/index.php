<?php
include '../config/config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role_id'] != 1) {
    header("Location: ../index.php");
    exit;
}

include './block/header.php';
include './block/main.php';
include './block/footer.php';

?>

