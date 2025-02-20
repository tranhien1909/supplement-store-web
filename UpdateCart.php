<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy thông tin từ yêu cầu POST
$productId = $_POST['masp'];
$quantity = $_POST['soluong'];

// Cập nhật số lượng trong giỏ hàng
$sql = "UPDATE giohang SET soluong = $quantity WHERE masp = '$productId'";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

// Đóng kết nối
$conn->close();
?>
