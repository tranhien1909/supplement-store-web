<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="css/giohang.css">
    <style>
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
        }
        .carttts {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 70%;
            margin-top: 32px;
            margin-bottom: 30px;
            border: 1px solid #466E73;
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
    <div id="notification" style="display: none; padding: 10px; margin-bottom: 20px; border-radius: 5px; background-color: #f0f0f0; color: #333; width: 300px; margin-left: 700px; text-align: center;">
        </div>
    <div class="page-container"> 
        <div class="sidebar-container">
            <?php include 'layout/Sidebar.php'; ?>
        </div>
        <div class="carttts" style="margin-left: 20px; height: auto;">
            <h2 style="margin-top: 25px; ">GIỎ HÀNG CỦA BẠN</h2>

            <?php
            // Kết nối đến cơ sở dữ liệu
            $conn = new mysqli("localhost", "root", "", "thucphamchucnang");

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            $userId = $_SESSION['username'];
            $fullname = $_SESSION['tendn']; 

            $sql = "SELECT masp, SUM(soluong) as soluong FROM giohang WHERE tendn = '$fullname' GROUP BY masp";
            $result = $conn->query($sql);

            // Khởi tạo mảng để lưu trữ thông tin sản phẩm
            $cartItems = [];

            // Xử lý sản phẩm
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $productId = $row['masp'];
                    $quantity = $row['soluong'];

                     if ($quantity > 0) {
                        // Lấy thông tin sản phẩm từ bảng sản phẩm
                        $productSql = "SELECT * FROM sanpham WHERE masp = '$productId'";
                        $productResult = $conn->query($productSql);
                        
                        if ($productResult->num_rows > 0) {
                            $product = $productResult->fetch_assoc();
                            
                            $cartItems[] = [
                                'id' => $product['masp'],
                                'name' => $product['tensp'],
                                'price' => $product['gia'],
                                'discountPrice' => $product['giagiam'],
                                'image' => $product['anh'],
                                'quantity' => $quantity,
                            ];
                        }
                    }
                }
            }

            if (count($cartItems) > 0) {
                $totalPrice = 0;

                echo '<div class="cart-header">
                        <div class="header-item" style="margin-left: 220px">Sản phẩm</div>
                        <div class="header-item" style="margin-left: 250px;">Giá</div>
                        <div class="header-item" style="margin-left: 75px">Số lượng</div>
                        <div class="header-item" style="margin-left: 46px">Thành tiền</div>
                      </div>';

                foreach ($cartItems as $item) {
                    $itemTotal = (!empty($item['discountPrice']) && $item['discountPrice'] > 0) 
                        ? $item['discountPrice'] * $item['quantity'] 
                        : $item['price'] * $item['quantity'];
                    $totalPrice += $itemTotal;

                    echo '<div class="cart-item" id="cart-item-' . $item['id'] . '">
                            <div class="item-info">
                                <img src="images/' . $item['image'] . '" alt="' . $item['name'] . '" class="item-image">
                                <div class="item-details">
                                    <h3 class="item-name">' . $item['name'] . '</h3>
                                </div>
                            </div>
                            <div class="item-price">';

                    // Hiển thị giá giảm nếu có và lớn hơn 0
                    if (!empty($item['discountPrice']) && $item['discountPrice'] > 0) {
                        echo '<span class="discount-price">' . number_format($item['price'], 0, ',', '.') . '₫</span> ';
                        echo '<span class="current-price">' . number_format($item['discountPrice'], 0, ',', '.') . '₫</span>';
                    } else {
                        echo '<span class="current-price">' . number_format($item['price'], 0, ',', '.') . '₫</span>';
                    }

                    echo '</div>
                            <div class="item-quantity">
                                <input type="number" value="' . $item['quantity'] . '" min="1" id="quantity-' . $item['id'] . '" onchange="updateTotalPrice(\'' . $item['id'] . '\')">
                            </div>
                            <div class="item-total">
                                <span class="total-price" id="total-price-' . $item['id'] . '" data-price="' . ( !empty($item['discountPrice']) && $item['discountPrice'] > 0 ? $item['discountPrice'] : $item['price'] ) . '">' . number_format($itemTotal, 0, ',', '.') . '₫</span>
                            </div>
                            <button class="update-btn" onclick="updateCart(\'' . $item['id'] . '\')">Cập nhật</button><br>
                            <button class="delete-btn" onclick="deleteCartItem(\'' . $item['id'] . '\')">Xóa</button>
                          </div>';
                        }

                        echo '<div class="cart-summary">
                                <h3>Tổng tiền: <span class="subtotal" id="subtotal">' . number_format($totalPrice, 0, ',', '.') . '₫</span></h3>
                                <button class="checkout-btn" onclick="window.location.href=\'Thanhtoan.php\'">Tiến hành đặt hàng</button>
                              </div>';
                    } else {
                        echo '<p style="text-align: center; font-size: 18px;" class = "thongbao">Giỏ hàng của bạn chưa có gì.</p>';
                    }

                // Đóng kết nối
                $conn->close();
            ?>

        </div>
    </div>
    <div class="footer" style="">
        <?php
            include 'layout/Footer.php';
        ?>
    </div>

    <script>
        function updateTotalPrice(productId) {
            const quantity = document.getElementById('quantity-' + productId).value;
            const price = document.getElementById('total-price-' + productId).dataset.price; // Lấy giá sản phẩm từ thuộc tính data-price

            const totalPrice = quantity * price; // Tính tổng
            document.getElementById('total-price-' + productId).textContent = numberWithCommas(totalPrice) + '₫'; // Cập nhật hiển thị

            // Cập nhật subtotal
            updateSubtotal();
        }

        function updateSubtotal() {
            const totalPrices = document.querySelectorAll('.total-price');
            let subtotal = 0;

            totalPrices.forEach(item => {
                const price = parseInt(item.textContent.replace(/₫/g, '').replace(/\./g, '').trim()); // Chuyển đổi giá trị thành số
                subtotal += price;
            });

            document.getElementById('subtotal').textContent = numberWithCommas(subtotal) + '₫'; // Cập nhật subtotal
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Hàm để định dạng số với dấu phẩy
        }

        function updateCart(productId) {
            const quantity = document.getElementById('quantity-' + productId).value;

            // Gửi yêu cầu AJAX đến UpdateCart.php
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "UpdateCart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const notification = document.getElementById('notification');

                    if (response.status == "success") {
                        showNotification("Cập nhật thành công!", "success");
                        // Cập nhật thành tiền trên giao diện
                        updateTotalPrice(productId); // Cập nhật lại thành tiền
                    } else {
                        showNotification("Cập nhật thất bại: " + response.message, "error");
                    }
                }
            };
            xhr.send("masp=" + productId + "&soluong=" + quantity);
        }

        function deleteCartItem(productId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "DeleteCart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        // Xóa sản phẩm khỏi giao diện
                        document.getElementById('cart-item-' + productId).remove();

                        // Cập nhật tổng tiền
                        updateSubtotal();

                        // Kiểm tra nếu không còn sản phẩm nào trong giỏ hàng
                        const remainingItems = document.querySelectorAll('.cart-item');
                        if (remainingItems.length === 0) {
                            // Hiển thị thông báo giỏ hàng trống
                            const cartContainer = document.querySelector('.carttt');
                            cartContainer.innerHTML = `
                                <h2 style="margin-top: 25px; ">GIỎ HÀNG CỦA BẠN</h2>
                                <p style="text-align: center; font-size: 18px;" class="thongbao">Giỏ hàng của bạn chưa có gì.</p>
                            `;

                            document.querySelector('.cart-summary').style.display = "none";

                        }
                    } else {
                        showNotification("Xóa sản phẩm thất bại: " + response.message, "error"); // Thông báo lỗi
                    }
                }
            };

            xhr.send("masp=" + productId);
        }


        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.style.display = "block";
            notification.textContent = message;

            if (type === "success") {
                notification.style.backgroundColor = "#d4edda"; // Màu nền cho thông báo thành công
                notification.style.color = "#155724"; // Màu chữ cho thông báo thành công
            } else if (type === "error") {
                notification.style.backgroundColor = "#f8d7da"; // Màu nền cho thông báo lỗi
                notification.style.color = "#721c24"; // Màu chữ cho thông báo lỗi
            }

            // Tự động ẩn thông báo sau 3 giây
            setTimeout(() => {
                notification.style.display = "none";
            }, 1000);
        }
    </script>
</body>
</html>