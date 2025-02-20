<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AT - THỰC PHẨM CHỨC NĂNG</title>
    <link rel="stylesheet" href="css/danhmuc.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            width: 100%; /* Đảm bảo chiều rộng 100% */
            overflow-x: hidden; /* Ngăn cuộn ngang */
            margin: 0; /* Bỏ margin mặc định */
            padding: 0; /* Bỏ padding mặc định */
        }
        .page-container {
            display: flex;
            flex-direction: row; /* Đặt các phần tử ngang nhau */
        }
        .product-container {
            margin-top: 20px;
            padding: 10px;
            width: 100%; /* Chiều rộng đầy đủ */
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
    <div class="page-container"> 
        <div class="sidebar-container">
            <?php include 'layout/Sidebar.php'; ?>
        </div>
        <div class="product-container" id="product-section">
            <?php include 'Sptrangchu.php'; ?>
        </div>
    </div>
    <div>
        <?php
            include 'layout/Footer.php';
        ?>
    </div>
</body>
</html>
