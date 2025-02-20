<?php
session_start(); // Khởi động phiên
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error_message" => "Kết nối thất bại!"]));
}

// Nhận dữ liệu JSON từ fetch
$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra dữ liệu nhận được
var_dump($data); // Kiểm tra dữ liệu nhận được

// Lấy các giá trị từ dữ liệu POST
$tentk = $data['tentk'] ?? '';
$email = $data['email'] ?? '';
$sdt = $data['sdt'] ?? '';
$diachi = $data['diachi'] ?? '';

$current_password = $data['current_password'] ?? '';
$new_password = $data['new_password'] ?? '';
$confirm_password = $data['confirm_password'] ?? '';

// Tên đăng nhập từ session
$tendn = $_SESSION['tendn'] ?? '';

if (empty($tendn)) {
    echo json_encode(["success" => false, "error_message" => "Người dùng chưa đăng nhập."]);
    exit;
}

// Cập nhật các trường thông tin khác
$query = "UPDATE users SET tentk = ?, email = ?, sdt = ?, diachi = ? WHERE tendn = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssss", $tentk, $email, $sdt, $diachi, $tendn);

// Kiểm tra nếu có lỗi khi thực thi câu truy vấn
if (!$stmt->execute()) {
    echo json_encode(["success" => false, "error_message" => "Lỗi cập nhật thông tin: " . $stmt->error]);
    exit;
} else {
    echo json_encode(["success" => true, "message" => "Thông tin đã được cập nhật."]);
}


// Nếu cả 3 trường mật khẩu đều không trống, cập nhật mật khẩu
if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
    $query = "SELECT matkhau FROM users WHERE tendn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tendn);
    $stmt->execute();
    $result = $stmt->get_result();
    $userdata = $result->fetch_assoc();

    if (password_verify($current_password, $userdata['matkhau'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET matkhau = ? WHERE tendn = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $hashed_password, $tendn);
            if (!$stmt->execute()) {
                echo json_encode(["success" => false, "error_message" => "Lỗi cập nhật mật khẩu: " . mysqli_error($conn)]);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "error_message" => "Mật khẩu mới và xác nhận mật khẩu không khớp."]);
            exit;
        }
    } else {
        echo json_encode(["success" => false, "error_message" => "Mật khẩu hiện tại không đúng."]);
        exit;
    }
}

echo json_encode(["success" => true]);
$conn->close();
?>
