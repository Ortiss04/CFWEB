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
            background-color: #f2f2f2;
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
            background-color: black;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
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
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Đăng Nhập Admin</h2>

        <!-- Hiển thị thông báo lỗi nếu thông tin đăng nhập sai -->
        <?php if (isset($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="username">Tài Khoản</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mật Khẩu</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Đăng Nhập</button>
        </form>

       
    </div>

</body>
</html>
