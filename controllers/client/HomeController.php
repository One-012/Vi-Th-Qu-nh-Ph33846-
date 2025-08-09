<?php

class HomeController
{
   public function index() {
        // Load the home view
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts(1, 10); // Lấy tất cả sản phẩm
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy tất cả danh mục sản phẩm
        include 'views/client/header.php'; 
        include 'views/client/home_product.php';
        include 'views/client/footer.php';
    }
    public function show() {
        // Lấy ID sản phẩm từ URL
        $id = $_GET['id'] ?? null;
        if ($id) {
            $productModel = new Product();
            $product = $productModel->getProductById($id); // Lấy sản phẩm theo ID
            if ($product) {
                require_once 'views/product.php'; // Hiển thị chi tiết sản phẩm
            } else {
                echo "Sản phẩm không tồn tại.";
            }
        } else {
            echo "ID sản phẩm không hợp lệ.";
        }
    }
}