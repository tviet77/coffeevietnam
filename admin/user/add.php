
<?php


$sql = 'select * from roles';
$resultRole = mysqli_query($conn, $sql);

while ($itemRole = mysqli_fetch_assoc($resultRole)) {
    $roleList[] = $itemRole;

}

?>
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    <form id="form-edit-product" class="card" method="post" action="../admin/user/handle.php" enctype="multipart/form-data">
                        <div class="card-header">
                            <h3 class="card-title">Thêm mới tài khoản</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Tên đăng nhập:
                                </label>
                                <div>
                                    <input type="text" class="form-control" name="user_name"  required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Mật khẩu:
                                </label>
                                <div>
                                    <input type="text" class="form-control" name="user_password" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quyền quản trị
                                </label>
                                <select type="text" class="form-select" id="select-option-role" name="role_user">
                                    <?php foreach ($roleList as $itemRole) { ?>
                                        <option value="<?= $itemRole['id']; ?>">
                                            <?= $itemRole['role_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Email</label>
                                <div>
                                    <input type="text" class="form-control" name="user_email" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Họ tên</label>
                                <div>
                                    <input type="text" class="form-control" name="user_full_name" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Điện thoại</label>
                                <div>
                                    <input type="text" class="form-control" name="user_phone" >
                                </div>
                            </div>


                        </div>
                        <div class="card-footer text-end">
                            <input type="submit" class="btn btn-primary " name="btn-add-user" value="Cập nhật">
                            <a href="#" class="btn btn-green btn-primary">Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
