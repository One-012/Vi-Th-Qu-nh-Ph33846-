<?php
class CategoryModel extends BaseModel {
    protected $table = 'categories';

    /**
     * Lấy tất cả danh mục trong database.
     */
    public function getAllCategories() {
        $query = "SELECT * FROM " . $this->table; // Viết câu lệnh SQL để lấy tất cả danh mục
        $stmt = $this->pdo->prepare($query); // Chuẩn bị câu lệnh SQL
        $stmt->execute(); // Thực thi câu lệnh SQL
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả danh mục dưới dạng mảng kết hợp
    }
    public function getCategoryById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id"; // Viết câu lệnh SQL để lấy danh mục theo ID
        $stmt = $this->pdo->prepare($query); // Chuẩn bị câu lệnh SQL
        $stmt->bindParam(':id', $id); // Gán giá trị ID vào câu lệnh SQL
        $stmt->execute(); // Thực thi câu lệnh SQL
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về danh mục dưới dạng mảng kết hợp
    }
    /**
     * Thêm danh mục mới vào database.
     */
    public function addCategory($data) {
        $query = "INSERT INTO " . $this->table . " (name, description) VALUES (:name, :description)"; // Viết câu lệnh SQL để thêm danh mục
        $stmt = $this->pdo->prepare($query); // Chuẩn bị câu lệnh SQL
        $stmt->bindParam(':name', $data['name']); // Gán giá trị tên danh mục vào câu lệnh SQL
        $stmt->bindParam(':description', $data['description']); // Gán giá trị mô tả danh mục vào câu lệnh SQL
        return $stmt->execute(); // Thực thi câu lệnh SQL và trả về kết quả
    }
    /**
     * Cập nhật danh mục theo ID.
     */
    public function editCategory($data) {
        $query = "UPDATE " . $this->table . " SET name = :name, description = :description WHERE id = :id"; // Viết câu lệnh SQL để cập nhật danh mục
        $stmt = $this->pdo->prepare($query); // Chuẩn bị câu lệnh SQL
        $stmt->bindParam(':name', $data['name']); // Gán giá trị tên danh mục vào câu lệnh SQL
        $stmt->bindParam(':description', $data['description']); // Gán giá trị mô tả danh mục vào câu lệnh SQL
        $stmt->bindParam(':id', $data['id']); // Gán giá trị ID vào câu lệnh SQL
        return $stmt->execute(); // Thực thi câu lệnh SQL và trả về kết quả 
    }
    /**
     * Xóa danh mục theo ID.
     */
    public function deleteCategory($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id"; // Viết câu lệnh SQL để xóa danh mục
        $stmt = $this->pdo->prepare($query); // Chuẩn bị câu lệnh SQL
        $stmt->bindParam(':id', $id); // Gán giá trị ID vào câu lệnh SQL
        return $stmt->execute(); // Thực thi câu lệnh SQL và trả về kết quả
    }
    

}