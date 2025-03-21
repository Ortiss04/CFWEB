<?php
require_once 'admincp/config/config.php';


$connect = new mysqli($sever, $user, $pass, $database);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];

   
        $sql = "DELETE FROM product WHERE ID = ?";

        if ($stmt = $connect->prepare($sql)) {
            $stmt->bind_param("s", $id);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Xóa sản phẩm thành công!";
                header('Location: admin.php');
                exit();
            } else {
                echo "Lỗi khi xóa sản phẩm: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Lỗi khi chuẩn bị câu lệnh: " . $connect->error;
        }
    } else {
        echo "ID không hợp lệ.";
    }




$connect->close();
?>
