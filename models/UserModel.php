<?php
class UserModel extends BaseModel {
    protected $table = 'users';

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data) {
        $sql = "INSERT INTO {$this->table} (name, email, phone, password) VALUES (:name, :email, :phone, :password)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
}   