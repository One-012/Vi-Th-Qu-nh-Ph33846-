<?php
class CategoryController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy tất cả danh mục từ model
        require_once PATH_VIEW . 'admin/header.php';
        require_once PATH_VIEW . 'admin/category_list.php';
        require_once PATH_VIEW . 'admin/footer.php';
    }

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']) ?? '';
            $description = trim($_POST['description']) ?? '';

            if ($name && $description) {
                $categoryModel = new CategoryModel();
                $categoryModel->addCategory([
                    'name' => $name,
                    'description' => $description,
                ]);
                header('Location: ' . BASE_URL . 'admin.php?action=category');
                exit();
            }
        }
        require_once PATH_VIEW . 'admin/header.php';
        require_once PATH_VIEW . 'admin/category_add.php';
        require_once PATH_VIEW . 'admin/footer.php';
    }

    public function editCategory()
    {
        $categoryId = $_GET['id'] ?? null;
        if ($categoryId) {
            $categoryModel = new CategoryModel();
            $category = $categoryModel->getCategoryById($categoryId);          
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = trim($_POST['name']) ?? '';
                $description = trim($_POST['description']) ?? '';

                if ($name && $description) {
                    $categoryModel->editCategory([
                        'id' => $categoryId,
                        'name' => $name,
                        'description' => $description,
                    ]);
                    header('Location: ' . BASE_URL . 'admin.php?action=category');
                    exit();
                }
            } else {
                $category = $categoryModel->getCategoryById($categoryId);
            }
    
            require_once PATH_VIEW . 'admin/header.php';
            require_once PATH_VIEW . 'admin/category_edit.php';
            require_once PATH_VIEW . 'admin/footer.php';
        } else {
            header('Location: ' . BASE_URL . 'admin.php?action=category');
            exit();
        }
    }

    public function deleteCategory()
    {
        $categoryId = $_GET['id'] ?? null;
        if ($categoryId) {
            $categoryModel = new CategoryModel();
            $categoryModel->deleteCategory($categoryId);
            header('Location: ' . BASE_URL . 'admin.php?action=category');
            exit();
        } else {
            header('Location: ' . BASE_URL . 'admin.php?action=category');
            exit();
        }
    }
}
   