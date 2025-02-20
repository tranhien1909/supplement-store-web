<?php
session_start();
date_default_timezone_set('Asia/Ha_Noi'); // Thiết lập múi giờ

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận dữ liệu từ request
$data = json_decode(file_get_contents("php://input"), true);

// Lấy thông tin đơn hàng
$ten = $data['ten'];
$sdt = $data['sdt'];
$diachi = $data['diachi'];
$products = $data['products'];
$tongtien = $data['tongtien'];
$ngaydat = date('Y-m-d H:i:s'); // Lấy ngày đặt hàng hiện tại

// Thêm đơn hàng vào bảng `donhang`
$sql = "INSERT INTO donhang (tendathang, tendn, sdt, diachi, tongtien, ngaydat) VALUES ('$ten', '".$_SESSION['tendn']."', '$sdt', '$diachi', '$tongtien', '$ngaydat')";

if ($conn->query($sql) === TRUE) {
    $orderId = $conn->insert_id; // Lấy ID của đơn hàng vừa tạo
    foreach ($products as $product) {
        $masp = $product['id'];
        $soluong = $product['quantity'];
        $thanhtien = $product['itemTotal'];
        $sqlDetail = "INSERT INTO chitietdonhang (madh, masp, soluong, thanhtien) VALUES ('$orderId', '$masp', '$soluong', '$thanhtien')";
        $conn->query($sqlDetail);

        // Tăng lượt bán của sản phẩm
        $sqlUpdateSales = "UPDATE sanpham SET luotban = luotban + $soluong WHERE masp = '$masp'";
        $conn->query($sqlUpdateSales);
    }

    // Trả về thông tin mã đơn hàng sau khi đặt thành công
    echo json_encode(['status' => 'success', 'madh' => $orderId]);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

$conn->close();
?>
