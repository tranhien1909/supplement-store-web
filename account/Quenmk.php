<?php
session_start();
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['fullname'];
    $email = $_POST['email'];

    // Kiểm tra tên đăng nhập và email có tồn tại trong cơ sở dữ liệu không
    $sql = "SELECT * FROM users WHERE tendn = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['maxacnhan'] != null) {
            echo json_encode(['success' => true, 'verification-code' => $row['maxacnhan']]);
        } else {
            // Tạo mã xác thực 6 chữ số ngẫu nhiên
            $verificationCode = rand(100000, 999999);
            
            // Cập nhật mã xác thực vào cơ sở dữ liệu
            $sqlUpdate = "UPDATE users SET maxacnhan = ? WHERE tendn = ? AND email = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("sss", $verificationCode, $username, $email);
            
            if ($stmtUpdate->execute()) {
                // Trả về mã mới
                echo json_encode(['success' => true, 'verification-code' => $verificationCode]);
            } else {
                // Xử lý lỗi nếu không thể lưu mã xác thực vào cơ sở dữ liệu
                echo json_encode(['success' => false, 'error_message' => 'Không thể lưu mã xác thực vào cơ sở dữ liệu!']);
            }
            $stmtUpdate->close();
        }
    } else {
        // Thông tin không chính xác
        echo json_encode(['success' => false, 'error_message' => 'Tên đăng nhập hoặc email không chính xác!']);
    }

    $stmt->close();
}

$conn->close();
?>
