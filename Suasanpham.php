<?php
include 'layout/HeaderAdmin.php';
$success_message = '';
$error_message = '';

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "thucphamchucnang");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có mã sản phẩm không
if (isset($_GET['masp'])) {
    $masp = $_GET['masp'];

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM sanpham WHERE masp = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $masp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Sản phẩm không tồn tại.");
    }

    // Xử lý dữ liệu khi gửi form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tensp = $_POST['tensp'];
        $gia = (float)$_POST['gia'];
        $giagiam = (float)$_POST['giagiam'];
        $luotban = (int)$_POST['luotban'];
        $mota = $_POST['mota'];
        $chitiet = $_POST['chitiet'];
        $thanhphan = $_POST['thanhphan'];
        $cachsd = $_POST['cachdung'];
        $doituong = $_POST['doituong'];
        $ngayban = $_POST['ngayban'];

        // Xử lý upload hình ảnh nếu có
        if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
            $anh = $_FILES['anh']['name'];
            $target_dir = "images/";
            $target_file = $target_dir . basename($anh);
            move_uploaded_file($_FILES['anh']['tmp_name'], $target_file);
        } else {
            $anh = $product['anh']; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        }

        // Cập nhật sản phẩm
        $sql_update = "UPDATE sanpham SET tensp = ?, anh = ?, gia = ?, giagiam = ?, luotban = ?, mota = ?, chitiet = ?, thanhphan = ?, cachdung = ?, doituong = ?,  ngayban = ? WHERE masp = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssiiisssssss", $tensp, $anh, $gia, $giagiam, $luotban, $mota, $chitiet, $thanhphan,     $cachsd, $doituong, $ngayban, $masp);

        if ($stmt_update->execute()) {
            $success_message = "Cập nhật sản phẩm thành công.";
        } else {
            $error_message = "Lỗi cập nhật sản phẩm: " . $stmt_update->error;
        }
    }
} else {
    die("Mã sản phẩm không được cung cấp.");
}

$conn->close(); // Đóng kết nối sau khi hoàn tất tất cả các thao tác
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sửa Sản Phẩm</title>
    <style>
        body{
            background-color: #fafffd;
        }
        .suasp{
            display: inline-block;
            border-radius: 4px;
            width: 50%;
            background-color: white;
            border: 2px solid black;
            text-align: left;
            font-family: Arial, sans-serif;
            margin-top: 25px;
            margin-left: 450px;
            margin-bottom: 30px;
        }
        h2{
            margin-top: 10px;
            padding-top: 10px; 
            padding-bottom: 8px; 
            border-radius: 4px;
            font-size: 23px;
            text-align: center;
            margin-bottom: 10px;
        }
        textarea {
            width: 450px; 
            margin-bottom: 10px;/* Center text in textarea */
        }
        label{
            display: inline-block;
            margin-bottom: 20px;
            width: 190px;
            font-size: 17px;
            text-align: left;
            margin-left: 30px;
        }

        .mt {
            vertical-align: top;
        }

        input{
            padding: 8px;
            border: 1px solid #466E73;
            border-radius: 4px;
            font-size: 14px;
            width: 450px;
        }
        button {
            background-color: #65A69A;
            color: white;
            padding: 8px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
            margin-left: 260px;
            margin-top: 10px;
            width: 250px;
            border: 0px;
        }
        .page-container{
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <?php include 'layout/SidebarAdmin.php';?>
    </div>
    <?php if ($success_message): ?>
        <div id="notification" style="color: green; text-align: center; margin-bottom: 10px;">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <?php if ($error_message): ?>
        <div id="notification" style="color: red; text-align: center; margin-bottom: 10px;">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <div class="suasp">
        <h2>Sửa Sản Phẩm</h2>
        <form action="Suasanpham.php?masp=<?php echo $masp; ?>" method="POST" enctype="multipart/form-data" id="suasp">
            <label for="masp">Mã sản phẩm:</label>
            <input type="text" id="masp" name="masp" value="<?php echo $product['masp']; ?>" readonly><br>
            <label for="tensp">Tên sản phẩm:</label>
            <input type="text" id="tensp" name="tensp" value="<?php echo $product['tensp']; ?>" required><br>
            <label for="anh">Ảnh sản phẩm:</label>
            <input type="file" id="anh" name="anh" accept="image/*"><br>
            <label for="gia">Giá:</label>
            <input type="text" id="gia" name="gia" value="<?php echo $product['gia']; ?>" required><br>
            <label for="giagiam">Giá giảm:</label>
            <input type="text" id="giagiam" name="giagiam" value="<?php echo $product['giagiam']; ?>"><br>
            <label for="luotban">Lượt bán:</label>
            <input type="text" id="luotban" name="luotban" value="<?php echo $product['luotban']; ?>" required><br>
            <label for="mota" class="mt" style="margin-top: 5px;">Mô Tả:</label>
            <textarea id="mota" name="mota" rows="4" required><?php echo $product['mota']; ?></textarea><br>
            <label for="ctiet" class="mt" style="margin-top: 5px;">Thông tin CT:</label>
            <textarea id="chitiet" name="chitiet" rows="4" required><?php echo $product['chitiet']; ?></textarea><br>
            <label for="tp" class="mt" style="margin-top: 5px;">Thành Phần:</label>
            <textarea id="thanhphan" name="thanhphan" rows="4" required><?php echo $product['thanhphan']; ?></textarea><br>
            <label for="csd" class="mt" style="margin-top: 5px;">Cách Sử Dụng:</label>
            <textarea id="cachdung" name="cachdung" rows="4" required><?php echo $product['cachdung']; ?></textarea><br>
            <label for="dtg" class="mt" style="margin-top: 5px;">Đối Tượng:</label>
            <textarea id="doituong" name="doituong" rows="4" required><?php echo $product['doituong']; ?></textarea><br>
            <label for="ngayban">Ngày bán:</label>
            <input type="date" id="ngayban" name="ngayban" value="<?php echo $product['ngayban']; ?>" required><br>
            <button type="submit">Cập Nhật Sản Phẩm</button>
        </form>
    </div>
    <script>
        // Ẩn thông báo sau 3 giây
        setTimeout(function() {
            const successNotification = document.getElementById('success-notification');
            const errorNotification = document.getElementById('error-notification');
            if (successNotification) {
                successNotification.style.display = 'none';
            }
            if (errorNotification) {
                errorNotification.style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>
