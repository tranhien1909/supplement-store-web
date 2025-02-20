<?php
// Bắt đầu session
session_start();

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error_message" => "Kết nối thất bại!"]));
}

// Lấy thông tin từ form đăng nhập
$username = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['loginpassword']) ? $_POST['loginpassword'] : '';

// Chuẩn bị câu truy vấn kiểm tra tên đăng nhập hoặc email
$stmt = $conn->prepare("SELECT * FROM users WHERE tendn = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra xem thông tin có tồn tại trong cơ sở dữ liệu không
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Kiểm tra mật khẩu
    if (password_verify($password, $user['matkhau'])) {
        $_SESSION['phone'] = $user['sdt'];
        $_SESSION['email'] = $user['email'];
        
        if ($user['isadmin'] == 1) {
            $_SESSION['ten_dn'] = $user['tendn'];
            $_SESSION['user_name'] = $user['tentk']; // Hoặc giá trị khác nếu cần
            $response["redirect"] = "Admin.php"; // Đường dẫn đến trang admin
        } else {
            $_SESSION['tendn'] = $user['tendn']; 
            $_SESSION['username'] = $user['tentk']; // Cập nhật tên tài khoản cho người dùng thường
            $response["redirect"] = "Index.php"; // Đường dẫn đến trang người dùng
        }
        
        $response["success"] = true;
    } else {
        $response["success"] = false;
        $response["error_message"] = "Mật khẩu không chính xác!";
    }
} else {
    $response["success"] = false;
    $response["error_message"] = "Tên đăng nhập hoặc email không chính xác!";
}

// Gửi phản hồi JSON về client
echo json_encode($response);

$stmt->close();
$conn->close();
?>
