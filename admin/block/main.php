<?php
if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'category':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        include('./category/add.php');
                        break;
                    case 'edit':
                        include('./category/edit.php');
                        break;
                    default:
                        include('./category/quan-ly.php');
                        break;
                }
            } else {
                include('./category/quan-ly.php');
            }
            break;
        case 'product':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        include('./product/add.php');
                        break;
                    case 'edit':
                        include('./product/edit.php');
                        break;
                    default:
                        include('./product/quan-ly.php');
                        break;
                }
            } else {
                include('./product/quan-ly.php');
            }
            break;
        case 'order':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'order-noprocess':
                        include('./order/order-noprocess.php');
                        break;
                    case 'order-inprocess':
                        include('./order/order-inprocess.php');
                        break;
                    case 'order-complete':
                        include('./order/order-complete.php');
                        break;
                    case 'order-cancel':
                        include('./order/order-cancel.php');
                        break;
                    case 'view':
                        include('./order/view.php');
                        break;
                    default:
                        include('./order/quan-ly.php');
                        break;
                }
            } else {
                include('./order/quan-ly.php');
            }
            break;
        case 'user':
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        include('./user/add.php');
                        break;
                    case 'edit':
                        include('./user/edit.php');
                        break;
                    case 'detail':
                        include('./user/detail.php');
                        break;
                    default:
                        include('./user/quan-ly.php');
                        break;
                }
            } else {
                include('./user/quan-ly.php');
            }
            break;
        default:
            include('./dashboard.php');
            break;
    }
} else {
    include('./dashboard.php');
}
?>