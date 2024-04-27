<?php
$base_url = "/admin/index.php?controller=product";

$sql = "SELECT * FROM products";

$result = mysqli_query($conn, $sql);
while ($productItem = mysqli_fetch_assoc($result)) {
    $products[] = $productItem;
}

$records_per_page = 10;

$total_records_sql = "SELECT COUNT(*) AS total_records FROM products";
$total_records_result = $conn->query($total_records_sql);
$total_records_row = $total_records_result->fetch_assoc();
$total_records = $total_records_row['total_records'];

$total_pages = ceil($total_records / $records_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $records_per_page;

$sql = "SELECT * FROM products LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);

function getNameCateGory($idCate,  $conn)
{
    $sql = "SELECT * FROM product_categories WHERE id = $idCate";
    $result = mysqli_query($conn, $sql);
    $rowCate = mysqli_fetch_assoc($result);
    return $rowCate['category_name'];
}

?>
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Danh sách sản phẩm
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
                                    <th>Tên Sản Phẩm</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Mô tả</th>
                                    <th>img1</th>
                                    <th>img2</th>
                                    <th>img3</th>
                                    <th>slug</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($result as $productItem) {?>
                                    <tr>
                                        <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                                        <td><span class="text-secondary"><?= $productItem['id'] ?></span></td>
                                        <td><a href="#" class="text-reset" tabindex="-1"><?= $productItem['product_name'] ?></a></td>
                                        <td>
                                            <p><?= getNameCateGory($productItem['category_id'],  $conn) ?></p>
                                        </td>
                                        <td>
                                            <p><?= $productItem['description'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $productItem['img1'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $productItem['img2'] ?></p>
                                        </td>
                                        <td>
                                            <p><?= $productItem['img3'] ?></p>
                                        </td>
                                        <td class="text-center">
                                            <div class="table-actions">
                                                <a href="../../detail_product.php?san-pham=<?= $productItem['slug'] ?>" class="btn btn-teal w-100 btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>
                                                </a>
                                                <a href="?controller=product&action=edit&product_id=<?= $productItem['id'] ?>" class="btn btn-green w-100 btn-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                        <path d="M13.5 6.5l4 4" />
                                                    </svg>
                                                </a>
                                                <button class="btn btn-red w-100 btn-icon btn-delete-product" data-bs-toggle="modal" data-bs-target="#modal-danger" data-item-id="<?= $productItem['id']?>">
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
                                <?php } ?>
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
                                        <h3>Xoá sản phẩm?</h3>
                                        <div class="text-secondary">Bạn có chắc muốn xoá sản phẩm này. Những gì bạn đã làm không thể hoàn tác được.</div>
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
                $('.btn-delete-product').click(function() {
                    itemIdToDelete = $(this).data('item-id');
                    console.log(itemIdToDelete);
                    $('#modal-danger').show();
                });

                $('.btn-danger').click(function() {
                    $.ajax({
                        url: 'product/delete.php',
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