<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Footer Example</title>
    <style>
        footer {
            background-color: #466E73; /* Màu nền cho footer */
            text-align: center;           /* Căn giữa nội dung */
            padding: 20px 0;              /* Khoảng cách trên dưới */
            font-size: 16px;              /* Kích thước chữ */
            color: white;                 /* Màu chữ */
            position: relative;           /* Đặt vị trí cố định */
            bottom: 0;                    /* Đưa footer xuống cuối trang */
            width: 100%;  
            height: 40px;     
            display: flex;  
            justify-content: center;      /* Căn giữa theo chiều ngang */
            align-items: center;   
            z-index: 200;
            clear: both;      /* Căn giữa theo chiều dọc */
        }

        footer p {
            margin: 0 200px;               /* Khoảng cách giữa các đoạn văn */
        }
    </style>
</head>
<body>
    <footer>
        <p>Vũ Thị Vân Anh - 06/08/2003</p>
        <p>Nguyễn Anh Tuấn - 11/04/2003</p>
    </footer>
</body>
</html>
