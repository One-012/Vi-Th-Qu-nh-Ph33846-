<?php
class DashboardController
{

    public function index()
    {
        
        // Kiểm tra quyền truy cập
      
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $url = BASE_URL . 'index.php?action=login';
            header('Location: ' . $url);
            exit();
        }

        // Lấy dữ liệu cần thiết cho dashboard
        $data = [
            'title' => 'Dashboard',
            'user' => $_SESSION['user'],
            // Thêm các dữ liệu khác nếu cần
        ];
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy danh sách danh mục
        // Lấy danh sách sản phẩm từ model
        $productModel = new ProductModel();
        $page = $_GET['page'] ?? 1; // Lấy trang hiện tại từ query string, mặc định là trang 1
      
        if($page < 1) $page = 1; // Đảm bảo trang không nhỏ hơn 1
        $limit = 20; // Số lượng sản phẩm hiển thị trên mỗi trang
        $data_products = $productModel->getAllProducts($page, $limit); // Lấy danh sách sản phẩm từ model
        $totalProducts = $productModel->getTotalProducts(); // Lấy tổng số sản phẩm
        $totalPages = ceil($totalProducts / $limit); // Tính tổng số trang
        // Hiển thị view dashboard
        require_once PATH_VIEW . 'admin/header.php';
        require_once PATH_VIEW . 'admin/product_list.php';
        require_once PATH_VIEW . 'admin/footer.php';
    }
    public function addProduct()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy danh sách danh mục
        // Logic để thêm sản phẩm mới
        if (isset($_POST['add'])) {
            
            // Kiểm tra xem form đã được submit hay chưa
            // Xử lý dữ liệu từ form
            $name = $_POST['name'] ?? '';
            $main_image = $_FILES['main_image'] ?? null;
            $category_id = $_POST['category_id'] ?? '';
            $price = $_POST['price'] ?? 0;
            $description = $_POST['description'] ?? '';
            // Kiểm tra dữ liệu hợp lệ
            if (empty($name) || empty($main_image) || empty($category_id) || $price <= 0 || empty($description)) {
                // Hiển thị thông báo lỗi nếu dữ liệu không hợp lệ
                $error = 'Vui lòng điền đầy đủ thông tin sản phẩm.';
              
            }else {
                // Xử lý upload file hình ảnh
                $targetDir = 'assets/uploads/products/';
                $targetFile = $targetDir . basename($main_image['name']);
                if (move_uploaded_file($main_image['tmp_name'], $targetFile)) {
                    // Lưu thông tin sản phẩm vào database
                    $productModel = new ProductModel();
                    $productModel->addProduct([
                        'name' => $name,
                        'main_image' => $main_image['name'],
                        'category_id' => $category_id,
                        'price' => $price,
                        'description' => $description,
                    ]);
                    // Redirect hoặc hiển thị thông báo thành công
                    header('Location: ' . BASE_URL . 'admin.php');
                    exit();
                } else {
                    // Hiển thị thông báo lỗi nếu upload không thành công
                    $error = 'Không thể upload hình ảnh. Vui lòng thử lại.';
                    
                }
                 
            }
          
        }
        // Hiển thị form thêm sản phẩm
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy danh sách danh mục
        require_once PATH_VIEW . 'admin/header.php';
        require_once PATH_VIEW . 'admin/product_add.php';
        require_once PATH_VIEW . 'admin/footer.php';
    }
    public function editProduct()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy danh sách danh mục
        // Logic để chỉnh sửa sản phẩm
        // Lấy ID sản phẩm từ request
        $productId = $_GET['id'] ?? null;
        if ($productId) {
            $productModel = new ProductModel();
            $product = $productModel->getProductById($productId);         
            if (!$product) {
                // Nếu không tìm thấy sản phẩm, có thể redirect hoặc hiển thị thông báo lỗi
                header('Location: ' . BASE_URL . 'index.php?action=dashboard');
                exit();
            }

            if (isset($_POST['edit'])) {
               
                // Kiểm tra xem form đã được submit hay chưa
                // Xử lý dữ liệu từ form
                $name = $_POST['name'] ?? '';
                $main_image = $_FILES['main_image'] ?? null;
                $category_id = $_POST['category_id'] ?? '';
                $price = $_POST['price'] ?? 0;
                $description = $_POST['description'] ?? '';
                // Kiểm tra dữ liệu hợp lệ
                if (empty($name) || empty($main_image) || empty($category_id) || $price <= 0 || empty($description)) {
                    // Hiển thị thông báo lỗi nếu dữ liệu không hợp lệ
                    $error = 'Vui lòng điền đầy đủ thông tin sản phẩm.';
                
                }else {
                    // Xử lý upload file hình ảnh
                    $targetDir = 'assets/uploads/products/';
                    $targetFile = $targetDir . basename($main_image['name']);
                    if($main_image['name'] != ''){                       
                        if (move_uploaded_file($main_image['tmp_name'], $targetFile)) {                           
                            $image_name =    $main_image['name']; // Lưu tên hình ảnh mới
                          
                        } else {
                            // Hiển thị thông báo lỗi nếu upload không thành công
                            $error = 'Không thể upload hình ảnh. Vui lòng thử lại.';
                            
                        }
                    }else{
                        // Nếu không có hình ảnh mới, giữ nguyên hình ảnh cũ
                        $image_name = $product['main_image'];
                    }
                     // Lưu thông tin sản phẩm vào database
                    $productModel = new ProductModel();
                    $productModel->editProduct([
                        'id' => $productId, // ID sản phẩm cần chỉnh sửa
                        'name' => $name,
                        'main_image' => $image_name,
                        'category_id' => $category_id,
                        'price' => $price,
                        'description' => $description,
                    ]);
                    // Redirect hoặc hiển thị thông báo thành công
                    header('Location: ' . BASE_URL . 'admin.php');
                    exit();
                }
            }
            // Hiển thị form chỉnh sửa sản phẩm
            require_once PATH_VIEW . 'admin/header.php';
            require_once PATH_VIEW . 'admin/product_edit.php';
            require_once PATH_VIEW . 'admin/footer.php';
        } else {
            // Redirect nếu không có ID sản phẩm
            header('Location: ' . BASE_URL . 'index.php?action=dashboard');
            exit();
        }
    }   
    public function deleteProduct()
    {
        // Logic để xóa sản phẩm
        $productId = $_GET['id'] ?? null;
        if ($productId) {
            $productModel = new ProductModel();
            $product = $productModel->getProductById($productId);
            if ($product) {
                // Xóa sản phẩm khỏi database
                $productModel->deleteProduct($productId);
                // Redirect hoặc hiển thị thông báo thành công
                header('Location: ' . BASE_URL . 'admin.php');
                exit();
            } else {
                // Nếu không tìm thấy sản phẩm, có thể redirect hoặc hiển thị thông báo lỗi
                header('Location: ' . BASE_URL . 'admin.php?action=dashboard');
                exit();
            }
        } else {
            // Redirect nếu không có ID sản phẩm
            header('Location: ' . BASE_URL . 'admin.php?action=dashboard');
            exit();
        }
    }
}