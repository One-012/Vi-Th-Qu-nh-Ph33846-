<?php
class AuthController
{
    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Giả sử bạn có một hàm để xác thực người dùng
            if ($user = $this->authenticate($email, $password)) {
                $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session
                // Kiểm tra quyền truy cập
                if ($user['role'] !== 'admin') {
                     $url_redirect = BASE_URL . 'index.php'; // Chuyển hướng đến trang dashboard
                }else {
                    $url_redirect = BASE_URL . 'admin.php'; // Chuyển hướng đến trang dashboard
                }
               
                header("Location: $url_redirect");
                exit();
            } else {
                echo "Đăng nhập không thành công!";
            }
        }

        require_once PATH_VIEW . 'auth/login.php';
    }

    private function authenticate($email, $password)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Đăng nhập thành công
        }
        return false; // Đăng nhập thất bại
    }
    public function register()
    {
        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['re_password'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $re_password = $_POST['re_password'];
            $email = $_POST['email'];
            if($password !== $re_password) {
                echo "Mật khẩu không khớp!";
                return;
            }
            $password = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu
            $userModel = new UserModel();
            // Giả sử bạn có một hàm để đăng ký người dùng
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password
            ];
            if ($userModel->createUser($data)) {
                echo "Đăng ký thành công!";
                $url_redirect = BASE_URL . 'index.php?action=login';
                header("Location: $url_redirect");
                exit();
            } else {
                echo "Đăng ký không thành công!";
            }
        }

        require_once PATH_VIEW . 'auth/register.php';
    }
    public function logout()
    {
        session_start();
        unset($_SESSION['user']); // Xóa thông tin người dùng khỏi session
        session_destroy(); // Hủy session
        $url_redirect = BASE_URL . 'index.php?action=login'; // Chuyển hướng về trang đăng nhập
        header("Location: $url_redirect");
        exit();
    }   
}