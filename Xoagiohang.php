<?php
    session_start();
    
    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy email của người dùng từ session
    $fullname = $_SESSION['tendn'];

    // Xóa các sản phẩm trong giỏ hàng của người dùng sau khi đặt hàng
    $sql = "DELETE FROM giohang WHERE tendn = '$fullname'";
    if ($conn->query($sql) === TRUE) {
        echo "Giỏ hàng đã được làm trống.";
    } else {
        echo "Lỗi khi xóa giỏ hàng: " . $conn->error;
    }

    $conn->close();
?>
