<?php
    session_start(); // Bắt đầu phiên làm việc

    $username = $_SESSION['username'];
    $fullname = $_SESSION['tendn'];
    // Kết nối tới cơ sở dữ liệu
    $conn = new mysqli("localhost", "root", "", "thucphamchucnang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Xử lý khi form được gửi
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Nhận dữ liệu từ form và bảo vệ chống SQL Injection
        $email = $conn->real_escape_string($_POST['email']);
        $message = $conn->real_escape_string($_POST['message']);

        // Câu lệnh SQL để chèn dữ liệu vào bảng lienhe
        $sql = "INSERT INTO lienhe (tendn, email, gopy) VALUES ('$fullname', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            $successMessage = "Thông tin của bạn đã được gửi. Chúng tôi sẽ liên hệ với bạn sớm nhất có thể!";
        } else {
            $errorMessage = "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }

    // Đóng kết nối
    $conn->close();
?>

<?php
    include 'layout/Header.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ với chúng tôi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .page-container {
            display: flex;
            margin: 10px;/* Sử dụng Flexbox để sắp xếp các phần tử */
        }
        .contact-form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            min-height: 490px;
            margin-top: 35px;
            margin-left: 200px;
            width: 100%;
            text-align: center;
            margin-bottom: 30px;
            border: 1px solid #466E73;
        }
        .contact-form h2 {
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: 25px;
        }
        .contact-form p {
            font-size: 15px;
            color: black;
            margin-bottom: 10px;
        }
        .contact-form input{
            width: 90%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }
        .contact-form textarea {
            margin-top: 8px;
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }
        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
        .contact-form button {
            background-color: #65A69A;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .contact-form button:hover {
            background-color: #466E73;
        }
        .message {
            margin-top: 20px;
            font-size: 16px;
            color: green;
        }
        .error {
            margin-top: 20px;
            font-size: 16px;
            color: red;
        }
        .page-container{
            margin: 10px;
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
        <div class="contact-form">
            <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
            <p>Vui lòng điền thông tin dưới đây để liên hệ với chúng tôi</p>

            <form action="Lienhe.php" method="POST">
                <input type="text" name="name" placeholder="Tên" required value="<?php echo htmlspecialchars($username); ?>">
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" rows="5" placeholder="Nội dung" required></textarea>
                <button type="submit">Gửi liên hệ</button>
            </form>

            <?php if (!empty($successMessage)) : ?>
                <div class="message"><?php echo $successMessage; ?></div>
            <?php elseif (!empty($errorMessage)) : ?>
                <div class="error"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <?php
            include 'layout/Footer.php';
        ?>
    </div>
</body>
</html>
