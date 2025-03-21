<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffeeweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$sql = "SELECT 
            shop.shopname AS ten_cua_hang, 
            thongke.nampro AS ten_san_pham,
            thongke.amount AS soluong
        FROM thongke
        JOIN shop ON thongke.shopid = shop.shopid
        GROUP BY shop.shopname, thongke.nampro
        ORDER BY shop.shopname, thongke.nampro";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống Kê Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }
        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        img {
            display: block;
            margin: 0 auto;
            width: 200px;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <img src="imgs/Kalitalogo.png" alt="Logo">
    <h1>Thống Kê Sản Phẩm Theo Cửa Hàng</h1>
    <table>
        <thead>
            <tr>
                <th>Tên Cửa Hàng</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $last_shopname = "";  
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    if ($row['ten_cua_hang'] != $last_shopname) {
                        echo "<tr>";
                        echo "<td rowspan='1'>" . htmlspecialchars($row['ten_cua_hang']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ten_san_pham']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['soluong']) . "</td>";
                        echo "</tr>";
                    } else {
                        
                        echo "<tr>";
                        echo "<td>  </td>";
                        echo "<td>" . htmlspecialchars($row['ten_san_pham']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['soluong']) . "</td>";
                        echo "</tr>";
                    }
                    $last_shopname = $row['ten_cua_hang']; // Cập nhật tên cửa hàng đã hiển thị
                }
            } else {
                echo "<tr><td colspan='3' class='no-data'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
