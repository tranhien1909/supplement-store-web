<?php
    include 'layout/Header.php';
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");
    if ($conn->connect_error) {
        die(json_encode(["success" => false, "error_message" => "Kết nối thất bại!"]));
    }

    $fullname = $_SESSION['tendn'];
    $message = ''; // Biến để lưu thông báo
    $redirect = false;

    // Nếu người dùng đã nhấn nút "Cập nhật"
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tentk'])) {
        // Lấy dữ liệu từ form
        $tentk = $_POST['tentk'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Cập nhật thông tin tài khoản cơ bản (không có mật khẩu)
        $query = "UPDATE users SET tentk = ?, email = ?, sdt = ?, diachi = ? WHERE tendn = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $tentk, $email, $sdt, $diachi, $fullname);

        if ($stmt->execute()) {
            $message = "Cập nhật thành công! Mời bạn đăng nhập lại sau 3s";
            $redirect = true;
        } else {
            $message = "Cập nhật không thành công, vui lòng thử lại.";
        }

        // Kiểm tra nếu người dùng muốn đổi mật khẩu
        if (!empty($current_password) && !empty($new_password) && !empty($confirm_password)) {
            // Kiểm tra mật khẩu mới và xác nhận mật khẩu khớp
            if ($new_password === $confirm_password) {
                // Truy vấn lấy mật khẩu hiện tại từ cơ sở dữ liệu
                $query = "SELECT matkhau FROM users WHERE tendn = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $fullname);
                $stmt->execute();
                $result = $stmt->get_result();
                $userdata = $result->fetch_assoc();

                // Kiểm tra mật khẩu hiện tại có khớp không
                if (password_verify($current_password, $userdata['matkhau'])) {
                    // Cập nhật mật khẩu mới
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $query = "UPDATE users SET matkhau = ? WHERE tendn = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ss", $hashed_password, $fullname);

                    if ($stmt->execute()) {
                        $message = "Cập nhật thông tin thành công! Mời bạn đăng nhập lại sau 3s";
                    } else {
                        $message = "Cập nhật mật khẩu không thành công.";
                    }
                } else {
                    $message = "Mật khẩu hiện tại không đúng.";
                }
            } else {
                $message = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
            }
        }
    }

    // Truy vấn để lấy thông tin tài khoản
    $query = "SELECT * FROM users WHERE tendn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userdata = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy thông tin tài khoản.";
        exit;
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafffd;
            margin: 0;
            padding: 0;
        }

        .form-container {
            margin-left: 100px;
            margin-top: 32px;
            padding: 20px;
            border-radius: 10px;
            width: 700px;
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #466E73;
            margin-bottom: 40px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 25px;
            color: black;
            margin-top: 5px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin: 10px 0;
            margin-left: 40px;
        }

        .form-container label {
            font-size: 15px;
            color: #333;
            width: 25%;
            margin-right: 10px;
        }

        .form-container input {
            width: 65%;
            padding: 9px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container input:focus {
            border-color: #65A69A;
            outline: none;
            box-shadow: 0px 0px 5px rgba(101, 166, 154, 0.5);
        }

        .button-container {
            display: flex;
            margin-top: 20px;
        }

        .submit-btn, .change-btn {
            background-color: #65A69A;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s ease;
            width: 22%;
            text-align: center;
        }

        .hidden {
            display: none;
        }

        .page-container {
            margin: 10px;
        }

        #notification {
            display: none;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            text-align: center;
            position: fixed;
            top: 110px;
            left: 55%;
            transform: translateX(-50%);
            border-radius: 5px;
            z-index: 1000;
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
    <div class="notification" id="notification"><?php echo $message; ?></div>
    <div class="page-container"> 
        <div class="sidebar-container">
            <?php include 'layout/Sidebar.php'; ?>
        </div>
        <div class="form-container" id="form-container">
            <h2>THÔNG TIN TÀI KHOẢN</h2>
            <form id="formthongtin" method="POST">
                <div class="form-group">
                    <label for="ten">Tên tài khoản</label>
                    <input type="text" name="tentk" id="tentk" value="<?php echo htmlspecialchars($userdata['tentk']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="tendn">Tên đăng nhập</label>
                    <input type="text" name="ten" id="ten" value="<?php echo htmlspecialchars($userdata['tendn']); ?>" required readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userdata['email']); ?>" required readonly>
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" name="sdt" id="sdt" value="<?php echo htmlspecialchars($userdata['sdt']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="diachi">Địa chỉ</label>
                    <input type="text" name="diachi" id="diachi" value="<?php echo htmlspecialchars($userdata['diachi']); ?>" required>
                </div>

                <div id="password-fields" class="hidden">
                    <div class="form-group">
                        <label for="current_password">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" id="current_password">
                    </div>

                    <div class="form-group">
                        <label for="new_password">Mật khẩu mới</label>
                        <input type="password" name="new_password" id="new_password">
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Nhập lại mật khẩu mới</label>
                        <input type="password" name="confirm_password" id="confirm_password">
                    </div>
                </div>

                <div class="button-container">
                    <button type="submit" name="update" class="submit-btn" style="margin-left: 175px;">Cập nhật</button>
                    <button type="button" class="change-btn" style="margin-left: 25px" onclick="showPasswordFields()">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <?php include 'layout/Footer.php'; ?>
    </div>
    <script>
        let passwordFieldsVisible = false;

        function showPasswordFields() {
            var passwordFields = document.getElementById('password-fields');
            if (!passwordFieldsVisible) {
                passwordFields.classList.remove('hidden');
            } else {
                passwordFields.classList.add('hidden');
            }
            passwordFieldsVisible = !passwordFieldsVisible;
        }

        let notification = "<?php echo addslashes($message); ?>";
        if (notification) {
            const notificationElement = document.getElementById("notification");
            document.getElementById("notification").innerHTML = notification;
            document.getElementById("notification").style.display = "block";
            setTimeout(function() {
                notificationElement.style.display = "none";
                <?php if ($redirect): ?>
                    window.location.href = "Dangxuat.php"; 
                <?php endif; ?>
            }, 3000); 
        }
    </script>
</body>
</html>