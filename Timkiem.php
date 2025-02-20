<?php
    include 'layout/Header.php';

    // Kết nối tới cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xử lý khi form được gửi
    if (isset($_GET['search'])) {
        // Nhận dữ liệu từ form và bảo vệ chống SQL Injection
        $searchTerm = $conn->real_escape_string($_GET['search']);

        if (isset($_SESSION['ten_dn']) && $_SESSION['ten_dn']) {
            $sql = "SELECT * FROM sanpham WHERE (tensp LIKE '%$searchTerm%' OR masp LIKE '%$searchTerm%')";
        } else {
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE '%$searchTerm%'";
        }
        $result = $conn->query($sql);
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" type="text/css" href="css/sanpham.css">
    <style>
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(5, minmax(200px, 1fr)); 
            padding: 10px 20px;
            width: 92%;
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
        <div class="product-container" style="margin-left: 40px; margin-top: 30px">
            <h2 style="font-size: 28px;">Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($searchTerm); ?>"</h2>

            <div class="product-list">
                <?php
                if (isset($result)) {
                    if ($result->num_rows > 0) {
                        // Hiển thị từng sản phẩm tìm thấy
                        while ($row = $result->fetch_assoc()) {
                            echo '<a href="Thongtinsp.php?masp=' . $row["masp"] . '" class="product-item">'; 
                            echo '<img src="images/' . $row["anh"] . '" alt="' . $row["tensp"] . '" >';
                            echo '<h3 style="margin-top: 20px;">' . $row["tensp"] . '</h3>';
                            if ($row["giagiam"] > 0) {
                                echo '<div class="price-container">';
                                echo '<p class="price new-price" style="color: red;  font-size: 18px">' . number_format($row["giagiam"], 0, ',', '.') . ' đ</p>'; 
                                echo '<p class="price old-price" style="color: gray; text-decoration: line-through; margin-left: 10px;">' . number_format($row["gia"], 0, ',', '.') . ' đ</p>'; 
                                echo '</div>';
                                $discountPercentage = (($row["gia"] - $row["giagiam"]) / $row["gia"]) * 100;
                               echo '<div class="discount-label">- ' . round($discountPercentage) . '%</div>'; 
                            } else {
                                echo '<p class="price" style="margin-top: 5px; color: red; font-size: 18px">' . number_format($row["gia"], 0, ',', '.') . ' đ</p>';
                            }

                            echo '<p class="luotban" >Lượt bán: ' . sprintf("%.1f", $row["luotban"]).'k</p>';
                            echo '</a>';
                        }
                    } else {
                        echo "Không có sản phẩm nào.";
                    }
                }
                ?>
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
