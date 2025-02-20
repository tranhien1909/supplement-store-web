<?php
    include 'layout/Header.php';

    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Giả sử thông tin người dùng đang đăng nhập đã được lưu trong session
    $fullname = $_SESSION['tendn']; 

    // Truy vấn để lấy dữ liệu lịch sử mua hàng từ bảng chitietdonhang
    $sql = "SELECT ct.madh, sp.tensp, ct.soluong, ct.thanhtien, dh.ngaydat
            FROM chitietdonhang ct 
            JOIN sanpham sp ON ct.masp = sp.masp 
            JOIN donhang dh ON ct.madh = dh.madh
            WHERE dh.tendn = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullname); // Binds parameters
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0px;
            background-color: #fafffd;
        }
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
        }
        .cart-container {
            max-width: 1020px;
            margin-top: 32px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-left: 30px;
            min-height: 400px;
            border: 1px solid #466E73;
        }
        .cart-container h2{
            text-align: center;
            margin-top: 15px;
            margin-bottom: 30px;
        }
        .cart-header {
            display: flex;
            font-weight: bold;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }
        .cart-item {
            display: flex;
            padding: 20px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .empty-message {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }
        .exit-button-container {
            display: flex;
            justify-content: flex-end; /* Aligns the button to the right */
            margin-top: 20px;
            margin-right: 30px; /* Space above the button */
        }
        .exit-button {
            padding: 10px;
            background-color: #65A69A;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none; /* Remove underline from links */
        }
        .exit-button:hover {
            background-color: #466E73; /* Darker green on hover */
        }
        .page-container{
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="banner-container">
        <?php include 'layout/Banner.php'; ?>
    </div>
    <div class="page-container"> 
        <div class="sidebar-container">
            <?php include 'layout/Sidebar.php'; ?>
        </div>
        <div class="cart-container" style="margin-bottom: 20px;">
            <h2>LỊCH SỬ MUA HÀNG</h2>

            <?php if ($result->num_rows > 0): ?>
                <div class="cart-header">
                    <div>Mã ĐH</div>
                    <div style="margin-left: 180px;">Tên sản phẩm</div>
                    <div style="margin-left: 162px;">Số lượng</div>
                    <div style="margin-left: 69px;">Thành tiền</div>
                    <div style="margin-left: 125px;">Ngày đặt</div>
                </div>

                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="cart-item">
                        <div style="width: 130px; text-align: left;"><?php echo htmlspecialchars($row['madh']); ?></div>
                        <div style="width: 440px; text-align: left;"><?php echo htmlspecialchars($row['tensp']); ?></div>
                        <div style="width: 85px; text-align: center;"><?php echo htmlspecialchars($row['soluong']); ?></div>
                        <div style="width: 160px; text-align: right; color: red"><?php echo htmlspecialchars($row['thanhtien']); ?></div>
                        <div style="width: 280px; text-align: right;"><?php echo htmlspecialchars($row['ngaydat']); ?></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="empty-message">Bạn chưa mua gì</p>
            <?php endif; ?>

            <div class="exit-button-container">
                <a href="Index.php" class="exit-button">Quay lại</a>
            </div>
        </div>
    </div>

    <div class="footer" style="">
        <?php
            include 'layout/Footer.php';
        ?>
    </div>
</body>
</html>

<?php
// Đóng kết nối
$stmt->close();
$conn->close();
?>
