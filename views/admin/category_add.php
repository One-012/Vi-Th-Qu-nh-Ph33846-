<!-- Main content -->
<main class="col-md-9 col-lg-10 content">
    <h2>Quản lý danh mục</h2>
    
    <div class="card">
        <div class="card-header">
            <strong>Nhập thông tin danh mục</strong>
            
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục">
                </div>
             
                <div class="form-group">
                    <label for="name">Mô tả danh mục</label>
                    <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                </div>
                
                <button type="submit" name="add" class="btn btn-primary">Lưu</button>
            </form>
            
        </div>
    </div>
</main>