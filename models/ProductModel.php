<?php
class ProductModel extends BaseModel {
    protected $table = 'products';

    /**
     * Lấy tất cả sản phẩm trong database.
     */
    public function getAllProducts($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit; // Tính toán offset dựa trên trang hiện tại và giới hạn sản phẩm trên mỗi trang
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($query);// Chuẩn bị câu lệnh SQL  
        //Prepared Statements để tranh lỗi tấn công SQL Injection      
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT); // Gán giá trị offset với kiểu dữ liệu là số nguyên
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT); // Gán giá trị limit với kiểu dữ liệu là số nguyên
     
        $stmt->execute();// Thực thi câu lệnh SQL
        // FETCH_ASSOC (default): Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
        // FETCH_BOTH : Trả về dữ liệu dạng mảng với key là tên của column và cả số thứ tự của column
        // FETCH_NUM: Trả về dữ liệu dạng mảng với key là số thứ tự của column

        return $stmt->fetchAll(PDO::FETCH_ASSOC);// Trả về tất cả sản phẩm dưới dạng mảng kết hợp
    }
    public function getAllProductsByCategory($categoryId, $page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit; // Tính toán offset dựa trên trang hiện tại và giới hạn sản phẩm trên mỗi trang
        $query = "SELECT * FROM " . $this->table . " WHERE category_id = :category_id ORDER BY id DESC LIMIT :offset, :limit";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProductsByCategory($categoryId) {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " WHERE category_id = :category_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    /**
     * Lấy tổng số sản phẩm trong database.
     */
    public function getTotalProducts() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    /**
     * Lấy sản phẩm theo ID.
     */
    public function getProductById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addProduct($data) {
        $query = "INSERT INTO " . $this->table . " (name, main_image, category_id, price, description) VALUES (:name, :main_image, :category_id, :price, :description)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':main_image', $data['main_image']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':description', $data['description']);
        return $stmt->execute();
    }
    public function editProduct($data) {
        $query = "UPDATE " . $this->table . " SET name = :name, main_image = :main_image, category_id = :category_id, price = :price, description = :description WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':main_image', $data['main_image']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':id', $data['id']);
        return $stmt->execute();
    }
    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}