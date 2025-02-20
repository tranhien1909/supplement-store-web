<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AT - THỰC PHẨM CHỨC NĂNG</title>
    <link rel="stylesheet" href="css/sanpham.css">
    <style>
        body {
            width: 100%; /* Đảm bảo chiều rộng 100% */
            overflow-x: hidden; /* Ngăn cuộn ngang */
            margin: 0; /* Bỏ margin mặc định */
            padding: 0; /* Bỏ padding mặc định */
        }
        .page-container {
            display: flex;
            background-color: #fafffd;
        }
        .product-container {
            margin-left: 320px;
            padding: 10px; /* Padding cho nội dung sản phẩm */
            flex-grow: 1; /* Làm cho product-container chiếm không gian còn lại */
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(200px, 1fr));
            gap: 25px; /* Thêm khoảng cách giữa các sản phẩm nếu cần */
            padding: 0 20px;
            width: 98%;
            margin-top: 30px;
        }
        .chinhsua{
            margin: auto;
        }
    </style>
</head>
<body>
    <?php
        include 'layout/HeaderAdmin.php';
    ?> 
    <div class="page-container"> 
        <?php include 'layout/SidebarAdmin.php'; ?>
        <div class="product-container" style="margin-left: 330px; margin-bottom: 60px;">
            <h2 style="text-align: center;">DANH SÁCH SẢN PHẨM</h2> <!-- Tiêu đề danh sách sản phẩm -->
            <div class="product-list">
                <?php
                    // Kết nối cơ sở dữ liệu
                    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }

                    // Truy vấn tất cả sản phẩm
                    $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham";
                    $result = $conn->query($sql);

                    // Hiển thị sản phẩm
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="product-item" style="height: 400px">';
                            echo '<p style="font-weight: bold; font-size: 17.5px">Mã:  ' . $row["masp"] . '</p>';
                            echo '<img src="images/' . $row["anh"] . '" alt="' . $row["tensp"] . '"  style="margin-top: 13px; height: 190px;">';
                            echo '<h3 style="margin-bottom: 10px;">' . $row["tensp"] . '</h3>';
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

                            echo '<p class="luotban" >Lượt bán: ' .$row["luotban"]. '</p>';
                            echo '<div style="display: flex; gap: 4px; margin-top: 12px;">';
                                if ($isLoggedIn) {
                                    echo '<a href="Suasanpham.php?masp=' . $row["masp"] . '" class="chinhsua" style="width: 70px;">Sửa</a>';
                                    echo '<a href="Xoasanpham.php?masp=' . $row["masp"] . '" class="chinhsua" style="width: 70px;">Xóa</a>'; // Delete button
                                } else {
                                    echo '<span class="chinhsua" style="cursor: not-allowed;">Sửa</span>';
                                    echo '<span class="chinhsua" style="cursor: not-allowed;">Xóa</span>';
                                }
                            echo '</div>'; // Delete button
                            echo '</div>';
                        }
                    } else {
                        echo "Không có sản phẩm nào.";
                    }

                    // Đóng kết nối
                    $conn->close();
                ?>
            </div>
        </div>
    </div>
    <div >
        <?php
            include 'layout/FooterAdmin.php';
        ?>
    </div>
</body>
</html>
