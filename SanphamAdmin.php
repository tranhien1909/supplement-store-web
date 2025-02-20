<?php
    include 'layout/HeaderAdmin.php';
// Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $isLoggedIn = isset($_SESSION['ten_dn']);
    // Xử lý tham số category từ AJAX hoặc URL
    $categoryad = isset($_GET['categoryad']) ? $_GET['categoryad'] : '';
    $sql = ''; // Đảm bảo biến $sql được khởi tạo trước

    switch ($categoryad) {
        case 'gan':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'GAN%'";
            break;
        case 'bomnt':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'MNT%'";
            break;
        case 'sly':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'SL%'";
            break;
        case 'uthu':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'UT%'";
            break;
        case 'thoa':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'TH%'";
            break;
        case 'gcan':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'GC%'";
            break;
        case 'ldep':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'LD%'";
            break;
        case 'vita':
            $title = " ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'V%'";
            break;
        case 'moi':
            $title = "SẢN PHẨM MỚI NHẤT";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham ORDER BY ngayban DESC LIMIT 10";
            break;
        case 'giam':
            $title = "SẢN PHẨM ĐANG GIẢM GIÁ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE giagiam > 0";
            break;
        case 'banchay':
            $title = "SẢN PHẨM BÁN CHẠY NHẤT";
            $sql= "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham ORDER BY luotban DESC LIMIT 10";
            break;
        default:
            $title = "DANH MỤC SẢN PHẨM";
            break;
    }

        // Thực hiện truy vấn nếu $sql không rỗng
        if (!empty($sql)) {
            $result = $conn->query($sql);
            if (!$result) {
                die("Truy vấn thất bại: " . $conn->error);
            }
        } else {
            die("Không có truy vấn nào để thực hiện.");
        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="css/sanpham.css">
    <style>
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(200px, 1fr));
            gap: 20px; /* Thêm khoảng cách giữa các sản phẩm nếu cần */
            padding: 0 20px;
            width: 95%;
            margin-top: 30px;
        }
        .page-container {
            display: flex;
            backgro
            und-color: #fafffd;
        }
        .chinhsua{
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <?php include 'layout/SidebarAdmin.php';?>
    <div class="product-container" style="margin-left: 350px; margin-bottom: 115px;">
            <h2 style="font-size: 28px;"><?php echo $title; ?></h2>

            <div class="product-list">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="product-item" style="height: 400px; transform: scale(1.00);">';
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

                            if ($categoryad == 'moi') {
                                echo '<div class="new-label">New</div>'; // Biểu tượng "New"
                            }

                            if ($categoryad == 'banchay') {
                                echo '<div class="new-label">Best Seller</div>'; // Biểu tượng "New"
                            }

                            echo '<p class="luotban" >Lượt bán: ' .$row["luotban"]. '</p>';
                            echo '<div style="display: flex; gap: 4px; margin-top: 12px;">';
                               if ($isLoggedIn) {
                                    echo '<a href="Suasanpham.php?masp=' . $row["masp"] . '" class="chinhsua" style="width: 70px; margin-left: 15px">Sửa</a>';
                                    echo '<a href="Xoasanpham.php?masp=' . $row["masp"] . '" class="chinhsua" style="width: 70px; margin-right: 15px;">Xóa</a>'; // Delete button
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

