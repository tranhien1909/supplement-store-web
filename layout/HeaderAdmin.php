<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $isLoggedIn = isset($_SESSION['ten_dn']);
    $tentk = ($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .username {
            margin-left: 10px;
            font-size: 17px;
            color: orangered;
            margin-right: 20px;
            font-weight: bold;
        }

        header {
            background-color: white;
            border-bottom: 2px solid #ccc;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            height: 40px;
            overflow: hidden;
        }

        .logo-text {
            margin-left: 10px;
            font-size: 18px;
            color: #466E73;
            font-weight: bold;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
            margin-left: 40px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            font-size: 15px; /* Đặt kích thước chiều rộng */ /* Đặt kích thước chiều cao */
            border: 1px solid #ccc;
            border-radius: 20px 0 0 20px;
        }

        .search-bar button {
            padding: 5px 10px;
            background-color: aliceblue;
            border: none;
            border-radius: 0 20px 20px 0;
            color: white;
            cursor: pointer;
            height: 36px;
            margin-left: 0px;
        }

        .contact-info {
            display: flex;
            align-items: center;
            margin-right: 60px;
        }

        .contact-info a {
            text-decoration: none;
            color: #004a99;
            margin-right: 10px;
            margin-left: 10px;
        }

        .auth {
            display: flex;
            align-items: center;
        }

        .account-link {
            text-decoration: none;
            color: #466E73;
        }

        .main-menu {
            padding: 10px 0;
            background-color: mediumblue;
        }

        .main-menu ul {
            list-style: none;
            display: flex;
            justify-content: space-around; 
            width: 80%;
            margin-left: 150px;
        }


        .main-menu ul li a {
            text-decoration: none;
            color: white;
            padding: 3px 0px;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-menu ul li a i {
            margin-right: 8px; /* Khoảng cách giữa biểu tượng và chữ */
        }

        .main-menu .hot {
            background-color: red;
            color: white;
            padding: 2px 5px;
            font-size: 12px;
            margin-left: 5px;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <header>
        <div class="top-header">
            <div class="logo">
                <img src="images/LOGO.png" alt="Logo" class="logo-img">
                <span class="logo-text">ANH TUAN</span>
            </div>
            <div class="search-bar">
                <form action="Timkiem.php" method="GET">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm....." style="width: 500px; padding: 14px; height: 10px;" required>
                    <button class="tk" type="submit">🔍</button>
                </form>
            </div>
            <div class="contact-info">
                <div class="auth" id="auth-info">
                    <?php if ($isLoggedIn): ?>
                        <span class="username"><?php echo $tentk; ?></span>
                        <a href="Dangxuat.php" id="account-link" class="account-link" style="font-size: 16px;">Đăng xuất</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <nav class="main-menu" style="background-color: #466E73; height: 21px;">
            <ul>
                <li><a href="Admin.php" class="menu-link" id="trang-chu-link">TRANG CHỦ</a></li>
                <li><a href="SanphamAdmin.php?categoryad=moi" id="moinhat-link" class="menu-link">SẢN PHẨM MỚI NHẤT</a></li>
                <li><a href="SanphamAdmin.php?categoryad=giam" id="giamgia-link" class="menu-link">SẢN PHẨM GIẢM GIÁ</a></li>
                <li><a href="SanphamAdmin.php?categoryad=banchay" id="banchay-link" class="menu-link">BÁN CHẠY NHẤT</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="Themsanpham.php" class="menu-link">THÊM SẢN PHẨM</a></li>
                <?php else: ?>
                    <li><a href="#" class="menu-link">THÊM SẢN PHẨM</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>