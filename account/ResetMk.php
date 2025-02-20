<?php
session_start();
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error_message' => 'Kết nối thất bại: ' . $conn->connect_error]));
}

// Kiểm tra xem người dùng đã nhập dữ liệu hay chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ POST
    $verificationCode = $_POST['maxacnhan']; 
    $username = $_POST['fullname']; 
    $email = $_POST['email']; 
    $newPassword = $_POST['new-password']; 
    $confirmPassword = $_POST['confirm-new-password'];

    // Kiểm tra thông tin đầu vào
    if (empty($username) || empty($email) || empty($verificationCode)) {
        echo json_encode(['success' => false, 'error_message' => 'Thông tin không được để trống.']);
        exit;
    }

    // Kiểm tra mã xác thực trong cơ sở dữ liệu
    $sql = "SELECT maxacnhan FROM users WHERE tendn = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die(json_encode(['success' => false, 'error_message' => 'Không thể chuẩn bị câu truy vấn: ' . $conn->error]));
    }
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedVerificationCode = $row['maxacnhan'];

        // So sánh mã xác thực
        if ($storedVerificationCode != $verificationCode) {
            echo json_encode(['success' => false, 'error_message' => 'Mã xác nhận không hợp lệ!']);
            exit;
        }

        // Kiểm tra mật khẩu nhập lại
        if ($newPassword != $confirmPassword) {
            echo json_encode(['success' => false, 'error_message' => 'Mật khẩu không khớp!']);
            exit; // Kết thúc script nếu mật khẩu không khớp
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Mã hóa mật khẩu

        // Bắt đầu transaction để đảm bảo cập nhật mật khẩu
        $conn->begin_transaction();

        try {
            $sql_dangky = "UPDATE users SET matkhau = ?, maxacnhan = NULL WHERE tendn = ? AND email = ?";
            $stmt_dangky = $conn->prepare($sql_dangky);
            if (!$stmt_dangky) {
                throw new Exception("Không thể chuẩn bị câu truy vấn: " . $conn->error);
            }
            $stmt_dangky->bind_param("sss", $hashedPassword, $username, $email);
            if (!$stmt_dangky->execute()) {
                error_log("Cập nhật mật khẩu trong bảng dangky thất bại: " . $stmt_dangky->error);
                throw new Exception("Không thể cập nhật mật khẩu.");
            }

            // Nếu cả hai câu truy vấn thành công, commit transaction
            $conn->commit();
            echo json_encode(['success' => true, 'message' => 'Mật khẩu đã được cập nhật thành công.']);
        } catch (Exception $e) {
            // Nếu có lỗi, rollback transaction
            $conn->rollback();
            echo json_encode(['success' => false, 'error_message' => 'Có lỗi xảy ra khi cập nhật mật khẩu: ' . $e->getMessage()]);
        } finally {
            // Đóng các statement
            if (isset($stmt_dangky)) {
                $stmt_dangky->close();
            }
            $stmt->close();
        }
    } else {
        // Thông tin không chính xác
        echo json_encode(['success' => false, 'error_message' => 'Tên đăng nhập hoặc email không chính xác!']);
    }
}

$conn->close();
?>
