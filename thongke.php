<?php
$sever = 'localhost';
$user = 'root';
$pass = '';
$database = 'test';

$conn = new mysqLi($sever, $user, $pass, $database);

if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
}

$sql = "SELECT 
            shop.shopname AS ten_cua_hang, 
            thongke.namepro AS ten_san_pham,
            thongke.amount AS soluong
        FROM thongke
        JOIN shop ON thongke.shopid = shop.shopid
        GROUP BY shop.shopname, thongke.namepro
        ORDER BY shop.shopname, thongke.namepro";

$result = $conn->query($sql);
if ($result === false) {
    die("Lỗi truy vấn SQL: " . $conn->error);
}
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

        th,
        td {
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

        .back-btn {
            display: inline-block;
            margin-left: 140px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #dd9933, #b37828);
            color: white;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #b37828, #dd9933);
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .back-btn::before {
            content: '← ';
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            table {
                width: 95%;
            }

            th,
            td {
                padding: 10px;
                font-size: 0.9rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            img.logo {
                width: 120px;
            }

            .back-btn {
                padding: 8px 15px;
                font-size: 0.9rem;
                margin-left: 2.5%;
            }
        }

        @media (max-width: 576px) {
            table {
                width: 100%;
            }

            th,
            td {
                padding: 8px;
                font-size: 0.8rem;
            }

            h1 {
                font-size: 1.3rem;
            }

            img.logo {
                width: 100px;
            }

            .back-btn {
                display: block;
                width: 90%;
                margin: 0 auto 10px;
                text-align: center;
                padding: 10px;
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <img src="imgs/Kalitalogo.png" alt="Kalita Café Logo" class="logo">
    <h1>Thống Kê Sản Phẩm Theo Cửa Hàng</h1>
    <a href="admin.php" class="back-btn">Quay lại</a>
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
                while ($row = $result->fetch_assoc()) {

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