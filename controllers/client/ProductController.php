<?php
class ProductController
{

    public function show()
    {
        // Lấy ID sản phẩm từ URL
        // Nếu không có ID, chuyển hướng đến trang 404
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=404');
            exit();
        }
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
        $productModel = new ProductModel();
        $modelProduct = new ProductModel();
        $product = $modelProduct->getProductById($id);
        if ($product) {
            include 'views/client/header.php'; 
            include 'views/client/product_detail.php';
            include 'views/client/footer.php';
        } else {
            header('Location: index.php?action=404');
            exit();
        }
    }
}