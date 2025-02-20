<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danh Mục Sản Phẩm</title>
    <style>
        /* CSS cho sidebar */
        .sidebar {
            position: relative;
            height: 71vh;
            z-index: 200;
            width: 290px;
            box-shadow: 2px 0 4px #65A69A;
            border: none;
            padding: 0;
            margin-top: 30px;
            margin-left: 80px;
            background-color: #e4efeb;
            border: 2px solid #466E73;
            margin-bottom: 20px;
        }

        /* CSS cho các liên kết trong sidebar */
        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar nav ul li {
            position: relative;
            margin: 0;
        }

        .sidebar nav ul li a {
            display: flex;
            align-items: center;
            color: #333;
            font-size: 17px;
            text-decoration: none;
            padding: 15px 15px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
            margin-left: 15px;
            margin-right: 15px;
        }

        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background-color: #abc2ba;
            color: black;
        }

        .sidebar nav ul li a:before {
            content: "»";
            color: #e91e63;
            margin-right: 8px;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .sidebar { width: 220px; }
            .sidebar nav ul li a { font-size: 15px; }
        }
        @media (max-width: 900px) {
            .sidebar { width: 180px; }
            .sidebar nav ul li a { font-size: 14px; }
        }
        @media (max-width: 600px) {
            .sidebar { width: 150px; }
            .sidebar nav ul li a { font-size: 13px; }
        }
        @media (max-width: 400px) {
            .sidebar { width: 120px; }
            .sidebar nav ul li a { font-size: 12px; }
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <nav>
            <ul>
                <li style="font-size: 21px; top: 20px; margin-left: 28px; margin-bottom: 30px;"><strong>DANH MỤC SẢN PHẨM</strong></li>
                <li id="tatcasp-link"><a href="#">Tất cả sản phẩm</a></li>
                <li id="bonao-link"><a href="#">Bổ mắt, não, tim mạch</a></li>
                <li id="giaidoc-link"><a href="#">Giải độc gan, thanh nhiệt</a></li>
                <li id="sinhly-link"><a href="#">Hỗ trợ sinh lý</a></li>
                <li id="ungthu-link"><a href="#">Hỗ trợ điều trị ung thư</a></li>
                <li id="tieuhoa-link"><a href="#">Hỗ trợ tiêu hóa</a></li>
                <li id="giamcan-link"><a href="#">Hỗ trợ giảm cân</a></li>
                <li id="lamdep-link"><a href="#">Hỗ trợ làm đẹp</a></li>
                <li id="vitamin-link"><a href="#">Vitamin và khoáng chất</a></li>
            </ul>
        </nav>
    </div>

    <div id="banner-section">
        <!-- Nội dung banner -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');
            const menuLinks = document.querySelectorAll('.main-menu a'); // Chọn các liên kết trên menu

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

            // Hàm xử lý khi nhấn vào các liên kết trong sidebar
            const handleSidebarClick = (linkId, category) => {
                const link = document.getElementById(linkId);
                if (link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault(); // Ngăn chặn hành vi mặc định của link

                        // Xóa lớp 'active' khỏi tất cả các liên kết sidebar
                        sidebarLinks.forEach(l => {
                            l.classList.remove('active');
                        });

                        // Thêm lớp 'active' cho liên kết sidebar hiện tại
                        link.querySelector('a').classList.add('active');

                        // Lưu trạng thái vào localStorage
                        localStorage.setItem('activeLinkId', linkId);

                        // Chuyển hướng đến trang mới
                        window.location.href = `Allsanpham.php?category=${category}`;
                    });
                }
            };

            // Hàm xử lý khi nhấn vào các liên kết trong menu
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

            // Gọi hàm cho từng liên kết trong sidebar
            handleSidebarClick('tatcasp-link', 'tatcasp');
            handleSidebarClick('bonao-link', 'bomatnao');
            handleSidebarClick('giaidoc-link', 'giaidocgan');
            handleSidebarClick('sinhly-link', 'sinhly');
            handleSidebarClick('ungthu-link', 'ungthu');
            handleSidebarClick('tieuhoa-link', 'tieuhoa');
            handleSidebarClick('giamcan-link', 'giamcan');
            handleSidebarClick('lamdep-link', 'lamdep');
            handleSidebarClick('vitamin-link', 'vitamin');
        });
    </script>
</body>
</html>
