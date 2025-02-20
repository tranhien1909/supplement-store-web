<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh Mục Sản Phẩm</title>
    <style>
        .sidebar {
            position: fixed;  
            height: 76vh;
            z-index: 100; 
            width: 330px; /* Đặt chiều rộng cụ thể cho sidebar *//* Màu nền cho sidebar */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            background-color: #e4efeb;
            border: 2px solid #466E73;
        }

        .product-container main {
            margin-left: 25px; /* Khoảng cách giữa sidebar và sản phẩm */
        }

        /* Định dạng cho danh sách sản phẩm trong sidebar */
        .sidebar nav ul {
            list-style: none; /* Bỏ dấu gạch đầu dòng */
            padding: 0; /* Bỏ padding */ /* Thêm viền xanh đậm */
            border-radius: 8px; /* Bo góc cho toàn bộ ô */
            padding: 15px; /* Padding cho nội dung bên trong */
        }

        .sidebar nav ul li {
            margin-bottom: 10px; /* Khoảng cách giữa các mục */
        }

        .sidebar nav ul li a {
            margin-left: 25px;
            text-decoration: none; /* Bỏ gạch chân */
            color: #333; 
            font-size: 17px; 
            padding: 10px 5px; 
            display: block; 
            width: 260px; 
            border-radius: 4px; 
            transition: background-color 0.3s;
        }

        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background-color: #abc2ba;
        }

        .sidebar nav ul li a.inactive {
            background-color: #e4efeb; /* Màu nền cho các liên kết bị vô hiệu hóa */
            color: #333; /* Màu chữ không đổi */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <nav>
            <ul>
                <li style="font-size: 22px; margin-top: 20px; margin-left: 18px; margin-bottom: 15px;"><strong>DANH MỤC SẢN PHẨM</strong></li>
                <li id="bonao"><a href="#" >Bổ mắt, não, tim mạch (MNT)</a></li>
                <li id="giaidoc"><a href="#">Giải độc gan, thanh nhiệt (GAN)</a></li>
                <li id="sinhly"><a href="#">Hỗ trợ sinh lý (SL)</a></li>
                <li id="ungthu"><a href="#">Hỗ trợ điều trị ung thư (UT)</a></li>
                <li id="tieuhoa"><a href="#">Hỗ trợ tiêu hóa (TH)</a></li>
                <li id="giamcan"><a href="#">Hỗ trợ giảm cân (GC)</a></li>
                <li id="lamdep"><a href="#">Hỗ trợ làm đẹp (LD)</a></li>
                <li id="vitamin"><a href="#">Vitamin và khoáng chất (V)</a></li>
            </ul>
        </nav>
    </div>

    <div id="banner-section"> <!-- Đảm bảo phần này tồn tại -->
        <!-- Nội dung banner -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');
            const menuLinks = document.querySelectorAll('.main-menu a'); 

            // Hàm đặt lớp 'active' dựa trên trạng thái từ localStorage
            const setActiveLink = () => {
                const activeLinkId = localStorage.getItem('activeLinkId');

                // Nếu có trạng thái lưu trước, đặt lại trạng thái 'active'
                if (activeLinkId) {
                    const activeLink = document.querySelector(`#${activeLinkId} a`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            };

            // Gọi hàm setActiveLink ngay sau khi DOM đã tải
            setActiveLink();

            // Hàm xử lý khi nhấn vào các liên kết
            const handleClick = (linkId, categoryad) => {
                const link = document.getElementById(linkId);
                if (link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault(); // Ngăn chặn hành vi mặc định của link

                        sidebarLinks.forEach(l => {
                            l.classList.remove('active');
                        });

                        // Thêm lớp 'active' cho liên kết hiện tại
                        link.querySelector('a').classList.add('active');

                        // Lưu trạng thái vào localStorage
                        localStorage.setItem('activeLinkId', linkId);

                        // Chuyển hướng đến trang mới
                        window.location.href = `SanphamAdmin.php?categoryad=${categoryad}`;
                    });
                }
            };
            menuLinks.forEach(menuLink => {
                menuLink.addEventListener('click', function() {
                    // Xóa lớp 'active' khỏi tất cả các liên kết sidebar
                    sidebarLinks.forEach(l => {
                        l.classList.remove('active');
                    });

                    // Xóa trạng thái trong localStorage
                    localStorage.removeItem('activeLinkId');
                });
            });
            handleClick('giaidoc', 'gan');
            handleClick('bonao', 'bomnt');
            handleClick('sinhly', 'sly');
            handleClick('ungthu', 'uthu');
            handleClick('tieuhoa', 'thoa');
            handleClick('giamcan', 'gcan');
            handleClick('lamdep', 'ldep');
            handleClick('vitamin', 'vita');

        });
    </script>
</body>
</html>
