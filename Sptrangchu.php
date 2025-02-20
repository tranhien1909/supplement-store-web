<?php
// Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Đặt số lượng sản phẩm hiển thị
    $limit = 4;

    $sql_discount = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE giagiam > 0 LIMIT 4";
    $result_discount = $conn->query($sql_discount);

    $sql_newest = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE ngayban <= CURDATE() ORDER BY ngayban DESC LIMIT 4";
    $result_newest = $conn->query($sql_newest);

    $sql_best_sellers = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham ORDER BY luotban DESC LIMIT 4";
    $result_best_sellers = $conn->query($sql_best_sellers);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/sanpham.css">
    <title>Sản Phẩm Giảm Giá và Bán Chạy</title>
    <style>
        .header {
            display: flex;
            align-items: center;
            border: 1px solid #466E73;
            margin-bottom: 20px;
            width: 96%;
        }

        .header-left {
            background-color: #466E73;
            color: #ffffff;
            padding: 10px 35px;
            font-size: 20px;
            position: relative;
            display: inline-block;
        }

        .product-container {
            text-align: center;
            margin-left: 8px;
            margin-top: 5px;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(200px, 1fr)); 
            padding: 10px 20px;
            width: 100%;
            margin-left:-16px;
        }
        
    </style>
</head>
<body>
    <div class="product-container" id="newest-products">
        <div class="header">
            <div class="header-left">
                <span>SẢN PHẨM MỚI NHẤT</span>
            </div>
        </div>
        <div class="product-list">
            <?php
                if ($result_newest->num_rows > 0) {
                    while($row = $result_newest->fetch_assoc()) {
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
                        echo '<p class="luotban" style="color: black; font-size: 16px;">Lượt bán: ' . $row["luotban"] . '</p>';
                        echo '<div class="new-label">New</div>'; // Biểu tượng "New"
                        echo '</a>';
                    }
                } else {
                    echo "Không có sản phẩm nào mới.";
                }
            ?>
        </div>
        <div class="view-more" style="margin-top: 20px; font-size: 20px; margin-bottom: 30px;">
            <a href="Allsanpham.php?category=moinhat" class="view-more-btn">Xem thêm</a>
        </div>
    </div>

    <div class="product-container" id="discount-products">
        <div class="header">
            <div class="header-left">
                <span>SẢN PHẨM GIẢM GIÁ</span>
            </div>
            <div class="header-right"></div>
        </div>
        <div class="product-list">
            <?php
            if ($result_discount->num_rows > 0) {
                while($row = $result_discount->fetch_assoc()) {
                    echo '<a href="Thongtinsp.php?masp=' . $row["masp"] . '" class="product-item">'; // Bao sản phẩm trong thẻ <a>
                    echo '<img src="images/' . $row["anh"] . '" alt="' . $row["tensp"] . '" >';
                    echo '<h3 style="margin-top: 20px;">' . $row["tensp"] . '</h3>';
                    echo '<div class="price-container">';
                    echo '<p class="price new-price" style="color: red;  font-size: 18px">' . number_format($row["giagiam"], 0, ',', '.') . ' đ</p>'; 
                    echo '<p class="price old-price" style="color: gray; text-decoration: line-through; margin-left: 10px;">' . number_format($row["gia"], 0, ',', '.') . ' đ</p>'; 
                    echo '</div>';
                    $discountPercentage = (($row["gia"] - $row["giagiam"]) / $row["gia"]) * 100;
                    echo '<div class="discount-label">- ' . round($discountPercentage) . '%</div>'; 
                    echo '<p class="luotban" style="color: black; font-size: 16px;">Lượt bán: ' . $row["luotban"] . '</p>';
                    echo '</a>'; 
                }
            } else {
                echo "Không có sản phẩm nào giảm giá.";
            }
            ?>
        </div>
        <div class="view-more" style="margin-top: 20px; font-size: 20px; margin-bottom: 30px;">
            <a href="Allsanpham.php?category=giamgia" class="view-more-btn">Xem thêm</a>
        </div>
    </div>

    <div class="product-container" id="best-sellers">
        <div class="header">
            <div class="header-left">
                <span>SẢN PHẨM BÁN CHẠY NHẤT</span>
            </div>
            <div class="header-right"></div>
        </div>
        <div class="product-list">
            <?php
            if ($result_best_sellers->num_rows > 0) {
                while($row = $result_best_sellers->fetch_assoc()) {
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
                    echo '<p class="luotban" style="color: black; font-size: 16px;">Lượt bán: ' . $row["luotban"] . '</p>';
                    echo '<div class="new-label">Best Seller</div>'; // Biểu tượng "New"
                    echo '</a>';
                }
            } else {
                echo "Không có sản phẩm nào bán chạy.";
            }
            ?>
        </div>
        <div class="view-more" style="margin-top: 20px; font-size: 20px;">
            <a href="Allsanpham.php?category=banchaynhat" class="view-more-btn">Xem thêm</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
