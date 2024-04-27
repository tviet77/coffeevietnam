
<?php

if(isset($_GET['user_id'])) {
    $idUser = $_GET['user_id'];

    $sql = "SELECT * FROM users where id = $idUser";

    $result = mysqli_query($conn, $sql);
    $itemUser = mysqli_fetch_assoc($result);

}

$sql = 'select * from roles';
$resultRole = mysqli_query($conn, $sql);

while ($itemRole = mysqli_fetch_assoc($resultRole)) {
    $roleList[] = $itemRole;

}

?>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                       Tài khoản <?= $itemUser['username']; ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    <form id="form-edit-product" class="card" method="post" action="../admin/user/handle.php" enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa tài khoản</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Tên đăng nhập:
                                </label>
                                <div>
                                    <input type="text" class="form-control" name="user_name" value="<?php echo $itemUser['username']; ?>" required>
                                    <input type="hidden" value="<?= $_GET['user_id']; ?>" name="user_id">
                                </div>
                            </div>
                            <div class="mb-3">
                                        <label class="form-label">Quyền quản trị
                                        </label>
                                        <select type="text" class="form-select" id="select-option-role" name="role_user">
                                            <?php foreach ($roleList as $itemRole) { ?>
                                                <option value="<?= $itemRole['id']; ?>" <?php if($itemRole['id'] == $itemUser['role_id']) echo 'selected'; ?>>
                                                    <?= $itemRole['role_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Email</label>
                                <div>
                                    <input type="text" class="form-control" name="user_email" value="<?= $itemUser['email'];?>" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Họ tên</label>
                                <div>
                                    <input type="text" class="form-control" name="user_full_name" value="<?= $itemUser['full_name'];?>" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Điện thoại</label>
                                <div>
                                    <input type="text" class="form-control" name="user_phone" value="<?= $itemUser['full_name'];?>" >
                                </div>
                            </div>


                        </div>
                        <div class="card-footer text-end">
                            <input type="submit" class="btn btn-primary " name="btn-edit-user" value="Cập nhật">
                            <a href="#" class="btn btn-green btn-primary">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
