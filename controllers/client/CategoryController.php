<?php
class CategoryController
{
    public function index() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Lấy ID danh mục từ URL, mặc định là 1 nếu không có
        // Lấy tất cả danh mục sản phẩm
        $categoryModel = new CategoryModel();
        $categoryCurrent = $categoryModel->getCategoryById($id); // Lấy danh mục hiện tại
        if (!$categoryCurrent) {
            // Nếu danh mục không tồn tại, có thể redirect về trang 404 hoặc trang chủ
            header('Location: index.php?action=404');
            exit();
        }
        $categories = $categoryModel->getAllCategories();
        $productModel = new ProductModel();
        $page = 1;
        $limit = 10; // Giới hạn số sản phẩm hiển thị trên mỗi trang
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = (int)$_GET['page'];
        }
        $products = $productModel->getAllProductsByCategory($id, $page, $limit); // Lấy sản phẩm của danh mục đầu tiên (ví dụ)
        $totalProductOfCategory = $productModel->getTotalProductsByCategory($id); // Lấy tổng số sản phẩm trong danh mục
        $totalPages = ceil($totalProductOfCategory / $limit); // Tính tổng số trang dựa trên tổng số sản phẩm và giới hạn sản phẩm trên mỗi trang
       
        // Hiển thị danh sách danh mục
        include 'views/client/header.php'; 
        include 'views/client/category_list.php';
        include 'views/client/footer.php';
    }
}