<?php
session_start();

$conn = new mysqli("localhost", "root", "", "thucphamchucnang");
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error_message" => "Kết nối thất bại!"]));
}

$response = ["success" => false, "error_message" => ""];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ biểu mẫu
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $admin_code = trim($_POST['admin-code']);

    // Kiểm tra xem các trường có rỗng hay không
    if (empty($username) || empty($fullname) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirm_password)) {
        $response["error_message"] = "Vui lòng điền đầy đủ thông tin!";
    } elseif ($password !== $confirm_password) {
        $response["error_message"] = "Mật khẩu không khớp!";
    } elseif (strlen($password) < 6) {
        $response["error_message"] = "Mật khẩu phải có ít nhất 6 ký tự!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["error_message"] = "Email không hợp lệ!";
    } else {
        // Kiểm tra email và số điện thoại đã tồn tại
        $stmt_check = $conn->prepare("SELECT * FROM users WHERE tendn = ? OR email = ? OR sdt = ?");
        $stmt_check->bind_param("sss", $fullname, $email, $phone);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $response["error_message"] = "Tên đăng nhập hoặc email hoặc số điện thoại đã tồn tại!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Thiết lập mặc định isAdmin là 0
            $isAdmin = 0; 

            // Kiểm tra mã admin
            if (!empty($admin_code) && $admin_code === '06081104') {
                $isAdmin = 1; // Nếu mã admin đúng
            }

            $stmt = $conn->prepare("INSERT INTO users (tentk, tendn, email, sdt, diachi, matkhau, isadmin) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $username, $fullname, $email, $phone, $address, $hashed_password, $isAdmin);
            
            if ($stmt->execute()) {
                $response["success"] = true;  // Dùng username để lưu vào session
                $_SESSION['phone'] = $phone;
                $_SESSION['email'] = $email;
                if ($isAdmin == 1) {
                    $_SESSION['ten_dn'] = $fullname;
                    $_SESSION['user_name'] = $username; // Admin: use username
                } else {
                    $_SESSION['tendn'] = $fullname;
                    $_SESSION['username'] = $username; // Non-admin: use fullname
                } 
            } else {
                $response["error_message"] = "Đăng ký thất bại!";
            }
        }
    }
    echo json_encode($response);
    exit();
}
?>
