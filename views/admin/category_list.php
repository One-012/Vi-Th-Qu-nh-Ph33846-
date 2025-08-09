<!-- Main content -->
<main class="col-md-9 col-lg-10 content">
    <h2>Quản lý danh mục</h2>
    
    <div class="card">
        <div class="card-header">
            <strong>Danh sách danh mục</strong>
            <a href="<?php echo BASE_URL . 'admin.php?action=add-category' ?>" class="btn btn-success float-end">
                <i class="fas fa-plus"></i> Thêm danh mục  
            </a>
            
        </div>
        <div class="card-body">
            <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>TT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>                
                    <th>Sửa/Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Giả sử $data_products là mảng chứa danh sách sản phẩm
                $i = 1;
                foreach ($categories as $category) {
                    $url_edit = BASE_URL . "admin.php?action=edit-category&id=". $category['id'];
                    $url_delete = BASE_URL . "admin.php?action=delete-category&id=" . $category['id'];
                    echo "<tr>
                        <td>{$i}</td>
                        <td>{$category['name']}</td>
                        <td>{$category['description']}</td>
                        <td>
                            <a href='". $url_edit. "' class='btn btn-primary'>
                                <i class='fas fa-edit'></i> Sửa
                            </a>
                            <a href=' ". $url_delete."' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa danh mục này không?\")'>
                                <i class='fas fa-trash'></i> Xóa
                            </a>
                        </td>
                    </tr>"; 
                    $i++;
                }
                ?>
            
            </tbody>
            </table>
           
        </div>
    </div>
</main>
