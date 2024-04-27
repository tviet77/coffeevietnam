<?php
include './config/config.php';

if (isset($_POST['btnsignup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $fullName = $_POST['full_name'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat-password'];

    try {
        if (empty($username)) {
            throw new Exception('Username là bắt buộc');
        }
        if (empty($email)) {
            throw new Exception('Email là bắt buộc');
        }
        if (empty($phone)) {
            throw new Exception('Phone là bắt buộc');
        }
        if (empty($fullName)) {
            throw new Exception('Full name là bắt buộc');
        }
        if (empty($password)) {
            throw new Exception('Password là bắt buộc');
        }
        if (empty($repeatPassword)) {
            throw new Exception('Repeat password là bắt buộc');
        }
        if ($password !== $repeatPassword) {
            throw new Exception('Password không khớp');
        }

        $emailIsExist = 0;
        $checkMail = mysqli_query($conn, "SELECT email FROM `users` WHERE email='$email'");
        if (mysqli_num_rows($checkMail) == 0) {
            $checkUsername = mysqli_query($conn, "SELECT username FROM `users` WHERE username='$username'");
            if (mysqli_num_rows($checkUsername) == 0) {
                $hashed_password = md5($password);
                $query = "INSERT INTO users (role_id, username, email, full_name, phone_number, password) VALUES (2, '$username', '$email', '$fullName', '$phone', '$hashed_password')";

                if (mysqli_query($conn, $query)) {
                    setcookie('success', 'Đăng kí thành công, vui lòng đăng nhập để tiếp tục', time()+1, '');
                    header("Refresh: 0");
                } else {
                    $error_message = "Đăng kí thất bại";
                }
            } else {
                $error_message = "Username đã tồn tại";
            }
        } else {
            $error_message = "Email đã tồn tại";
        }
    } catch(Exception $e) {
        $error_message = $e->getMessage();
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí tài khoản</title>
    <link rel="stylesheet" type="text/css" href="./assets/user/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/user/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/user/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="./assets/user/css/iofrm-theme19.css">
    <script type="text/javascript">
        window.hasMobileFirstExtension = true;</script>
</head>
<body cz-shortcut-listen="true">
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
                <img src="./assets/user/img/graphic3.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3 class="text-center">Đăng ký tài khoản mới</h3>
                    <p class="text-center">Access to the most powerfull tool in the entire design and web industry.</p>
                    <?php if (isset($error_message)) { ?>
                        <p class="text-center" style="color: red;"><?php echo $error_message; ?></p>
                    <?php } ?>
                    <?php if (isset($_COOKIE['success'])) { ?>
                        <p class="text-center" style="color: green;"><?php echo $_COOKIE['success']; ?></p>
                    <?php } ?>
                    <form class="form-register-user" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input class="form-control" type="text" name="username" placeholder="Username" required="">
                        <input class="form-control" type="email" name="email" placeholder="Địa chỉ e-mail">
                        <input class="form-control" type="text" name="full_name" placeholder="Họ và tên" required="">
                        <input class="form-control" type="password" name="phone" placeholder="Số điện thoại" required="">
                        <input class="form-control" type="password" name="password" placeholder="Mật khẩu" required="">
                        <input class="form-control" type="password" name="repeat-password" placeholder="Nhập lại mật khẩu" required="">
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn ibtn-full btn-dang-ki" name="btnsignup">Đăng kí</button>
                        </div>
                    </form>
                    <div class="page-links py-3 text-center">
                        <a href="./login.php">Đăng nhập với tài khoản</a>
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

