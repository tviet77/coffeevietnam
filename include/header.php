<?php
include './config/config.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cafe Việt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/animate.css">

    <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./assets/css/magnific-popup.css">

    <link rel="stylesheet" href="./assets/css/aos.css">

    <link rel="stylesheet" href="./assets/css/flaticon.css">
    <link rel="stylesheet" href="./assets/css/icomoon.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.php">Coffee<small>Blend</small></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                ?>
                <li class="nav-item <?= ($current_page == 'index.php') ? 'active' : '' ?>"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item <?= ($current_page == 'menu.php') ? 'active' : '' ?>"><a href="menu.php" class="nav-link">Thực đơn</a></li>
                <li class="nav-item <?= ($current_page == 'services.php') ? 'active' : '' ?>"><a href="#" class="nav-link">Cửa hàng</a></li>
                <li class="nav-item <?= ($current_page == 'blog.php') ? 'active' : '' ?>"><a href="#" class="nav-link">Tin tức</a></li>
                <li class="nav-item <?= ($current_page == 'about.php') ? 'active' : '' ?>"><a href="#   " class="nav-link">Giới thiệu</a></li>
                <?php if (isset($_SESSION["username"])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["username"]; ?></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="#">Tài khoản</a>
                            <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
                        </div>
                    </li>

                <?php } else { ?>
                    <li class="nav-item">
                        <a href="../login.php" class="nav-link">Đăng nhập</a>
                    </li>
                <?php } ?>
                <li class="nav-item cart <?= ($current_page == 'cart.php') ? 'active' : '' ?>">
                    <a href="cart.php" class="nav-link ">
                        <span class="icon icon-shopping_cart"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
