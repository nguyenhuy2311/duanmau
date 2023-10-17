<h5 class="alert-secondary mb-3 pt-3 pb-3 pl-sm-4 shadow-sm text-center text-sm-center text-md-center text-lg-center text-xl-center" style="margin-top: 5rem; margin-bottom: 0rem">Thông tin nhận hàng </h5>
<div class="row m-1 pb-5">
    <form action="<?= $SITE_URL . '/cart/invoice.php' ?>" method="POST" class="col-6 m-auto" id="invoice" enctype="multipart/form-data">
        <div class="form-group">
            <label for="ho_ten">Họ và tên</label>
            <input type="text" name="ho_ten" id="ho_ten" class="form-control rounded-pill" value="<?= $ho_ten ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="ma_kh">Mã khách hàng</label>
            <input type="hidden" name="ma_kh" id="ma_kh" class="form-control rounded-pill" value="<?= $ma_kh ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="email">Địa chỉ email</label>
            <input type="text" name="email" id="email" class="form-control rounded-pill" value="<?= $email ?>" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="sdt">Số điện thoại</label>
            <input type="text" name="sdt" id="sdt" class="form-control rounded-pill" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label for="dia_chi">Địa chỉ nhận hàng</label>
            <input type="text" name="dia_chi" id="dia_chi" class="form-control rounded-pill" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
            <label>Phương thức thanh toán</label>
            <br>
            <input type="radio" name="phuong_thuc_tt" id="phuong_thuc_tt_0" value="0" checked placeholder="" aria-describedby="helpId">
            <label for="phuong_thuc_tt_0">Tiền mặt</label>
            <br>
            <input type="radio" name="phuong_thuc_tt" id="phuong_thuc_tt_1" value="1" placeholder="" aria-describedby="helpId">
            <label for="phuong_thuc_tt_1">Chuyển khoản ngân hàng</label>
            <br>
            <input type="radio" name="phuong_thuc_tt" id="phuong_thuc_tt_2" value="2" placeholder="" aria-describedby="helpId">
            <label for="phuong_thuc_tt_2">Ví điện tử</label>
        </div>
        <input type="hidden" name="trang_thai" value="0">
        <div class="form-group">
            <label for="ghi_chu">Ghi chú</label>
            <textarea name="ghi_chu" id="ghi_chu" class="form-control"></textarea>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" name="btn_thanh_toan" class="btn btn-success btn-block pt-2 pb-2 rounded-pill">Xác nhận</button>
        </div>
    </form>
</div>
