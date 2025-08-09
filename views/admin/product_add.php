<!-- Main content -->
<main class="col-md-9 col-lg-10 content">
    <h2>Quản lý sản phẩm</h2>
    
    <div class="card">
        <div class="card-header">
            <strong>Nhập thông tin sản phẩm cần thêm</strong>
            
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="main_image">Ảnh đại diện</label>
                    <input type="file" class="form-control" id="main_image" name="main_image" placeholder="Ảnh đại diện">
                    
                </div>
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Chọn danh mục</option>
                        <!-- Giả sử có một mảng $categories chứa danh sách danh mục -->
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                
                </div>
                <div class="form-group">
                    <label for="price">Giá sản phẩm</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="name">Mô tả sản phẩm</label>
                    <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                </div>
                
                <button type="submit" name="add" class="btn btn-primary">Lưu</button>
            </form>
            
        </div>
    </div>
</main>