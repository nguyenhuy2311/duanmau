<?php
require '../../global.php';
require '../../dao/hang-hoa.php';

extract($_REQUEST);

if (isset($id) && $id > 0) {
    $items = hang_hoa_select_by_id($id);

    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (isset($_SESSION['cart'][$id])) {
        // Sản phẩm đã tồn tại trong giỏ hàng
        $_SESSION['cart'][$id]['sl'] += 1;
    } else {
        // Sản phẩm chưa tồn tại trong giỏ hàng
        $_SESSION['cart'][$id] = array(
            'sl' => 1,
            'ten_hh' => $items['ten_hh'],
            'hinh' => $items['hinh'],
            'don_gia' => $items['don_gia'],
            'giam_gia' => $items['giam_gia'],
        );
    }

    // Tính tổng tiền cho sản phẩm hiện tại
    $tien = $_SESSION['cart'][$id]['sl'] * ($_SESSION['cart'][$id]['don_gia'] - $_SESSION['cart'][$id]['giam_gia']);

    // Tính tổng số sản phẩm trong giỏ hàng
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $_SESSION['cart'][$key]['sl'];
    }

    $_SESSION['total_cart'] = $total;
    $_SESSION['tien'] = $tien; // Lưu tổng tiền của sản phẩm hiện tại

    header("location:" . $SITE_URL . "/cart/list-cart.php");
}
?>
