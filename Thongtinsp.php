<?php
    session_start(); 

    $isLoggedIn = isset($_SESSION['tendn']); 

    // Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $masp = isset($_GET['masp']) ? $_GET['masp'] : '';

    // Truy vấn để lấy thông tin sản phẩm
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
    $stmt->close();

    function formatDescription($description) {
        // Thay thế các thẻ <br /> bằng một chuỗi xuống dòng
        $formattedDescription = str_replace('<br />', "\n", $description);
        $paragraphs = explode("\n", $formattedDescription);
        $listItems = '';

        foreach ($paragraphs as $para) {
            $para = trim($para);
            if (!empty($para)) {
                // Sử dụng htmlspecialchars để bảo vệ dữ liệu đầu vào
                $listItems .= '<li>' . htmlspecialchars($para) . '</li>';
            }
        }

        return $listItems;
    }


    $notification = ""; // Khởi tạo thông báo
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        $productId = $product['masp']; // ID sản phẩm

        if (!$isLoggedIn) {
            // Nếu chưa đăng nhập, hiển thị thông báo yêu cầu đăng nhập
            $notification = "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.";
        } else {
            // Nếu đã đăng nhập, lưu vào cơ sở dữ liệu
            $tentk = $_SESSION['username'];
            $fullname =  $_SESSION['tendn'];
            $sql = "INSERT INTO giohang ( tendn, masp, soluong) VALUES (?, ?, ?)
                    ON DUPLICATE KEY UPDATE soluong = soluong + VALUES(soluong)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $fullname, $productId, $quantity);
            $stmt->execute();
            $stmt->close();
            
            $notification = "Thêm sản phẩm vào giỏ hàng thành công.";
        }

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $_SESSION['cart_count'] = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] + $quantity : $quantity;
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['tensp']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafffd;
            margin: 0;
            padding: 0;
        }
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
        }
        .product-container {
            width: 70%;
            margin-top: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            min-height: 400px;
            margin-bottom: 30px;
            border: 2px solid #466E73;
        }
        .product-item img {
            position: relative;
            max-width: 80%;
            object-fit: cover; 
        }
        .product-info {
            flex: 2;
        }
        .product-title {
            margin-top: 27px;
            font-size: 28px;
            color: #333;
        }
        .product-titles {
            margin-top: 40px;
            font-size: 32px;
            color: #333;
            text-align: center;
        }
        .price {
            font-size: 18px;
            color: red;
            font-weight: bold;
        }
        .product-description {
            margin: 15px 0;
            line-height: 1.6;
        }
        .ingredient-list {
            list-style-type: none;
            padding: 0;
        }
        .quantity-container {
            margin-top: 15px;
        }
        .quantity-input {
            width: 50px;
            height: 30px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .add-to-cart {
            background-color: #65A69A;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        .add-to-cart:hover {
            background-color: #466E73;
        }
        .notification {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            display: none; 
            margin-left: 600px;
            width: 450px;/* Ẩn thông báo mặc định */
            text-align: center;
        }
        .description-list {
            list-style-type: disc;
            margin-top: 20px;
            padding-left: 45px;
        }
        .description-list li {
            color: #333;
            margin-bottom: 10px;
            font-size: 17px;
        }
        .price-container {
            display: flex; /* Sử dụng Flexbox */
            margin-top: 10px;
            margin-left: 5PX;
        }

        .old-price {
            text-decoration: line-through; /* Gạch ngang cho giá cũ */
            color: #999;
            margin-left: 10px;
            font-size: 16px; /* Màu sắc cho giá cũ */
        }

        .new-price {
            color: red; /* Màu sắc cho giá mới */
            font-weight: bold;
            font-size: 18px;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }

        .page-container{
            margin: 10px;
        }
        .tieude{
            margin-left: -30px; 
            display: inline-block; 
            margin-bottom: 15px; 
            font-style: bold;
            font-size: 19px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <?php
        include 'layout/Header.php';
    ?> 
    <div class="banner-container">
        <?php include 'layout/Banner.php'; ?>
    </div>
    <div class="notification" id="notification" style="margin-top: 20px"></div> 
    <div class="page-container"> 
        <div class="sidebar-container">
            <?php include 'layout/Sidebar.php'; ?>
        </div>
        <div class="product-container" style="margin-left: 30px;">
            <?php
                $imagePath = "images/" . htmlspecialchars($product['anh']);
            ?>
            <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($product['tensp']); ?>" class="product-image" style="margin-right: 60px; max-height: 350px; margin-top: 20px;">
            <div class="product-info">
                <h1 class="product-title"><?php echo htmlspecialchars($product['tensp']); ?></h1>
                <?php 
                    if ($product['giagiam'] > 0) {
                        echo '<div class="price-container">';
                            echo '<p class="new-price">' . number_format($product['giagiam'], 0, ',', '.') . ' đ</p>'; 
                            echo '<p class="old-price">' . number_format($product['gia'], 0, ',', '.') . ' đ</p>'; 
                        echo '</div>';
                    } else {
                        echo '<p class="price" style="margin-top: 10px;">' . number_format($product['gia'], 0, ',', '.') . ' VNĐ</p>';
                    }
                ?>
                <ul class="description-list">
                    <?php echo formatDescription(htmlspecialchars($product['mota'])); ?>
                </ul>
                <form method="POST" action="">
                    <div class="quantity-container">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" id="quantity" name="quantity" class="quantity-input" value="1" min="1">
                    </div>
                    <button type="submit" class="add-to-cart" name="add_to_cart">Thêm vào giỏ hàng</button>
                </form>
            </div>
            <ul class="description-list">
                <h1 class="product-titles"><?php echo htmlspecialchars($product['tensp']); ?></h1>
                <h1 class="product-titles" style="font-size: 22px; margin-top: 10px">( Một số thông tin khác)</h1>
                <h2 class="tieude">Thông tin chi tiết: </h2>
                <?php echo formatDescription(htmlspecialchars($product['chitiet'])); ?>
                <h2 class="tieude">Thành phần chính: </h2>
                <?php echo formatDescription(htmlspecialchars($product['thanhphan'])); ?>
                <h2 class="tieude">Đối tượng sử dụng: </h2>
                <?php echo formatDescription(htmlspecialchars($product['doituong'])); ?>
                <h2 class="tieude">Cách sử dụng sản phẩm: </h2>
                <?php echo formatDescription(htmlspecialchars($product['cachdung'])); ?>
                <h2 class="tieude">Lưu ý: Sản phẩm không phải là thuốc và không có tác dụng thay thế thuốc chữa bệnh </h2>
            </ul>
        </div>
    </div>
    <div>
        <?php
            include 'layout/Footer.php';
        ?>
    </div>
    <script>
        // Hiển thị thông báo sau khi trang đã được tải
        let notification = "<?php echo addslashes($notification); ?>";
        if (notification) {
            const notificationElement = document.getElementById("notification");
            document.getElementById("notification").innerHTML = notification;
            document.getElementById("notification").style.display = "block";
            setTimeout(function() {
                notificationElement.style.display = "none";
            }, 1000); 
        }
    </script>
</body>
</html>
