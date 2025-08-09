<?php
class OrderController
{
    public function index()
    {
       // Hiển thị danh sách đơn hàng
        $orderModel = new OrderModel(); // Giả sử bạn có một model để làm việc với đơn hàng
        $page = $_GET['page'] ?? 1; // Lấy trang hiện tại từ query string, mặc định là trang 1
        $limit = 10; // Số lượng đơn hàng hiển thị trên mỗi trang
        $orders = $orderModel->getAllOrders($page, $limit); // Lấy danh sách đơn hàng từ model
        $totalOrders = count($orders); // Lấy tổng số đơn hàng
        $totalPages = ceil($totalOrders / $limit); // Tính tổng số trang
      
        // Truyền dữ liệu cần thiết đến view
        $data = [
            'title' => 'Danh sách đơn hàng',
            'orders' => $orders,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
        //Lấy danh sách order items từ model
        $orderItems = [];
        foreach ($orders as $order) {
            $orderItems[$order['id']] = $orderModel->getOrderItems($order['id']); // Giả sử bạn có phương thức để lấy các sản phẩm trong đơn hàng
        }
        // Hiển thị view danh sách đơn hàng
        require_once PATH_VIEW . 'admin/header.php';
        require_once PATH_VIEW . 'admin/order_list.php';
        require_once PATH_VIEW . 'admin/footer.php';
    }

    // Các phương thức khác như add, remove, update sẽ được định nghĩa ở đây
}