<?php

require_once 'admincp/config/config.php';


$sql = "SELECT * FROM product";
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản Lý Mặt Hàng Cà Phê</title>
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="imgs/Kalitalogo.png">
            <h2>DANH SÁCH MẶT HÀNG CÀ PHÊ</h2>
        </div>
        <a href="add.php" class="btn add-btn">THÊM MẶT HÀNG MỚI</a>
        <a href="thongke.php" class="btn add-btn">XEM THỐNG KÊ</a></a>
        <a href="index.php" class="btn add-btn">ĐĂNG XUẤT</a></a>
        <table>
            <thead>
                <tr>
                    <th>Mã Hàng</th>
                    <th>Tên Hàng</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Hình Ảnh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['namepro']; ?></td>
                        <td><?php echo number_format($row['price'], 0, ',', '.'); ?>₫</td>
                        <td><?php echo $row['amount']; ?></td>
                        <td>
                            <img src="imgs/<?php echo $row['img']; ?>"
                                width="100"
                                alt="<?php echo $row['namepro']; ?>">
                        </td>
                        <td>
                            <a href="update.php?ID=<?php echo $row['ID']; ?>" class="btn edit-btn">Sửa</a>
                            <a href="delete.php?ID=<?php echo $row['ID']; ?>"
                                class="btn delete-btn"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>