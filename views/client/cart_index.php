<div class="container my-5">
  <h2 class="mb-4 border-bottom pb-2">🛒 Giỏ hàng của bạn</h2>

  <!-- Cart Table -->
  <div class="table-responsive">
    <table class="table align-middle text-center table-bordered">
      <thead class="table-light">
        <tr>
          <th>Ảnh</th>
          <th>Sản phẩm</th>
          <th>Giá</th>
          <th>Số lượng</th>
          <th>Thành tiền</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        
        <?php
        $tongTien = 0;
        $phiVanChuyen = 30000; // Phí vận chuyển cố định
        foreach ($cart as $itemId => $item) {
          $tongTien += $item['price'] * $item['quantity'];
        ?>
          
            <tr class="cart-item"  data-id="<?php echo $itemId ?>">
                <td><img src="<?php echo PATH_IMAGE . $item['image'] ?>" alt="<?php echo $item['name'] ?>" class="img-fluid" style="width: 80px;"></td>
                <td><?php echo $item['name'] ?></td>
                <td><?php echo number_format($item['price']) ?>đ</td>
                <td>
                    <input type="number" class="form-control form-control-sm w-50 mx-auto quantity" name="quantity" value="<?php echo $item['quantity'] ?>" min="1">
                </td>
                <td>
                    <?php echo number_format($item['price'] * $item['quantity']) ?>đ
                </td>
                <td>
                    <button class="btn btn-sm btn-warning update-btn">Cập nhật</button>
                    <button class="btn btn-sm btn-danger remove-btn">Xóa</button> 
                </td>
            </tr>
           
        <?php
        }
        ?>

       
        <!-- Lặp lại với các sản phẩm khác -->
      </tbody>
    </table>
  </div>

  <!-- Tổng tiền + Thanh toán -->
  <div class="row justify-content-end mt-4">
    <div class="col-md-4">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between">
          <span>Tạm tính</span>
          <strong><?php echo number_format($tongTien) ?> đ</strong>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Phí vận chuyển</span>
          <span><?php echo number_format($phiVanChuyen) ?> đ</span>
        </li>
        <li class="list-group-item d-flex justify-content-between cart-total">
          <span>Tổng cộng</span>
          <span><?php echo number_format($tongTien + $phiVanChuyen) ?> đ</span>
        </li>
      </ul>
      <a href="<?php echo BASE_URL . 'index.php?action=order-add' ?>">
        <button class="btn btn-success w-100 mt-3">Đặt hàng</button>
      </a>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    // Cập nhật sản phẩm
    $('.update-btn').click(function() {

        let row = $(this).closest('tr');
        let id = row.data('id');
        let qty = row.find('.quantity').val();

        $.post('<?php echo BASE_URL. 'index.php?action=cart-update'?>', {  product_id: id, quantity: qty }, function(res) {
             window.location.reload(); // Tải lại trang để cập nhật giỏ hàng
        });
    });

    // Xóa sản phẩm
    $('.remove-btn').click(function() {
        let row = $(this).closest('tr');
        let id = row.data('id');

        $.post('<?php echo BASE_URL. 'index.php?action=cart-remove'?>', { action: 'remove', product_id: id }, function(res) {
            window.location.reload(); // Tải lại trang để cập nhật giỏ hàng
        });
    });
});
</script>