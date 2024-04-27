<?php
include './config/config.php';
?>
<?php

session_start();
if (isset($_POST['btnlogin'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' and password = '$password'");
    $user = mysqli_fetch_assoc($result);

    $num = mysqli_num_rows($result);
    if ($num > 0) {

        $_SESSION["username"] = $username;
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["role_id"] = $user['role_id'];

        if ($user['role_id'] == 1) {
            header("location: admin/index.php");
            exit;
        } elseif ($user['role_id'] == 2) {
            header("location: index.php");
            exit;
        }
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Cafe Viet</title>
    <link rel="stylesheet" type="text/css" href="./assets/user/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/user/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/user/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="./assets/user/css/iofrm-theme19.css">
</head>
<body>
<div class="form-body without-side">
    <div class="website-logo">
        <a href="./index.php">
            <div class="logo">
                <img class="logo-size" src="./assets/user/img/logo-light.svg" alt="">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="assets/user/img/graphic3.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3 class="text-center">Đăng nhập tài khoản</h3>
                    <p class="text-center">Chào mừng đến với Cafe Viet.</p>
                    <?php if (isset($error_message)) { ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php } ?>
                    <form class="form-login-cafe" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                        <input class="form-control" type="text" name="username" placeholder="Số điện thoại hoặc địa chỉ E-mail">
                        <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
                        <div class="form-button">
                            <input id="submit" type="submit" class="ibtn text-center" name="btnlogin" value="Đăng nhập"></input>
                            <a href="#">Quên mật khẩu?</a>
                        </div>
                    </form>
                    <div class="page-links mt-3">
                        <a href="./signup.php">Đăng kí tài khoản mới</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./assets/user/js/jquery.min.js"></script>
<script src="./assets/user/js/popper.min.js"></script>
<script src="./assets/user/js/bootstrap.min.js"></script>
<script src="./assets/user/js/main.js"></script>
</body>
</html>
