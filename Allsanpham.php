<?php
    include 'layout/Header.php';
// Kết nối cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xử lý tham số category từ AJAX hoặc URL
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    // Lựa chọn truy vấn phù hợp dựa trên category
    $sql = ''; // Đảm bảo biến $sql được khởi tạo trước

    switch ($category) {
        case 'giaidocgan':
            $title = "SẢN PHẨM GIẢI ĐỘC GAN, THANH NHIỆT";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'GAN%'";
            break;
        case 'bomatnao':
            $title = "SẢN PHẨM BỔ MẮT, NÃO, TIM MẠCH";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'MNT%'";
            break;
        case 'sinhly':
            $title = "SẢN PHẨM HỖ TRỢ SINH LÝ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'SL%'";
            break;
        case 'ungthu':
            $title = "SẢN PHẨM ĐIỀU TRỊ UNG THU";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'UT%'";
            break;
        case 'tieuhoa':
            $title = "SẢN PHẨM HỖ TRỢ TIÊU HÓA";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'TH%'";
            break;
        case 'giamcan':
            $title = "SẢN PHẨM HỖ TRỢ GIẢM CÂN";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'GC%'";
            break;
        case 'lamdep':
            $title = "SẢN PHẨM HỖ TRỢ LÀM ĐẸP";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'LD%'";
            break;
        case 'vitamin':
            $title = "SẢN PHẨM BỔ SUNG VITAMIN VÀ KHOÁNG CHẤT";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE masp LIKE 'V%'";
            break;
        case 'tatcasp':
            $title = "TẤT CẢ SẢN PHẨM";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham";
            break;
        case 'moinhat':
            $title = "SẢN PHẨM MỚI NHẤT";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham ORDER BY ngayban DESC LIMIT 10";
            break;
        case 'giamgia':
            $title = "SẢN PHẨM ĐANG GIẢM GIÁ";
            $sql = "SELECT masp, tensp, anh, gia, giagiam, luotban FROM sanpham WHERE giagiam > 0";
            break;
        case 'banchaynhat':
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
    <link rel="stylesheet" href="css/sanpham.css">
    <title><?php echo $title; ?></title>
    <style>
        .header {
            display: flex;
            align-items: center;
            border: 1px solid #466E73;
            margin-bottom: 20px;
            margin-left: 45px;
            width: 96.5%;
            margin-top: 62px;
        }

        .header-left {
            background-color: #466E73;
            color: #ffffff;
            padding: 10px 35px;
            font-size: 20px;
            position: relative;
            display: inline-block;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(4, minmax(200px, 1fr)); 
            padding: 10px 20px;
            width: 100%;
        }
        .product-container {
            text-align: center;
            margin-left: -10px;
            margin-top: -32px;
        }
        .product-item{
            margin-top: 9px;
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
        <div class="product-container" style="margin-bottom: 20px;">
            <div class="header">
                <div class="header-left">
                    <span><?php echo $title; ?></span>
                </div>
            </div>
                <div class="product-list" style="gap: 9px; margin-left: 28px;">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<a href="Thongtinsp.php?masp=' . $row["masp"] . '" class="product-item">'; // Bao sản phẩm trong thẻ <a>
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
                            if ($category == 'moinhat') {
                                echo '<div class="new-label">New</div>'; // Biểu tượng "New"
                            }

                            if ($category == 'banchaynhat') {
                                echo '<div class="new-label">Best Seller</div>'; // Biểu tượng "New"
                            }

                            echo '<p class="luotban" style="color: black; font-size: 16px;">Lượt bán: ' . $row["luotban"] . '</p>';
                            echo '</a>'; 
                        }
                    } else {
                        echo "Không có sản phẩm nào.";
                    }
                ?>
            </div>
        </div>
    </div>
    <div>
        <?php
            include 'layout/Footer.php';
        ?>
    </div>
</body>
</html>

