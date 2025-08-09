<?php
class OrderController
{
    public function index()
    {
        $cart = $_SESSION['cart'] ?? [];
        $tongTien = 0;
        $phiVanChuyen = 30000; // Phí vận chuyển cố định

        foreach ($cart as $item) {
            $tongTien += $item['price'] * $item['quantity'];
        }

        include 'views/client/cart_index.php';
    }

    // Các phương thức khác như add, remove, update sẽ được định nghĩa ở đây
    public function add()
    {
        //Kiểm tra xem người dùng đã đăng nhập hay chưa
    
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
     
        // Xử lý logic thêm đơn hàng
        // Giả sử bạn đã có thông tin người dùng và giỏ hàng trong session
        $userId = $_SESSION['user']['id'] ?? null;
        $cart = $_SESSION['cart'] ?? [];
        $totalAmount = 0;
        $shippingFee = 30000; // Phí vận chuyển cố định

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Gọi model để tạo đơn hàng
        $orderModel = new OrderModel();
        if ($orderModel->createOrder($userId, $cart, $totalAmount, $shippingFee)) {
            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);
            header('Location: index.php?action=order-success');
        } else {
            // Xử lý lỗi nếu không thể tạo đơn hàng
            echo "Không thể tạo đơn hàng. Vui lòng thử lại.";
        }
    }   
    public function success()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy tất cả danh mục sản phẩm
        // Hiển thị thông báo thành công
        include 'views/client/header.php';
        include 'views/client/order_success.php';
        include 'views/client/footer.php';
    }
}