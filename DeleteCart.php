<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ yêu cầu AJAX
if (isset($_POST['masp'])) {
    $productId = $_POST['masp'];
    $fullname = $_SESSION['tendn']; // ID của tài khoản người dùng đang đăng nhập

    // Thực hiện xóa sản phẩm
    $sql = "DELETE FROM giohang WHERE tendn = '$fullname' AND masp = '$productId'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Không thể xóa sản phẩm."]);
    }
}

// Đóng kết nối
$conn->close();
?>
