<?php
// Khai báo biến base_url
$base_url = "/admin/index.php?controller=order";

$sql = "SELECT * FROM orders where status = 1";

$result = mysqli_query($conn, $sql);
while ($orderItem = mysqli_fetch_assoc($result)) {
    $orderList[] = $orderItem;
}

function getInfoUser($idUser,  $conn)
{
    $sql = "SELECT * FROM users WHERE id = $idUser";
    $result = mysqli_query($conn, $sql);
    $rowUser = mysqli_fetch_assoc($result);
    return $rowUser['username'];
}

$records_per_page = 10;

$total_records_sql = "SELECT COUNT(*) AS total_records FROM orders where status = 1";
$total_records_result = $conn->query($total_records_sql);
$total_records_row = $total_records_result->fetch_assoc();
$total_records = $total_records_row['total_records'];

$total_pages = ceil($total_records / $records_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $records_per_page;

$sql = "SELECT * FROM orders LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);

?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Danh sách tất cả đơn hàng
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
                            <h3 class="card-title">Danh sách</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                                    <th class="w-1">ID
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                                    </th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Username|Id</th>
                                    <th>Ngày đặt đơn</th>
                                    <th>Tổng giá trị đơn hàng</th>
                                    <th>Tình trạng</th>
                                    <th>Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (empty($result)) : ?>
                                    <tr>
                                        <td colspan="8" > <p class="text-center">Không có giá trị</p> </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($result as $itemOrder) : ?>
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                            <td><span class="text-secondary"><?= $itemOrder['id'] ?></span></td>
                                            <td><p><?= getInfoUser($itemOrder['user_id'],$conn) ?></p></td>
                                            <td>
                                                <p><?= $itemOrder['user_id'] ?></p>
                                            </td>
                                            <td>
                                                <p><?= $itemOrder['create_at'] ?></p>
                                            </td>
                                            <td class="1">
                                                <p><?= $itemOrder['total'] ?></p>
                                            </td>
                                            <td>
                                                <p><?php
                                                    switch ($itemOrder['status']) {
                                                        case 0:
                                                            echo 'Chưa xử lý';
                                                            break;
                                                        case 1:
                                                            echo 'Đang xử lý';
                                                            break;
                                                        case 2:
                                                            echo 'Đã xử lý';
                                                            break;
                                                        case 3:
                                                            echo 'Đã bị huỷ';
                                                            break;
                                                    }
                                                    ?>
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <div class="table-actions">
                                                    <a href="index.php?controller=order&action=view&order_id=<?= $itemOrder['id'] ?>  " class="btn btn-teal w-100 btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                        </svg>
                                                    </a>
                                                    <button class="btn btn-red w-100 btn-icon btn-delete-order" data-bs-toggle="modal" data-bs-target="#modal-danger" data-item-id="<?= $itemOrder['id']?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash-x">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7h16" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                            <path d="M10 12l4 4m0 -4l-4 4" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal modal-blur fade" id="modal-danger" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-status bg-danger"></div>
                                    <div class="modal-body text-center py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" /><path d="M12 9v4" /><path d="M12 17h.01" /></svg>
                                        <h3>Xoá đơn hàng?</h3>
                                        <div class="text-secondary">Bạn có chắc muốn xoá đơn hàng này. Những gì bạn đã làm không thể hoàn tác được.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="w-100">
                                            <div class="row">
                                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                                        Huỷ
                                                    </a></div>
                                                <div class="col"><a href="#" class="btn btn-danger w-100 btn-cancel" data-bs-dismiss="modal">
                                                        Xoá
                                                    </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var itemIdToDelete;
        $('.btn-delete-order').click(function() {
            itemIdToDelete = $(this).data('item-id');
            console.log(itemIdToDelete);
            $('#modal-danger').show();
        });

        $('.btn-danger').click(function() {
            $.ajax({
                url: 'order/delete.php',
                type: 'POST',
                data: { item_id: itemIdToDelete },
                success: function(response) {
                    alert(response);
                    $('#modal-danger').hide();
                    $('button[data-item-id="' + itemIdToDelete + '"]').closest('tr').remove();
                }
            });
        });

        $('.btn-cancel').click(function() {
            $('#modal-danger').hide();
        });

    });

</script>