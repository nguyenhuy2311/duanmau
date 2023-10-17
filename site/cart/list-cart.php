<?php
require '../../global.php';
require '../../dao/hang-hoa.php';
require '../../dao/khach-hang.php';
//-------------------------------//
extract($_REQUEST);
// var_dump($_REQUEST);
// die;
if (exist_param("form_invoice")) {
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
        $kh = khach_hang_select_by_id($id['ma_kh']);
        extract($kh);
        $VIEW_NAME = "../cart/form-invoice.php";
    } else {
        header("location:" . $SITE_URL . "/tai-khoan/dang-nhap.php");
    }
} else {
    $VIEW_NAME = "../cart/cart.php";
}
require '../layout.php';