<?php
class CartController 
{

    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy tất cả danh mục sản phẩm
        
        $cart = $_SESSION['cart'] ?? []; // Lấy giỏ hàng từ session
     
        include 'views/client/header.php'; 
        include 'views/client/cart_index.php';
        include 'views/client/footer.php';
    }

    public function add()
    {
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
        
        $productModel = new ProductModel();
        if (!$product_id || $quantity < 1) {           
            return false;// Nếu không có ID sản phẩm hoặc số lượng không hợp lệ, có thể redirect về trang 404 hoặc trang chủ
        }
        $product = $productModel->getProductById($product_id); // Lấy sản phẩm theo ID
        $cart = $_SESSION['cart'] ?? []; // Lấy giỏ hàng từ session
        if ($product) {
           
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] += $quantity; // Tăng số lượng nếu đã có
            } else {
                $cart[$product_id] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity,
                    'image' => $product['main_image']
                ]; // Thêm sản phẩm mới vào giỏ hàng
            }
            // Cập nhật giỏ hàng vào session
            $_SESSION['cart'] = $cart; // Cập nhật giỏ hàng vào session
          
        }
        return $cart; // Trả về giỏ hàng dưới dạng JSON
    }

    public function remove()
    {
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi giỏ hàng nếu số lượng <= 0
        }
    }

    public function update()
    {
        $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : null;
        $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
        $productModel = new ProductModel();
        $product = $productModel->getProductById($product_id); // Lấy sản phẩm theo ID
        if (!$product_id || $quantity < 1) {
            // Nếu không có ID sản phẩm hoặc số lượng không hợp lệ, có thể redirect về trang 404 hoặc trang chủ            
            exit();
        }       
       
       
        if ($product && $quantity > 0) {
            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity; // Cập nhật số lượng nếu đã có
            }
        }else{
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi giỏ hàng nếu số lượng <= 0
            }
        }
    }
}