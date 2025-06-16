<?php
// Kiểm tra file config
include "../admincp/config/config.php";

// Kiểm tra kết nối database
$conn = new mysqli($sever, $user, $pass, $database);
if ($conn->connect_error) {
    $error_message = "Lỗi kết nối database: " . $conn->connect_error;
    file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - ' . $error_message . PHP_EOL, FILE_APPEND);
    die($error_message);
}
$conn->set_charset("utf8mb4");

$cart_items = [];
$total_amount = 0;
$error_message = '';
$qr_data_url = '';
$ma_giao_dich = '';
$transaction_id = mt_rand(100000, 999999);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - POST Data: ' . print_r($_POST, true) . PHP_EOL, FILE_APPEND);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_items'], $_POST['total_amount'])) {
    $cart_items = json_decode($_POST['cart_items'], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        $error_message = 'Lỗi decode JSON: ' . json_last_error_msg();
        file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - JSON Error: ' . $error_message . PHP_EOL, FILE_APPEND);
    } else {
        $total_amount = (int)$_POST['total_amount'];

        if (empty($cart_items) || $total_amount <= 0) {
            $error_message = 'Giỏ hàng trống hoặc số tiền không hợp lệ.';
        } else if (isset($_POST['payment_method']) && $_POST['payment_method'] === 'qr') {
            // Tìm mã giao dịch chưa sử dụng
            for ($i = 1; $i <= 9999; $i++) {
                $potential_ma_giao_dich = (string)$i;
                $sql_check = "SELECT COUNT(*) AS count FROM giaodich WHERE MaGiaoDich = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("s", $potential_ma_giao_dich);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();
                $row_check = $result_check->fetch_assoc();
                if ($row_check['count'] == 0) {
                    $ma_giao_dich = $potential_ma_giao_dich;
                    break;
                }
                $stmt_check->close();
            }

            if ($ma_giao_dich === '') {
                $error_message = 'Lỗi: Không còn mã giao dịch khả dụng (1–9999). Vui lòng liên hệ quản trị viên.';
                file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - Error: No available MaGiaoDich in range 1–9999' . PHP_EOL, FILE_APPEND);
            } else {
                // Thông tin ngân hàng
                $bank_info = [
                    'bank_name' => 'Sacombank',
                    'account_no' => '070135024196',
                    'account_name' => 'DO MINH THUONG',
                    'acq_id' => '970403', // Sacombank BIN
                ];

                // Tạo QR code qua VietQR API
                $api_url = 'https://api.vietqr.io/v2/generate';
                $add_info = "Thanh toan don hang TID{$transaction_id} GD{$ma_giao_dich}";
                $post_data = [
                    'accountNo' => $bank_info['account_no'],
                    'accountName' => $bank_info['account_name'],
                    'acqId' => $bank_info['acq_id'],
                    'addInfo' => $add_info,
                    'amount' => $total_amount,
                    'template' => 'BTm2MtI',
                ];

                $ch = curl_init($api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

                $response = curl_exec($ch);
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($response === false) {
                    $error_message = 'Lỗi cURL: ' . curl_error($ch);
                    file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - cURL Error: ' . curl_error($ch) . PHP_EOL, FILE_APPEND);
                }
                curl_close($ch);

                if ($http_code === 200 && $response !== false) {
                    $response_data = json_decode($response, true);
                    if (isset($response_data['code']) && $response_data['code'] === '00') {
                        $qr_data_url = $response_data['data']['qrDataURL'];
                        // Lưu giao dịch vào database
                        $sql = "INSERT INTO giaodich (SoTien, MaGiaoDich, QRDataURL, TrangThai) VALUES (?, ?, ?, 'cho_xu_ly')";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iss", $total_amount, $ma_giao_dich, $qr_data_url);
                        if (!$stmt->execute()) {
                            $error_message = 'Lỗi khi lưu giao dịch: ' . $conn->error;
                            file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - SQL Error: ' . $conn->error . PHP_EOL, FILE_APPEND);
                        }
                        $stmt->close();
                    } else {
                        $error_message = 'Lỗi từ VietQR API: ' . ($response_data['desc'] ?? 'Không rõ');
                        file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - VietQR Error: ' . ($response_data['desc'] ?? 'Unknown') . PHP_EOL, FILE_APPEND);
                    }
                } else {
                    $error_message = 'Lỗi kết nối VietQR API (HTTP ' . $http_code . ')';
                    file_put_contents('payment_error_log.txt', date('Y-m-d H:i:s') . ' - HTTP Error: ' . $http_code . PHP_EOL, FILE_APPEND);
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ThanhToan.css">
</head>

<body>
    <div id="toast" class="toast">
        <span id="toast-message"></span>
    </div>
    <div class="payment-container fade-in">
        <h2>Thanh Toán Đơn Hàng</h2>
        <?php if ($qr_data_url): ?>
            <div class="qr-code-container">
                <h3>Mã QR Thanh Toán</h3>
                <div class="qr-content">
                    <img src="<?php echo htmlspecialchars($qr_data_url); ?>" alt="Mã QR Thanh Toán">
                    <div class="payment-info">
                        <p><strong>Tổng tiền:</strong> <?php echo number_format($total_amount, 0, ',', '.'); ?> VND</p>
                        <p><strong>Tên chủ tài khoản:</strong> DO MINH THUONG</p>
                        <p><strong>Số tài khoản:</strong> 070135024196</p>
                        <p><strong>Ngân hàng:</strong> Sacombank</p>
                        <p><strong>Ngày gửi:</strong> <?php echo date('d/m/Y'); ?></p>
                        <p><strong>Nội dung chuyển khoản:</strong> Thanh toan don hang TID<?php echo $transaction_id; ?> GD<?php echo htmlspecialchars($ma_giao_dich); ?></p>
                        <p><strong>Sản phẩm:</strong></p>
                        <ul>
                            <?php foreach ($cart_items as $item): ?>
                                <li><?php echo htmlspecialchars($item['name']); ?> - <?php echo number_format($item['price'], 0, ',', '.'); ?> VND</li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <p class="text-center mt-3">Vui lòng quét mã QR để chuyển khoản. Đơn hàng sẽ được xử lý sau khi admin xác nhận thanh toán.</p>
            </div>
        <?php elseif ($error_message): ?>
            <div class="error-message fade-in">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php else: ?>
            <form method="POST" id="payment-form">
                <div class="payment-method">
                    <label for="payment_method" class="form-label">Chọn phương thức thanh toán</label>
                    <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="qr">Thanh toán bằng mã QR</option>
                    </select>
                </div>
                <input type="hidden" name="cart_items" value='<?php echo htmlspecialchars($_POST['cart_items'] ?? '[]'); ?>'>
                <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($_POST['total_amount'] ?? '0'); ?>">
                <button type="submit" class="btn btn-pay">Thanh toán</button>
            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="ThanhToan.js"></script>
</body>

</html>