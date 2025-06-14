<?php
session_start();

// Định nghĩa tài khoản admin
define('ADMIN_USERNAME', 'Kalita');
define('ADMIN_PASSWORD', '0904');

// Kiểm tra nếu admin đã đăng nhập


// Kiểm tra nếu biểu mẫu đã được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra thông tin đăng nhập
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;  // Đặt session cho người dùng đã đăng nhập
        header("Location: admin.php");  // Điều hướng đến trang quản trị
        exit();
    } else {
        $error_message = "Tên tài khoản hoặc mật khẩu không đúng!";  // Hiển thị lỗi nếu thông tin đăng nhập sai
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập Admin</title>

    <style>
        /* Kiểu dáng cho trang đăng nhập */
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(212, 212, 212);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 300px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: black;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            background: linear-gradient(135deg, #b37828, #dd9933);
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        button:hover {
            background: linear-gradient(135deg, #dd9933, #b37828);
        }

        .back-btn {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            background-color: black;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }


        .back-btn:hover {
            background: linear-gradient(135deg, #c9302c, #d9534f);
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-decoration: none;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .text {
            color: black;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>ĐĂNG NHẬP</h2>

        <!-- Hiển thị thông báo lỗi nếu thông tin đăng nhập sai -->
        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label class="text" for="username">Tài Khoản</label>
            <input type="text" id="username" name="username" required>

            <label class="text" for="password">Mật Khẩu</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Đăng Nhập</button>
            <a href="index.php" class="back-btn">Trở Về Trang Chủ</a>
        </form>


    </div>

</body>

</html>