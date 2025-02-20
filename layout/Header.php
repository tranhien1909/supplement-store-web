<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $isLoggedIn = isset($_SESSION['tendn']); // Biến này sẽ là true nếu người dùng đã đăng nhập
    $cartCount = 0;

    if ($isLoggedIn) {
        $tentk = $_SESSION['username'];
        $fullname = $_SESSION['tendn'];

        $sql = "SELECT COALESCE(SUM(soluong), 0) AS total_quantity FROM giohang WHERE tendn = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $fullname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $cartCount = $row['total_quantity'] ? (int)$row['total_quantity'] : 0; 
        }

        $stmt->close();
    }

    $conn->close();

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="css/headerstyle.css">
    <link rel="stylesheet" href="css/dnhapdky.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .username{
            margin-left: 10px; /* Khoảng cách giữa biểu tượng và tên tài khoản */
            font-size: 17px; /* Kích thước chữ cho tên tài khoản */
            color: orangered; 
            margin-right: 20px;
            font-weight: bold;
        }
        .form-input input {
            width: 100%; /* Chiều rộng đầy đủ */
            padding: 10px; /* Padding cho input */
            border: 1px solid #ccc; /* Biên cho input */
            border-radius: 5px; 
        }
        .form-button {
            margin-top: 15px; /* Khoảng cách trên nút đăng ký */
        }
        .error-message {
            color: red; /* Màu sắc cho thông báo lỗi */
            margin-top: 10px; /* Khoảng cách trên */
            font-weight: bold; /* Đậm chữ */
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
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm....." style="width: 500px; padding: 14px; height: 33px;" required>
                    <button type="submit">🔍</button>
                </form>
            </div>
            <div class="contact-info">
                <div class="auth" id="auth-info">
                    <?php if ($isLoggedIn): ?>
                        <a href="Thongtincanhan.php" class="username" id="username" style="color: #de1100; font-size: 16px;">
                            <?php echo $tentk; ?>
                        </a>
                        <div class="dropdown">
                            <a href="Dangxuat.php" class="logout-link" style="color: #466E73; font-size: 16px;">Đăng xuất</a>
                        </div>
                    <?php else: ?>
                        <a href="#" id="account-link" class="account-link" style="font-size: 16px; color: #466E73;">Đăng nhập / Đăng ký</a>
                    <?php endif; ?>
                </div>
                <div class="cart" style="color: #466E73;">
                    <?php if ($isLoggedIn): ?>
                        <a href="Giohang.php">🛒 Giỏ hàng (<?php echo $cartCount; ?>)</a>
                    <?php else: ?>
                        <a href="#" id="cart-link">🛒 Giỏ hàng (0)</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <nav class="main-menu" style="background-color: #466E73; height: 45px;">
            <ul style="margin-left: 180px;">
                <li><a href="Index.php" class="menu-link" id="trang-chu-link">TRANG CHỦ</a></li>
                <li><a href="Allsanpham.php?category=moinhat" id="moinhat-link" class="menu-link">SẢN PHẨM MỚI NHẤT</a></li>
                <li><a href="Allsanpham.php?category=giamgia" id="giamgia-link" class="menu-link">SẢN PHẨM GIẢM GIÁ</a></li>
                <li><a href="Allsanpham.php?category=banchaynhat" id="banchay-link" class="menu-link">BÁN CHẠY NHẤT</a></li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="Lienhe.php" class="menu-link">LIÊN HỆ</a>
                    <?php else: ?>
                        <a href="#" id="lienhe-link" class="menu-link">LIÊN HỆ</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="Lichsumuahang.php" class="menu-link">LỊCH SỬ MUA HÀNG</a>
                    <?php else: ?>
                        <a href="#" id="lichsu-link" class="menu-link" style="display: none;">LỊCH SỬ MUA HÀNG</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>
    
    <!-- Modal Đăng Nhập -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeLoginModal">&times;</span>
            <h2>ĐĂNG NHẬP</h2>
            <p id="login-error" class="error-message" style="display:none;"></p>
            <form id="login-form">
                <div class="form-inputs">
                    <input type="text" id="fullname" name="fullname" placeholder="Tên đăng nhập" required>
                    <input type="text" id="email" name="email" placeholder="Email" required>
                    <input type="password" id="loginpassword" name="loginpassword" placeholder="Mật khẩu" required>
                </div>
                <a href="#" class="forgot-password-link" style="text-decoration: none;">Quên mật khẩu?</a><br>
                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
            <a href="#" class="register-link">Bạn chưa có tài khoản? Đăng ký</a>
        </div>
    </div>

    <!-- Modal Đăng Ký -->
    <div id="signupModal" class="modal">
        <div class="modal-content"> 
            <a href="#" class="login-link" style="margin-top: 5px;">Bạn đã có tài khoản? Đăng nhập</a>
            <span class="close" id="closeSignupModal">&times;</span>
            <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
            <p id="signup-error" class="error-message" style="display:none;"></p>
            <form id="signup-form" method="POST" action="dangky.php">
                <div class="form-inputs">
                    <input type="text" id="username" name="username" placeholder="Tên tài khoản" required>
                    <input type="text" id="fullname" name="fullname" placeholder="Tên đăng nhập" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <input type="tel" id="phone" name="phone" placeholder="Số điện thoại" required>
                    <input type="text" id="address" name="address" placeholder="Địa chỉ" required>
                    <input type="password" id="password" name="password" placeholder="Mật khẩu" required>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Nhập lại mật khẩu" required>
                </div>
                <div class="form-inputs">
                    <label>
                        <input type="checkbox" id="admin-checkbox"> Đăng ký tài khoản Admin
                    </label>
                    <input type="text" id="admin-code" name="admin-code" placeholder="Nhập mã admin" style="display:none;">
                </div>
                <p id="password-error" style="color:red; display:none;">Mật khẩu không khớp, vui lòng nhập lại!</p>
                <div class="form-button">
                    <button type="submit" class="bim">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Quên Mật Khẩu -->
    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeForgotPasswordModal">&times;</span>
            <h2>Quên mật khẩu</h2>
            <p id="forgot-password-error" class="error-message" style="display:none;"></p>
            <form id="forgot-password-form"> 
                <div class="form-inputs">
                    <input type="text" id="fullname" name="fullname" placeholder="Tên đăng nhập" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-button">
                    <button type="submit" class="btn-reset-password">Lấy mã đặt lại mật khẩu</button>
                </div>
            </form>
            <p id="verification-code" style="color: black; font-weight: bold; display:none; margin-top: 18px;"></p>
            <button id="reset-modal" style="display:none;" class="btnresetpassword">Đặt lại mật khẩu</button>
        </div>
    </div>

    <!-- Modal Đặt Lại Mật Khẩu -->
    <div id="resetPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeResetPasswordModal">&times;</span>
            <h2>Đặt Lại Mật Khẩu</h2>
            <form id="reset-password-form">
                <input type="text" id="maxacnhan" name="maxacnhan" placeholder="Mã xác nhận" required>
                <input type="text" id="fullname" name="fullname" placeholder="Tên đăng nhập" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="new-password" name="new-password" placeholder="Mật khẩu mới" required>
                <input type="password" id="confirm-new-password" name="confirm-new-password" placeholder="Nhập lại mật khẩu" required>
                <button type="submit" class="resetmk">Đặt lại mật khẩu</button>
            </form>
            <p id="reset-error" style="display:none; color:red;">Mật khẩu không khớp!</p>
            <p id="redirect-message" style="display:none; color:black; margin-top: 20px; text-align: center;">Đợi 3s chuyển sang đăng nhập...</p>
        </div>
    </div>

    <script>
        // Lấy modal đăng nhập và đăng ký
        var loginModal = document.getElementById("loginModal");
        var registerModal = document.getElementById("signupModal");
        var forgotPasswordModal = document.getElementById("forgotPasswordModal");
        var resetPasswordModal = document.getElementById('resetPasswordModal');

        // Lấy nút mở modal
        var accountLink = document.getElementById("account-link");

        // Lấy nút đóng modal
        var closeLoginModal = document.getElementById("closeLoginModal");
        var closeRegisterModal = document.getElementById("closeSignupModal");
        var closeForgotPasswordModal = document.getElementById("closeForgotPasswordModal");
        var closeResetPasswordModal = document.getElementById("closeResetPasswordModal");

        // Lấy liên kết để mở modal đăng ký
        var registerLink = document.querySelector(".register-link");
        var loginLink = document.querySelector(".login-link");

        // Khi nhấn vào biểu tượng tài khoản, mở modal đăng nhập
        accountLink.onclick = function() {
            loginModal.style.display = "block";
        }

        // Khi nhấn vào nút đóng modal đăng nhập, ẩn modal
        closeLoginModal.onclick = function() {
            loginModal.style.display = "none";
        }

        // Khi nhấn vào nút đóng modal đăng ký, ẩn modal
        closeRegisterModal.onclick = function() {
            registerModal.style.display = "none";
        }

        document.querySelector(".forgot-password-link").onclick = function() {
            loginModal.style.display = "none"; // Ẩn modal đăng nhập
            forgotPasswordModal.style.display = "flex"; // Hiện modal quên mật khẩu
        }

        // Đóng modal Quên Mật Khẩu
        closeForgotPasswordModal.onclick = function() {
            forgotPasswordModal.style.display = "none"; // Ẩn modal quên mật khẩu
        }

        closeResetPasswordModal.onclick = function() {
            resetPasswordModal.style.display = "none"; // Ẩn modal quên mật khẩu
        }

        // Khi nhấn ra ngoài modal, ẩn modal
        window.onclick = function(event) {
            if (event.target == loginModal || event.target == registerModal || event.target == forgotPasswordModal || event.target == resetPasswordModal) {
                loginModal.style.display = "none";
                registerModal.style.display = "none";
                forgotPasswordModal.style.display = "none";
                resetPasswordModal.style.display = "none"
            }
        }

        // Khi nhấn vào liên kết "Đăng ký", ẩn modal đăng nhập và hiển thị modal đăng ký
        registerLink.onclick = function() {
            loginModal.style.display = "none"; // Ẩn modal đăng nhập
            registerModal.style.display = "flex"; // Hiện modal đăng ký
        }

        loginLink.onclick = function() {
            registerModal.style.display = "none"; // Ẩn modal đăng nhập
            loginModal.style.display = "flex"; // Hiện modal đăng ký
        }

        document.getElementById("admin-checkbox").addEventListener("change", function() {
            var adminCodeInput = document.getElementById("admin-code");
            if (this.checked) {
                adminCodeInput.style.display = "block"; // Hiện input mã admin
            } else {
                adminCodeInput.style.display = "none"; // Ẩn input mã admin
                adminCodeInput.value = ""; // Đặt giá trị input về rỗng
            }
        });
        
        document.getElementById("signup-form").onsubmit = function(event) {
            event.preventDefault(); // Ngăn chặn gửi thông thường

            fetch("account/Dangky.php", {
                method: "POST",
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.isAdmin) {
                        window.location.href = "Admin.php"; // Chuyển hướng đến trang admin nếu là admin
                    } else {
                        window.location.href = "Index.php"; // Chuyển hướng đến trang chính nếu không phải admin
                    } // Chuyển hướng đến trang chính
                } else {
                    document.getElementById("signup-error").innerText = data.error_message;
                    document.getElementById("signup-error").style.display = "block"; // Hiển thị lỗi
                }
            })
            .catch(console.error);
        };

        document.getElementById("login-form").onsubmit = function(event) {
            event.preventDefault();
            
            fetch("account/Dangnhap.php", {
                method: "POST",
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // In phản hồi để kiểm tra
                if (data.success) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                } else {
                    document.getElementById("login-error").innerText = data.error_message;
                    document.getElementById("login-error").style.display = "block";
                }
            })
            .catch(console.error);
        };

        var cartLink = document.getElementById("cart-link");
        if (cartLink) {
            cartLink.onclick = function() {
                loginModal.style.display = "block"; // Mở modal đăng nhập
            };
        }

        var lienheLink = document.getElementById("lienhe-link");
        if (lienheLink) {
            lienheLink.onclick = function() {
                loginModal.style.display = "block"; // Mở modal đăng nhập
            };
        }

        var lichsuLink = document.getElementById("lichsu-link");
        if (lichsuLink) {
            lichsuLink.onclick = function() {
                loginModal.style.display = "block"; // Mở modal đăng nhập
            };
        }

        document.getElementById("forgot-password-form").onsubmit = function(event) {
            event.preventDefault(); // Ngăn chặn gửi form truyền thống

            // Sử dụng fetch API để gửi dữ liệu
            fetch("account/Quenmk.php", { // Đổi tên file PHP nếu cần
                method: "POST",
                body: new FormData(this) // Gửi toàn bộ dữ liệu form
            })
            .then(response => response.json()) // Parse kết quả JSON
            .then(data => {
                if (data.success) {
                    // Hiển thị mã xác thực
                    var verificationCodeElement = document.getElementById("verification-code");
                    verificationCodeElement.innerText = "Mã xác thực của bạn: " + data['verification-code'];
                    verificationCodeElement.style.display = "block"; // Hiển thị mã xác thực

                    // Hiển thị nút chuyển modal đặt lại mật khẩu
                    var resetModalButton = document.getElementById("reset-modal");
                    resetModalButton.style.display = "block"; // Hiển thị nút

                    resetModalButton.onclick = function() {
                        forgotPasswordModal.style.display = "none"; 
                        resetPasswordModal.style.display = "flex"; 
                    }
                }
                else {
                    // Hiển thị thông báo lỗi
                    document.getElementById("forgot-password-error").innerText = data.error_message;
                    document.getElementById("forgot-password-error").style.display = "block"; // Hiển thị lỗi
                }
            })
            .catch(error => {
                console.error("Đã xảy ra lỗi: ", error);
            });
        };
        // Khi người dùng nhấn nút Đặt lại mật khẩu
        document.getElementById("reset-password-form").onsubmit = function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định

            fetch("account/ResetMk.php", { // Thay đổi đường dẫn nếu cần thiết
                method: "POST",
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hiển thị thông báo thành công
                    document.getElementById("reset-error").style.display = "none"; // Ẩn thông báo lỗi nếu có
                    document.getElementById("redirect-message").style.display = "block"; // Hiển thị thông báo đợi 3 giây

                    setTimeout(function() {
                        document.getElementById("resetPasswordModal").style.display = "none"; // Ẩn modal Đặt lại mật khẩu
                        document.getElementById("loginModal").style.display = "block"; // Hiển thị modal Đăng nhập
                    }, 3000);

                } else {
                    document.getElementById("reset-error").innerText = data.error_message;
                    document.getElementById("reset-error").style.display = "block"; // Hiển thị thông báo lỗi nếu có
                }
            })
            .catch(console.error);
        };
        document.addEventListener('DOMContentLoaded', function() {
            const mainMenuLinks = document.querySelectorAll('.main-menu a');
            const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');

            mainMenuLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    localStorage.setItem('menuActive', 'inactive');
                    sidebarLinks.forEach(sidebarLink => {
                        sidebarLink.classList.remove('active');
                        sidebarLink.classList.add('inactive');
                    });
                });
            });
        });

    </script>
</body>
</html>
