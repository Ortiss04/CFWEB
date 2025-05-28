<?php
require_once 'admincp/config/config.php';

// Kiểm tra kết nối cơ sở dữ liệu
$connect = new mysqli($sever, $user, $pass, $database);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

// Lấy ID từ URL
$id = $_GET['ID'];

// Kiểm tra ID có hợp lệ không
if (isset($id) && preg_match('/^[a-zA-Z0-9]+$/', $id)) {
    $sql = "SELECT * FROM product WHERE ID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem câu truy vấn có trả về kết quả không
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm với ID này.";
        exit();
    }
} else {
    echo "ID không hợp lệ.";
    exit();
}

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_hang = $_POST['ID'];
    $ten_hang = $_POST['namepro'];
    $gia = $_POST['price'];
    $so_luong = $_POST['amount'];
    $img_name = $row['img']; // Giữ lại tên ảnh cũ

    // Kiểm tra xem người dùng có tải lên hình ảnh mới hay không
    if (!empty($_FILES["img"]["name"])) {
        $img_name = basename($_FILES["img"]["name"]);
        $target_dir = "imgs/";
        $target_file = $target_dir . $img_name;
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    }

    // Cập nhật thông tin sản phẩm bao gồm cả tên ảnh (nếu có)
    $sql = "UPDATE product
            SET ID = ?,
                namepro = ?,
                price = ?,
                amount = ?,
                img = ?
            WHERE ID = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssdiss", $ma_hang, $ten_hang, $gia, $so_luong, $img_name, $id);

    // Thực hiện câu lệnh cập nhật
    if ($stmt->execute() === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    $stmt->close();
}

// Đóng kết nối cơ sở dữ liệu
$connect->close();
?>


<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa Mặt Hàng Cà Phê</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-control[type="file"] {
            padding: 5px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #b37828, #dd9933);
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background: linear-gradient(135deg, #dd9933, #b37828);
        }

        img {
            max-width: 200px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Sửa Mặt Hàng</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="ma_hang">Mã Hàng</label>
                <input type="text" id="ma_hang" name="ID" value="<?php echo $row['ID']; ?>" class="form-control" required>
            </div>
            <div>
                <label for="ten_hang">Tên Hàng</label>
                <input type="text" id="ten_hang" name="namepro" value="<?php echo $row['namepro']; ?>" class="form-control" required>
            </div>
            <div>
                <label for="ten_hang">Giá</label>
                <input type="text" id="ten_hang" name="price" value="<?php echo $row['price']; ?>" class="form-control" required>
            </div>
            <div>
                <label for="so_luong">Số Lượng</label>
                <input type="number" id="so_luong" name="amount" value="<?php echo $row['amount']; ?>" class="form-control" required>
            </div>
            <div>
                <label>Hình Ảnh Hiện Tại</label>
                <img src="imgs/<?php echo $row['img']; ?>" alt="Current Image">
            </div>
            <div>
                <label for="img">Thay Đổi Hình Ảnh (Nếu Muốn)</label>
                <input type="file" id="img" name="img" class="form-control">
            </div>
            <button type="submit" class="btn">Cập Nhật</button>
        </form>
    </div>
</body>

</html>