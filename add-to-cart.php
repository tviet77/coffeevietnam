<?php
include './config/config.php';
session_start();
?>

<?php
    function escapeString($data) {
        global $conn; // Access global connection within the function
        return htmlspecialchars(strip_tags($conn->real_escape_string($data)));
    }

    $id_pe = $_POST["id_product_entry"];

    if (isset($_POST['btn-add-to-cart'])) {
        $productPrice = escapeString($_POST['product-option-size']);
        $quantity = (int) escapeString($_POST['quantity']);
        if ($quantity < 1 || $quantity > 100) {
            $response = array("error" => "Số lượng sản phẩm phải từ 1 đến 100.");
            echo json_encode($response);
            exit();
        } else {
            if (isset($_SESSION['user_id'])) {
                $sql = "SELECT * FROM carts WHERE customer_id = " . $_SESSION["user_id"];
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
                if ($row > 0) {
                    $cartRow = mysqli_fetch_assoc($result);
                    $cartId = $cartRow['id'];
                }
                else {
                    $sql = "INSERT INTO carts (customer_id) VALUES (" . $_SESSION["user_id"] . ")";
                    $query = mysqli_query($conn, $sql);
                    $cartId = mysqli_insert_id($conn);
                }

                $sql = "SELECT * FROM cart_details WHERE cart_id = $cartId AND product_entry_id = $id_pe";

                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
                if ($row > 0) {
                    $sql = "UPDATE cart_details SET quantity = quantity + $quantity, price = price + ($productPrice * $quantity) WHERE cart_id = $cartId AND product_entry_id = $id_pe";
                } else {
                    $sql = "INSERT INTO cart_details (cart_id, product_entry_id, quantity, price) VALUES ($cartId, $id_pe, $quantity, $productPrice)";
                }
                $query = mysqli_query($conn, $sql);
                if (!$query) {
                    $response = array("error" => "Lỗi khi thêm vào giỏ hàng: " . mysqli_error($conn));
                    echo json_encode($response);
                    exit();
                } else {
                    $response = array("message" => "Sản phẩm đã được thêm vào giỏ hàng.");
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response = array("error" => "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.");
                echo json_encode($response);
                exit();
            }
        }
    }


?>
