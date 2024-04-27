<?php
$base_url = "/admin/index.php?controller=order";

$order_id = $_GET['order_id'];

$sql = "SELECT * FROM order_detail where order_id = $order_id";

$result = mysqli_query($conn, $sql);
while ($orderItem = mysqli_fetch_assoc($result)) {
    $orderDetailList[] = $orderItem;
}

$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = mysqli_query($conn, $sql);

$rowOrder = mysqli_fetch_assoc($result);


function getInfoProduct($idProducPE, $conn)
{
    $sql = "SELECT * FROM product_entry WHERE id = $idProducPE";
    $result = mysqli_query($conn, $sql);
    $rowProductPE = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM products WHERE id = {$rowProductPE['product_id']}";
    $result = mysqli_query($conn, $sql);
    $rowProduct = mysqli_fetch_assoc($result);
    return $rowProduct['product_name'];
}

$records_per_page = 10;

$total_records_sql = "SELECT COUNT(*) AS total_records FROM order_detail";
$total_records_result = $conn->query($total_records_sql);
$total_records_row = $total_records_result->fetch_assoc();
$total_records = $total_records_row['total_records'];

$total_pages = ceil($total_records / $records_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $records_per_page;

$sql = "SELECT * FROM order_detail LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);

?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                       Chi tiết đơn hàng
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">TRUY XUẤT DỮ LIỆU "TẤT CẢ CÁC SẢN PHẨM TRONG ĐƠN HÀNG"
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                    <th class="w-1">ID
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                                    </th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá tiền gốc</th>
                                    <th>Giá tổng SL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($resul)) : ?>
                                    <tr>
                                        <td colspan="8" > <p class="text-center">Không có giá trị</p> </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($result as $itemOrder) : ?>
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                            <td><span class="text-secondary"><?= $itemOrder['id'] ?></span></td>
                                            <td><p><?= getInfoProduct($itemOrder['productpe_id'],$conn) ?></p></td>
                                            <td>
                                                <p><?= $itemOrder['quantity'] ?></p>
                                            </td>
                                            <td>
                                                <p><?= $itemOrder['price'] ?></p>
                                            </td>
                                            <td class="1">
                                                <p><?= $itemOrder['quantity'] *$itemOrder['price'] ?></p>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                </tbody>
                            </table>
                            <div class="status-order py-5 px-3 text-center">
                                <h3> Trạng thái: <?= $rowOrder['status'] ?></h3>
                                <h2>Thành tiền: <?= $rowOrder['total'] ?> </h2>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center">

                            <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                            <?php
                            $has_previous_page = ($current_page > 1);

                            $has_next_page = ($current_page < $total_pages);

                            echo '<ul class="pagination m-0 ms-auto">';
                            if ($has_previous_page) {
                                echo '<li class="page-item"><a class="page-link" href="' . $base_url . '&page=1">First</a></li>';
                            }

                            for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
                                if ($i == $current_page) {
                                    echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                                } else {
                                    echo '<li class="page-item"><a class="page-link" href="' . $base_url . '&page=' . $i . '">' . $i . '</a></li>';
                                }
                            }

                            if ($has_next_page) {
                                echo '<li class="page-item"><a class="page-link" href="' . $base_url . '&page=' . $total_pages . '">Last</a></li>';
                            }
                            echo '</ul>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin khách hàng
                            </h3>
                        </div>
                        <div class="table-responsive">
                            <form id="form-handle-order" action="../admin/order/handle.php" enctype="multipart/form-data" method="post">
                                <table class="table table-vcenter table-mobile-md card-table">
                                    <tbody>
                                    <tr>
                                        <td data-label="Name">
                                            <p>Họ và tên</p>
                                        </td>
                                        <td data-label="Name">
                                            <p><?= $rowOrder['firstname'] .' ' . $rowOrder['lastname'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="Name">
                                            <p>Địa chỉ</p>
                                        </td>
                                        <td data-label="Name">
                                            <p><?=  $rowOrder['address'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="Name">
                                            <p>Điện thoại</p>
                                        </td>
                                        <td data-label="Name">
                                            <p><?= $rowOrder['phone'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="Name">
                                            <p>Email</p>
                                        </td>
                                        <td data-label="Name">
                                            <p><?= $rowOrder['email'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="Name">
                                            <p>Lời nhắn</p>
                                        </td>
                                        <td data-label="Name">
                                            <p><?= $rowOrder['notes'] ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="Name">
                                            <p>Trạng thái xử lý</p>
                                        </td>
                                        <td data-label="Name">
                                            <select type="text" class="form-select" id="select-option" name="status-order">
                                                <option value="0" <?php if ($rowOrder['status'] == 0) echo 'selected'; ?>>Chưa xử lý</option>
                                                <option value="1" <?php if ($rowOrder['status'] == 1) echo 'selected'; ?>>Đang xử lý</option>
                                                <option value="2" <?php if ($rowOrder['status'] == 2) echo 'selected'; ?>>Đã xử lý</option>
                                                <option value="3" <?php if ($rowOrder['status'] == 3) echo 'selected'; ?>>Huỷ đơn</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td data-label="Name">
                                            <input type="hidden" value="<?= $rowOrder['id'] ?>" name="order-id">
                                            <input class="btn btn-primary" name ="btn-handle-order" type="submit" value="Tiến hành xử lý">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>