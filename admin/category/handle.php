<?php

include '../../config/config.php';
session_start();
function createSlug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}
//
if ( isset($_POST["btn-add-category"])) {

    $category_name = $_POST["category_name"];
    $category_slug = createSlug($_POST["category_name"]);
    $category_description = $_POST["category_description"];

    $sql = "INSERT INTO product_categories (category_name, slug, description) VALUES ('$category_name', '$category_slug', '$category_description')";

    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {
        echo '<script>alert("Thêm mới danh mục thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=category";</script>';
        exit();
    }   else {
        echo '<script>alert("Thêm không thành công");</script>';
    }
}

if ( isset($_POST["btn-edit-category"])) {

    $cate_id = $_POST['cate_id'];
    $category_name = $_POST["category_name"];
    $category_slug = createSlug($_POST["category_name"]);
    $category_description = $_POST["category_description"];

    $sql = "UPDATE product_categories SET category_name = '$category_name', slug = '$category_slug', description = '$category_description' WHERE id = '$cate_id'";

    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {
        echo '<script>alert("Cập nhật danh mục thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=category";</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }


}

?>