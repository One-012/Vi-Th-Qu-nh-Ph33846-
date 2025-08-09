<!-- Main content -->
<main class="col-md-9 col-lg-10 content">
    <h2>Quản lý sản phẩm</h2>
    
    <div class="card">
        <div class="card-header">
            <strong>Danh sách sản phẩm</strong>
            <a href="<?php echo BASE_URL . 'admin.php?action=add-product' ?>" class="btn btn-success float-end">
                <i class="fas fa-plus"></i> Thêm sản phẩm   
            </a>
            
        </div>
        <div class="card-body">
            <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>TT</th>                
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Sửa/Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Giả sử $data_products là mảng chứa danh sách sản phẩm
                $i = 1;
                foreach ($data_products as $product) {
                    $image = $product['main_image'] ?  $product['main_image'] : 'default.png'; // Kiểm tra nếu không có hình ảnh thì dùng hình mặc định
                    $image = PATH_IMAGE . $image; // Đường dẫn đến hình ảnh
                    echo "<tr>
                        <td>{$i}</td>                   
                        <td><img src='{$image}' alt='Product Image' class='img-fluid' width='100'></td>
                        <td>{$product['name']}</td>
                        <td>" . (isset($categories[$product['category_id']]) ? $categories[$product['category_id']]['name'] : 'Không xác định') . "</td> 
                        <td>" . number_format($product['price'], 0, ',', '.') . " VNĐ</td>
                        <td>
                            <a href='" . BASE_URL . "admin.php?action=edit-product&id={$product['id']}' class='btn btn-primary'>
                                <i class='fas fa-edit'></i> Sửa
                            </a>
                            <a href='" . BASE_URL . "admin.php?action=delete-product&id={$product['id']}' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa sản phẩm này không?\")'>
                                <i class='fas fa-trash'></i> Xóa
                            </a>
                        </td>
                    </tr>"; 
                    $i++;
                }
                ?>
            
            </tbody>
            </table>

            <!-- Pagination -->
            <nav class="mt-3">
            <ul class="pagination justify-content-end mb-0">
                <li class="page-item"><a class="page-link" href="<?php echo BASE_URL. "admin.php?page=1" ?>">«</a></li>
                <?php
                // Hiển thị các trang
                for ($page = 1; $page <= $totalPages; $page++) {
                    $url_page = BASE_URL . "admin.php?page={$page}";                
                    echo "<li class='page-item'><a class='page-link' href='{$url_page}'>{$page}</a></li>";
                }
                ?>
                <li class="page-item"><a class="page-link" href="<?php echo BASE_URL. "admin.php?page=$totalPages"?>">»</a></li>
            </ul>
            </nav>

        </div>
    </div>
</main>

