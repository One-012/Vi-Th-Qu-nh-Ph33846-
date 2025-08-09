<?php
class OrderModel extends BaseModel
{
    public function getAllOrders($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit; // Tính toán offset dựa trên trang hiện tại và giới hạn sản phẩm trên mỗi trang
        $query = "SELECT * FROM orders ORDER BY id DESC LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả đơn hàng dưới dạng mảng kết hợp
    }
    public function getOrderItems($orderId)
    {
        $query = "SELECT * FROM order_items WHERE order_id = :order_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả sản phẩm trong đơn hàng dưới dạng mảng kết hợp
    }
    public function createOrder($userId, $cart, $totalAmount, $shippingFee)
    {
        //Lấy addressId từ người dùng, giả sử bạn đã có thông tin này
        $sql_address = "SELECT id FROM addresses WHERE user_id = $userId LIMIT 1";    
        $stmt1 = $this->pdo->prepare($sql_address);     
        $stmt1->execute();
        $result = $stmt1->fetch(PDO::FETCH_ASSOC); // Lấy địa chỉ đầu tiên của người dùng
        $addressId = null;
       
        if ($result) {
            $addressId = $result['id']; // Lấy ID địa chỉ đầu tiên của người dùng
        } else {
            // Nếu không có địa chỉ, bạn có thể xử lý theo cách khác, ví dụ: thông báo lỗi hoặc tạo địa chỉ mới
            return false;
        }
        
        // Giả sử bạn đã có kết nối đến cơ sở dữ liệu
        $sql = "INSERT INTO orders (user_id, address_id, status, total) 
                VALUES (:user_id, :address_id, :status, :total)";
        $stmt = $this->pdo->prepare($sql);
        $status = 'Chưa xử lý'; // Trạng thái đơn hàng
        $stmt->bindValue("user_id", $userId);
        $stmt->bindValue("address_id", $addressId); // Giả sử bạn đã có addressId từ người dùng
        $stmt->bindValue("total", $totalAmount + $shippingFee); // Tổng tiền bao gồm phí vận chuyển
        $stmt->bindValue("status", $status); // Trạng thái đơn hàng, có thể là 'Chưa xử lý' hoặc 'Đang xử lý'
      
   
        if ($stmt->execute()) {
            $orderId = $this->pdo->lastInsertId();

            // Lưu các sản phẩm trong giỏ hàng vào bảng order_items
            foreach ($cart as $productId => $item) {
                $stmt = $this->pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                                VALUES (:order_id, :product_id, :quantity, :price)");
                $stmt->execute([
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }
            return true;
        }
        return false;
    }
}