<?php
require '../../global.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    // Nếu giỏ hàng trống, bạn có thể xử lý tại đây hoặc chuyển hướng người dùng đến trang giỏ hàng trước.
    header("Location: $SITE_URL/cart/list-cart.php");
    exit;
}

if (isset($_POST['btn_thanh_toan'])) {
    // Lấy thông tin từ form
    $ho_ten = $_POST['ho_ten'];
    $ma_kh = $_POST['ma_kh'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $dia_chi = $_POST['dia_chi'];
    $phuong_thuc_tt = $_POST['phuong_thuc_tt'];
    $trang_thai = $_POST['trang_thai'];
    $ghi_chu = $_POST['ghi_chu'];

    try {
        // Kết nối đến cơ sở dữ liệu bằng PDO
        $dbh = new PDO('mysql:host=localhost;dbname=quanlibanhang', 'root', '');

        // Đặt chế độ lấy lỗi PDO ra ngoài để có thể bắt lỗi nếu cần
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Chuẩn bị câu truy vấn SQL để chèn thông tin đơn hàng vào bảng cơ sở dữ liệu
        $sql = "INSERT INTO don_hang (ho_ten, ma_kh, email, sdt, dia_chi, phuong_thuc_tt, trang_thai, ghi_chu)
                VALUES (:ho_ten, :ma_kh, :email, :sdt, :dia_chi, :phuong_thuc_tt, :trang_thai, :ghi_chu)";
        
        // Tạo đối tượng truy vấn SQL
        $stmt = $dbh->prepare($sql);
        
        // Bắt đầu một giao dịch
        $dbh->beginTransaction();
        
        // Bắt đầu thực thi truy vấn với dữ liệu thay thế
        $stmt->bindParam(':ho_ten', $ho_ten);
        $stmt->bindParam(':ma_kh', $ma_kh);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':dia_chi', $dia_chi);
        $stmt->bindParam(':phuong_thuc_tt', $phuong_thuc_tt);
        $stmt->bindParam(':trang_thai', $trang_thai);
        $stmt->bindParam(':ghi_chu', $ghi_chu);
        
        // Thực thi truy vấn
        $stmt->execute();
        
        // Kết thúc giao dịch và lưu các thay đổi vào cơ sở dữ liệu
        $dbh->commit();

        // Đóng kết nối PDO
        $dbh = null;

        // Xóa giỏ hàng sau khi đã đặt hàng
        unset($_SESSION['cart']);
        unset($_SESSION['total_cart']);
        unset($_SESSION['tien']);

        // Hiển thị thông báo đặt hàng thành công hoặc chuyển hướng người dùng đến trang cảm ơn
        // Hoặc chuyển hướng người dùng đến trang cảm ơn
        // header("Location: $SITE_URL/thank-you.php");
        // exit;
    } catch (PDOException $e) {
        // Xảy ra lỗi, hủy bỏ giao dịch và in ra thông báo lỗi
        echo "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử Lý Invoice</title>
    <style>
        div>a{
            text-decoration: none;
            color: green;
        }
        body {
            font-family: Arial, sans-serif;
        }

        .confirmation-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h2>Thông tin xác nhận thanh toán</h2>
        <a href="../../index.php">Quay lại trang chủ</a>    
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ho_ten = $_POST["ho_ten"];
            $email = $_POST["email"];
            $sdt = $_POST["sdt"];
            $dia_chi = $_POST["dia_chi"];
            $phuong_thuc_tt = $_POST["phuong_thuc_tt"];
            $ghi_chu = $_POST["ghi_chu"];

            // Xử lý dữ liệu ở đây (ví dụ: lưu vào cơ sở dữ liệu, gửi email xác nhận, vv.)

            // Hiển thị thông tin xác nhận
            echo "<p><strong>Họ và tên:</strong> $ho_ten</p>";
            echo "<p><strong>Địa chỉ email:</strong> $email</p>";
            echo "<p><strong>Số điện thoại:</strong> $sdt</p>";
            echo "<p><strong>Địa chỉ nhận hàng:</strong> $dia_chi</p>";
            echo "<p><strong>Phương thức thanh toán:</strong> ";
            switch ($phuong_thuc_tt) {
                case 0:
                    echo "Tiền mặt";
                    break;
                case 1:
                    echo "Chuyển khoản ngân hàng";
                    break;
                case 2:
                    echo "Ví điện tử";
                    break;
                default:
                    echo "Không xác định";
            }
            echo "</p>";
            echo "<p><strong>Ghi chú:</strong> $ghi_chu</p>";
        } else {
            echo "<p>Không có dữ liệu để xử lý.</p>";
        }
        ?>
    </div>
</body>
</html>
