<!-- Main content -->
<main class="col-md-9 col-lg-10 content">
    <h2>Quản lý sản phẩm</h2>
    
    <div class="card">
        <div class="card-header">
            <strong>Sửa sản phẩm</strong>
            
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" value="<?php echo isset($product['name']) ? htmlspecialchars($product['name']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="main_image">Ảnh đại diện</label>
                    <input type="file" class="form-control" id="main_image" name="main_image" placeholder="Ảnh đại diện">
                    
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option >Chọn danh mục</option>
                        <!-- Giả sử có một mảng $categories chứa danh sách danh mục -->
                        <?php 
                       
                        foreach ($categories as $category){
                            // Kiểm tra xem danh mục có được chọn hay không
                            $selected = ($category['id'] == $product['category_id']) ? 'selected' : '';
                            ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $selected?>><?php echo $category['name']; ?></option>
                        <?php }?>
                    </select>
                
                </div>
                <div class="form-group">
                    <label for="price">Giá sản phẩm</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" value="<?php echo isset($product['price']) ? htmlspecialchars($product['price']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="name">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" id="description" rows="10"><?php echo $product['description']?></textarea>
                </div>
                
                <button type="submit" name="edit" class="btn btn-primary">Lưu</button>
            </form>
            
        </div>
    </div>
</main>