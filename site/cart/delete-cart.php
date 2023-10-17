<?php
require '../../global.php';
extract($_REQUEST);

if (empty($_SESSION['cart'])) {
    header("location:" . $SITE_URL . "/cart/list-cart.php");
} else {
    if ($act == "deleteAll") {
        unset($_SESSION['cart']);
        unset($_SESSION['total_cart']);
        unset($_SESSION['tien']); // Xóa tổng tiền
        header("location:" . $SITE_URL . "/cart/list-cart.php");
    } else if ($act == "delete") {
        if (array_key_exists($id, $_SESSION['cart'])) {
            $sl = $_SESSION['cart'][$id]['sl']; // Lấy số lượng của sản phẩm bị xóa
            $tien = $sl * ($_SESSION['cart'][$id]['don_gia'] - $_SESSION['cart'][$id]['giam_gia']); // Tính tổng tiền của sản phẩm bị xóa
            unset($_SESSION['cart'][$id]);
            $_SESSION['total_cart'] -= $sl; // Giảm tổng số sản phẩm trong giỏ hàng
            $_SESSION['tien'] -= $tien; // Giảm tổng tiền
            header("location:" . $SITE_URL . "/cart/list-cart.php");
        }
    } else if ($act == "update_sl") {
        if (isset($_POST['ma_hh']) && isset($_POST['update_sl'])) {
            $ma_hh = $_POST['ma_hh'];
            $new_sl = intval($_POST['update_sl']); // Số lượng mới
            if ($new_sl <= 0) {
                // Nếu số lượng mới <= 0, xóa sản phẩm khỏi giỏ hàng
                unset($_SESSION['cart'][$ma_hh]);
                header("location:" . $SITE_URL . "/cart/list-cart.php");
            } else {
                if (array_key_exists($ma_hh, $_SESSION['cart'])) {
                    $old_sl = $_SESSION['cart'][$ma_hh]['sl']; // Số lượng cũ
                    $old_tien = $old_sl * ($_SESSION['cart'][$ma_hh]['don_gia'] - $_SESSION['cart'][$ma_hh]['giam_gia']); // Tính tổng tiền cũ
                    $new_tien = $new_sl * ($_SESSION['cart'][$ma_hh]['don_gia'] - $_SESSION['cart'][$ma_hh]['giam_gia']); // Tính tổng tiền mới

                    // Cập nhật số lượng và tổng tiền cho sản phẩm trong giỏ hàng
                    $_SESSION['cart'][$ma_hh]['sl'] = $new_sl;
                    $_SESSION['tien'] += $new_tien - $old_tien; // Cập nhật tổng tiền

                    header("location:" . $SITE_URL . "/cart/list-cart.php");
                }
            }
        } else {
            header("location:" . $SITE_URL . "/cart/list-cart.php");
        }
    } else {
        header("location:" . $SITE_URL . "/cart/list-cart.php");
    }
}
?>
