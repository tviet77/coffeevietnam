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

define('PATH_UPLOAD_IMG_PRODUCT', '../../public/upload/products/images/');

function uploadImage($file, $path)
{
    $target_dir = $path;
    echo "Target Directory: " . $target_dir . "<br>";

    if (!is_writable($target_dir)) {
        return false;
    }

    $target_file = $target_dir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($file["error"] > 0) {
        return false;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        return false;
    }

    if ($file["size"] > 500000) { // Giới hạn kích thước tệp tin là 500KB
        return false;
    }

    $result = move_uploaded_file($file["tmp_name"], $target_file);

    if ($result) {
        return basename($file["name"]);
    } else {
        return false;
    }
}


if ( isset($_POST["btn-add-product"])) {
    $product_name = $_POST["product_name"];
    $category_id = ($_POST["product_category"]);
    $product_description = $_POST["product_description"];
    $product_detail = $_POST["product_detail"];

    $img1_name = "";
    if (isset($_FILES['product-img1']) && $_FILES['product-img1']['error'] == 0) {
        echo "123";
        $img1_name = uploadImage($_FILES['product-img1'], PATH_UPLOAD_IMG_PRODUCT);
    }


    // Xử lý tải lên ảnh 2

    $img2_name = "";
    if (isset($_FILES['product-img2']) && $_FILES['product-img2']['error'] == 0) {
        $img2_name = uploadImage($_FILES['product-img2'], PATH_UPLOAD_IMG_PRODUCT);
    }

    // Xử lý tải lên ảnh 3
    $img3_name = "";
    if (isset($_FILES['product-img3']) && $_FILES['product-img3']['error'] == 0) {
        $img3_name = uploadImage($_FILES['product-img3'], PATH_UPLOAD_IMG_PRODUCT);
    }

    $slug = createSlug($product_name);


    $sql = "INSERT INTO products (product_name, category_id , description, product_detail, img1, img2, img3, slug)
            VALUES ('$product_name', '$category_id', '$product_description', '$product_detail', '$img1_name', '$img2_name', '$img3_name', '$slug')";

    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {
        $product_id = mysqli_insert_id($conn);
        $price_small = $_POST['price_small'];
        $price_medium = $_POST['price_medium'];
        $price_large = $_POST['price_large'];

        $sql_size = "SELECT id, name_size FROM size";
        $result_size = mysqli_query($conn, $sql_size);

        while ($row_size = mysqli_fetch_assoc($result_size)) {
            $size_id = $row_size['id'];
            $size_name = $row_size['name_size'];

            switch ($size_name) {
                case 'Nhỏ':
                    $price = $price_small;
                    break;
                case 'Vừa':
                    $price = $price_medium;
                    break;
                case 'Lớn':
                    $price = $price_large;
                    break;
                default:
                    $price = 0;
            }

            // Thêm bản ghi vào bảng product_entry
            $sql_entry = "INSERT INTO product_entry (product_id, size_id, price) VALUES ('$product_id', '$size_id', '$price')";
            mysqli_query($conn, $sql_entry);
        }

        echo '<script>alert("Thêm mới sản phẩm thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=product";</script>';
        exit();
    }   else {
        echo '<script>alert("Thêm không thành công");</script>';
    }
}



if (isset($_POST["btn-edit-product"])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST["product_name"];
    $product_category = $_POST["product_category"];
    $product_description = $_POST["product_description"];
    $product_detail = $_POST["product_detail"];

    // Xử lý tải lên ảnh 1
    $img1_name = "";
    if (isset($_FILES['up-load-img1']) && $_FILES['up-load-img1']['error'] == 0) {
        $img1_name = uploadImage($_FILES['up-load-img1'], PATH_UPLOAD_IMG_PRODUCT);
    }

    // Xử lý tải lên ảnh 2
    $img2_name = "";
    if (isset($_FILES['up-load-img2']) && $_FILES['up-load-img2']['error'] == 0) {
        $img2_name = uploadImage($_FILES['up-load-img2'], PATH_UPLOAD_IMG_PRODUCT);
    }

    // Xử lý tải lên ảnh 3
    $img3_name = "";
    if (isset($_FILES['up-load-img3']) && $_FILES['up-load-img3']['error'] == 0) {
        $img3_name = uploadImage($_FILES['up-load-img3'], PATH_UPLOAD_IMG_PRODUCT);
    }

    $sql = "UPDATE products SET
            product_name = '$product_name',
            category_id = '$product_category',
            description = '$product_description',
            product_detail = '$product_detail',
            img1 = '$img1_name',
            img2 = '$img2_name',
            img3 = '$img3_name'
            WHERE id = '$product_id'";


    $query = mysqli_query($conn, $sql);

    if ($query === TRUE) {

        echo '<script>alert("Cập nhật sản phẩm thành công!");</script>';
        echo '<script>window.location.href = "../index.php?controller=product";</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}



?>