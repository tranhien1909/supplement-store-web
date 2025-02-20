<?php
    include 'layout/Header.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn quý khách</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafffd;
            margin: 0;
            padding: 0;
        }
        .thank-you-container {
            text-align: center;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 600px;
            margin-left: 120px;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            margin-top: 30px;
        }
        img {
            max-width: 100%;
            height: 380px;
            margin-bottom: 15px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #65A69A;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
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
        <div class="thank-you-container">
            <img src="images/thucamon.png" alt="Cảm ơn quý khách">
            <a href="Lichsumuahang.php" class="btn">Xem lịch sử mua hàng</a>
        </div>
    </div>
    <div class="footer" style="">
        <?php
            include 'layout/Footer.php';
        ?>
    </div>
</body>
</html>
