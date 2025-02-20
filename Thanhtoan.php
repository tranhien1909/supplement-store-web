<?php
    include 'layout/Header.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thanh Toán</title>
    <link rel="stylesheet" href="css/thanhtoan.css">
    <style>
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
        }
        .cartt {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            max-width: 80%;
            margin-top: 40px;
            min-height: 250px;
            border: 1px solid #466E73;
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
        <?php
    	    // Kết nối đến cơ sở dữ liệu
    	    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");

    	    // Kiểm tra kết nối
    	    if ($conn->connect_error) {
    	        die("Kết nối thất bại: " . $conn->connect_error);
    	    }

    	    $userId = $_SESSION['username'];
    	    $email = $_SESSION['email'];
    	    $phone = $_SESSION['phone']; 
            $fullname = $_SESSION['tendn'];

    	    $sql = "SELECT masp, SUM(soluong) as soluong FROM giohang WHERE tendn = '$fullname' GROUP BY masp";
    	    $result = $conn->query($sql);

    	    // Khởi tạo mảng để lưu trữ thông tin sản phẩm
    	    $cartItems = [];
    	    $totalPrice = 0;

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
    	                    $itemTotal = (!empty($product['giagiam']) && $product['giagiam'] > 0) 
    	                        ? $product['giagiam'] * $quantity 
    	                        : $product['gia'] * $quantity;

    	                    $cartItems[] = [
    	                        'id' => $product['masp'],
    	                        'name' => $product['tensp'],
    	                        'price' => $product['gia'],
    	                        'discountPrice' => $product['giagiam'],
    	                        'image' => $product['anh'],
    	                        'quantity' => $quantity,
    	                        'itemTotal' => $itemTotal,
    	                    ];

    	                    $totalPrice += $itemTotal;
    	                }
    	            }
    	        }
    	    }
        ?>

        <div class="cartt" style="margin-left: 40px;  margin-bottom: 40px; margin-top: 32px; width: 65%;">
            <h2 style="margin-top: 25px;">ĐƠN HÀNG</h2>

            <?php if (count($cartItems) > 0): ?>
                <div class="cart-header">
                    <div class="header-item" style="margin-left: 220px">Sản phẩm</div>
                    <div class="header-item" style="margin-left: 363px;">Giá</div>
                    <div class="header-item" style="margin-left: 65px">Số lượng</div>
                    <div class="header-item" style="margin-left: 30px">Thành tiền</div>
                </div>

                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="item-info">
                            <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="item-image">
                            <div class="item-details">
                                <h3 class="item-name"><?php echo $item['name']; ?></h3>
                            </div>
                        </div>
                        <div class="item-price">
                            <?php if (!empty($item['discountPrice']) && $item['discountPrice'] > 0): ?>
                                <span class="current-price"><?php echo number_format($item['discountPrice'], 0, ',', '.'); ?>₫</span>
                            <?php else: ?>
                                <span class="current-price"><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</span>
                            <?php endif; ?>
                        </div>
                        <div class="item-quantity"><?php echo $item['quantity']; ?></div>
                        <div class="item-total"><?php echo number_format($item['itemTotal'], 0, ',', '.'); ?>₫</div>
                    </div>
                <?php endforeach; ?>

                <div class="cart-summary">
                    <h3>Tổng tiền: <span class="subtotal"><?php echo number_format($totalPrice, 0, ',', '.'); ?>₫</span></h3>
                    <button class="back-btn" onclick="window.location.href='Giohang.php'">Quay lại giỏ hàng </button>
                    <button class="checkout-btn" onclick="document.getElementById('form-container').style.display='block';">Xác nhận đơn hàng</button>
                </div>
            <?php else: ?>
                <p style="text-align: center; font-size: 18px;">Giỏ hàng của bạn chưa có gì.</p>
            <?php endif; ?>

    		<div class="form-container" id="form-container">
    		    <h3>Mời bạn nhập thông tin nhận hàng</h3>
    		    <form id="formthongtin" method="POST">
    		        <input type="text" name="ten" id="ten" placeholder="Tên" value="<?php echo htmlspecialchars($userId); ?>" required>
    		        <input type="text" name="sdt" id="sdt" placeholder="Số điện thoại" value="<?php echo htmlspecialchars($phone); ?>" required>
    		        <input type="text" name="diachi" id="diachi" placeholder="Địa chỉ" required>
    		        <input type="text" name="payment" value="Thanh toán khi nhận hàng" readonly>
    		        <button type="submit" class="submit-btn">Gửi</button>
    		    </form>
    		</div>
        </div>
        <?php
            $ten = isset($_POST['name']) ? $_POST['name'] : '';
            $sdt = isset($_POST['phone']) ? $_POST['phone'] : '';
            $dc = isset($_POST['address']) ? $_POST['address'] : '';
        ?>
        <div id="orderModal" class="modal">
            <div class="modal-content">
                <h2 style="text-align: center;padding: 5px;">THÔNG TIN GIAO HÀNG</h2>
                
                <p><strong>Thông tin khách hàng</strong></p>
                <p id="modalName" style="margin-left: 20px;"></p>
                <p id="modalPhone" style="margin-left: 20px;"></p>
                <p id="modalAddress" style="margin-left: 20px;"></p>
                
                <p><strong>Thông tin sản phẩm</strong></p>
                <p id="productName" style="margin-left: 20px;"></p>
                <p id="productQuantity"></p>
                <p id="productPrice"></p>
                
                <p style="margin-top: -40px"><strong>Hình thức thanh toán: </strong>Thanh toán khi nhận hàng</p>
                <p style="text-align: right; font-size: 20px;"><strong>Tổng tiền:</strong> <span id="totalPrice" style="font-weight: bold; color: red;"></span> </p>
                <button type="submit" id="placeOrderBtn" class="dong" style="margin-left: 230px">Đặt hàng</button>
                <button onclick="document.getElementById('orderModal').style.display='none'" class="dong">Đóng</button>
            </div>
        </div>
    </div>

    <div class="footer">
        <?php include 'layout/Footer.php'; ?>
    </div>

    <script>
        document.getElementById('formthongtin').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form reload

            var ten = document.getElementById('ten').value;
            var sdt = document.getElementById('sdt').value;
            var dc = document.getElementById('diachi').value;

            document.getElementById('modalName').innerText = ten;
            document.getElementById('modalPhone').innerText = sdt;
            document.getElementById('modalAddress').innerText = dc;

            // Hiển thị thông tin sản phẩm
            var productNames = [];
            var productQuantities = [];
            var productPrices = [];
            var totalAmount = 0;

            <?php foreach ($cartItems as $item): ?>
                productNames.push("<?php echo addslashes($item['name']); ?>");
                productQuantities.push(<?php echo $item['quantity']; ?>);
                productPrices.push(<?php echo $item['itemTotal']; ?>);
                totalAmount += <?php echo $item['itemTotal']; ?>; // Cộng dồn tổng tiền
            <?php endforeach; ?>

            // Hiển thị thông tin sản phẩm trong modal
            var productInfoHtml = "";
            for (var i = 0; i < productNames.length; i++) {
                productInfoHtml += (i+1) +". "+ productNames[i] + "<br><br>Số lượng: " + productQuantities[i] + "<br><br>Thành tiền: " + new Intl.NumberFormat().format(productPrices[i]) + " ₫<br><br>";
            }
            document.getElementById('productName').innerHTML = productInfoHtml;
            document.getElementById('totalPrice').innerText = new Intl.NumberFormat().format(totalAmount) + ' ₫';

            // Hiển thị modal
            document.getElementById('orderModal').style.display = 'block';
        });

        document.getElementById('placeOrderBtn').addEventListener('click', function() {
            var ten = document.getElementById('ten').value;
            var sdt = document.getElementById('sdt').value;
            var dc = document.getElementById('diachi').value;

            // Dữ liệu đơn hàng
            var orderData = {
                ten: ten,
                sdt: sdt,
                diachi: dc,
                products: <?php echo json_encode($cartItems); ?>,
                tongtien: <?php echo $totalPrice; ?>
            };

            // Gửi yêu cầu lên server để lưu đơn hàng
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "Dathang.php", true); // Thay Dathang.php thành file xử lý đơn hàng của bạn
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Sau khi đặt hàng thành công, tiến hành xóa giỏ hàng
                    var clearCartXhr = new XMLHttpRequest();
                    clearCartXhr.open("POST", "Xoagiohang.php", true); // Tạo file `Xoagiohang.php` để xóa giỏ hàng
                    clearCartXhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    clearCartXhr.onreadystatechange = function () {
                        if (clearCartXhr.readyState === 4 && clearCartXhr.status === 200) {
                            // Sau khi giỏ hàng đã được xóa, chuyển về trang chính
                            window.location.href = 'Thucamon.php';
                        }
                    };
                    clearCartXhr.send();
                }
            };
            xhr.send(JSON.stringify(orderData));
        });


    </script>

</body>
</html>