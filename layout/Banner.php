<?php
// Khai báo 1 mảng chứa các hình ảnh hiển thị trong banner
$images = [
    'images/banner1.jpg',
    'images/banner2.jpg',
    'images/banner3.jpg',
    'images/banner4.jpg',
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .banner-container {
            width: 98%;
            height: 430px; /* Đặt chiều cao cụ thể cho banner */
            overflow: hidden; /* Ẩn các phần vượt quá chiều cao */
            position: relative; /* Đảm bảo vị trí tương đối */
            z-index: 100; 
            margin-left: 20px;
            margin-top: 7px;
        }

        .banner-container img {
            width: 100%; /* Chiều rộng hình ảnh bằng với chiều rộng của banner */
            height: 100%; /* Đặt chiều cao cho hình ảnh */
            object-fit: cover; /* Đảm bảo hình ảnh không bị biến dạng */
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        /* Ảnh được chọn sẽ hiện lên */
        .banner-container img.active {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="banner-container">
        <?php foreach ($images as $image): ?>
            <img src="<?php echo $image; ?>" alt="Banner"> 
        <?php endforeach; ?>
    </div>

    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('.banner-container img');
        const totalImages = images.length;

        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % totalImages;
            images[currentIndex].classList.add('active');
        }

        // Hiển thị ảnh đầu tiên
        images[currentIndex].classList.add('active');

        // Chuyển ảnh sau mỗi 3 giây
        setInterval(showNextImage, 5000);
    </script>
</body>
</html>
