<div class="container py-5">
    <div class="row g-5">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Đặt hàng thành công</h2>
            <div class="alert alert-success text-center">
                Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đã được xử lý thành công.
            </div>
            <p class="text-center">
                Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.
            </p>
            <p class="text-center">
                <a href="<?php echo BASE_URL . 'index.php?action=home' ?>" class="btn btn-primary">Quay lại trang chủ</a>
            </p>
        </div>
        <!-- <div class="col-md-12">
            <h3 class="text-center">Thông tin đơn hàng</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td><?php echo number_format($item['price'], 0, ',', '.'); ?> đ</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Không có sản phẩm nào trong giỏ hàng.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
        </div> -->
    </div>
</div>