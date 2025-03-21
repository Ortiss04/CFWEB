<?php
session_start();
require_once 'admincp/config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_hang = $_POST['ID'];
    $ten_hang = $_POST['namepro'];
    $so_luong = $_POST['amount'];
    $gia=$_POST['price'];
    
   
    $img_name = basename($_FILES["img"]["name"]);

    $sql = "INSERT INTO product (ID, namepro, price ,amount, img) 
            VALUES ('$ma_hang', '$ten_hang','$gia', $so_luong, '$img_name')";
    
    if ($connect->query($sql) === TRUE) 
    {
         $_SESSION['success_message'] = "Thêm mặt hàng thành công!"; 
    } else 
        { $_SESSION['error_message'] = "Lỗi: " . $connect->error; 
            
        }
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Mặt Hàng Cà Phê</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Mặt Hàng Mới</h2>
        <?php if (isset($_SESSION['success_message']))
         {   echo '<p class="success">' . $_SESSION['success_message'] . '</p>';
             unset($_SESSION['success_message']);
           }
            if (isset($_SESSION['error_message']))
            { 
                echo '<p class="error">' . $_SESSION['error_message'] . '</p>';
                 unset($_SESSION['error_message']);
            } 
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Mã Hàng</label>
                <input type="text" name="ID" required>
            </div>
            <div class="form-group">
                <label>Tên Hàng</label>
                <input type="text" name="namepro" required>
            </div>
            <div class="form-group">
                <label>Giá</label>
                <input type="text" name="price" required>
            </div>
            <div class="form-group">
                <label>Số Lượng</label>
                <input type="number" name="amount" required>
            </div>
            <div class="form-group">
                <label>Hình Ảnh</label>
                <input type="file" name="img" required>
            </div>
            <button type="submit" class="btn">Thêm Mặt Hàng</button>
            <button type="submit" class="btn"; onclick='window.location.href="admin.php"'>Quay lại trang admin</button>
        </form>
    </div>
</body>
</html>