<?php
    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Kiểm tra xem masp đã được truyền vào qua URL hay chưa
    if (isset($_GET['masp'])) {
        $masp = $_GET['masp'];

        // Xóa sản phẩm khỏi cơ sở dữ liệu dựa trên masp
        $sql = "DELETE FROM sanpham WHERE masp = '$masp'";

        if ($conn->query($sql) == TRUE) {
            $current_url = $_SERVER['HTTP_REFERER'];  // Lấy URL của trang trước đó
            header("Location: $current_url");
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm: " . $conn->error;
        }
    } else {
        echo "Không có sản phẩm nào để xóa.";
    }


    // Đóng kết nối
    $conn->close();
?>
