<?php
    include 'layout/HeaderAdmin.php';
    $success_message = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Kết nối cơ sở dữ liệu
        $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Lấy dữ liệu từ form
        $masp = $_POST['masp'];
        $tensp = $_POST['tensp'];
        $gia = $_POST['gia'];
        $giagiam = $_POST['giagiam'];
        $luotban = $_POST['luotban'];
        $mota = $_POST['mota'];
        $chitiet = $_POST['chitiet'];
        $thanhphan = $_POST['thanhphan'];
        $doituong = $_POST['doituong'];
        $cachsd = $_POST['cachdung'];
        $ngayban = $_POST['ngayban'];

        // Xử lý ảnh
        $anh = $_FILES['anh']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($anh);

        // Kiểm tra và di chuyển file ảnh
        if (move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)) {
            // Thêm sản phẩm vào cơ sở dữ liệu
            $sql = "INSERT INTO sanpham (masp, tensp, anh, gia, giagiam, luotban, mota, chitiet, thanhphan, cachdung, doituong, ngayban) VALUES ('$masp', '$tensp', '$anh', '$gia', '$giagiam', '$luotban', '$mota', '$chitiet', '$thanhphan', '$cachsd', '$doituong', '$ngayban')";

            if ($conn->query($sql) === TRUE) {
                $success_message = "Thêm sản phẩm thành công!";
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Không thể tải lên file ảnh.";
        }

        // Đóng kết nối
        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm Sản Phẩm</title>
    <style>
        body {
            background-color: #fafffd;
        }
        .themsp {
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
        h2 {
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
            margin-bottom: 10px;
        }
        label {
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
        input {
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
            margin-left: 320px;
            margin-top: 10px;
            width: 150px;
            border: 0px;
        }
        .page-container {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <?php include 'layout/SidebarAdmin.php'; ?>
    </div>
    <?php if ($success_message): ?>
        <div id="notification" style="padding: 10px; margin-bottom: 20px; border-radius: 5px; background-color: #f0f0f0; color: #333; width: 300px; margin-left: 700px; text-align: center;">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    <div class="themsp">
        <h2>Thêm Sản Phẩm</h2>
        <form action="Themsanpham.php" method="POST" enctype="multipart/form-data" id="themmoi">
            <label for="masp">Mã sản phẩm:</label>
            <input type="text" id="masp" name="masp" required><br>
            <label for="tensp">Tên sản phẩm:</label>
            <input type="text" id="tensp" name="tensp" required><br>
            <label for="anh">Ảnh sản phẩm:</label>
            <input type="file" id="anh" name="anh" accept="images/*" required><br>
            <label for="gia">Giá:</label>
            <input type="text" id="gia" name="gia" required><br>
            <label for="giagiam">Giá giảm:</label>
            <input type="text" id="giagiam" name="giagiam" value="0"><br>
            <label for="luotban">Lượt bán:</label>
            <input type="text" id="luotban" name="luotban" required><br>
            <label for="mota" class="mt" style="margin-top: 5px;">Mô Tả:</label>
            <textarea id="mota" name="mota" rows="4" required></textarea><br>
            <label for="chitiet" class="mt" style="margin-top: 5px;">Thông tin CT:</label>
            <textarea id="chitiet" name="chitiet" rows="4" required></textarea><br>
            <label for="thanhphan" class="mt" style="margin-top: 5px;">Thành Phần:</label>
            <textarea id="thanhphan" name="thanhphan" rows="4" required></textarea><br>
            <label for="cachdung" class="mt" style="margin-top: 5px;">Cách Sử Dụng:</label>
            <textarea id="cachdung" name="cachdung" rows="4" required></textarea><br>
            <label for="doituong" class="mt" style="margin-top: 5px;">Đối Tượng:</label>
            <textarea id="doituong" name="doituong" rows="4" required></textarea><br>
            <label for="ngayban">Ngày bán:</label>
            <input type="date" id="ngayban" name="ngayban" required><br>
            <button type="submit">Thêm Sản Phẩm</button>
        </form>
    </div>
    <script>
        // Tự động thiết lập ngày hiện tại cho input ngày bán
        document.addEventListener("DOMContentLoaded", function() {
            const ngayBanInput = document.getElementById("ngayban");
            const today = new Date().toISOString().split("T")[0];
            ngayBanInput.value = today;
        });
    </script>
</body>
</html>
