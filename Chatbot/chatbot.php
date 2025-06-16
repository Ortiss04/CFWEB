<?php
header('Content-Type: application/json');
include "../admincp/config/config.php";
$input = json_decode(file_get_contents('php://input'), true);
$query = strtolower(trim($input['query'] ?? ''));

//lời chào
$greetingKeywords = ['chào', 'hello', 'hi', 'xin chào'];
$isGreeting = false;
foreach ($greetingKeywords as $keyword) {
    if (stripos($query, $keyword) !== false) {
        $isGreeting = true;
        break;
    }
}

// lấy dữ liệu sản phẩm
$sql_products = "SELECT ID, namepro, price, amount FROM product";
$result_products = $connect->query($sql_products);
$products = [];
if ($result_products && $result_products->num_rows > 0) {
    while ($row = $result_products->fetch_assoc()) {
        $products[] = $row;
    }
}

// lấy dữ liệu bộ sản phẩm
$sql_kits = "SELECT masp, tensp, tp, gia FROM productkitp";
$result_kits = $connect->query($sql_kits);
$kits = [];
if ($result_kits && $result_kits->num_rows > 0) {
    while ($row = $result_kits->fetch_assoc()) {
        $kits[] = $row;
    }
}

// lấy dữ liệu cửa hàng
$sql_shops = "SELECT shopid, shopname, shopaddr FROM shop";
$result_shops = $connect->query($sql_shops);
$shops = [];
if ($result_shops && $result_shops->num_rows > 0) {
    while ($row = $result_shops->fetch_assoc()) {
        $shops[] = $row;
    }
}
// lấy dữ liệu thống kê sản phẩm bán chạy
$sql_stats = "SELECT shopname, namepro, amount FROM thongke ORDER BY amount DESC";
$result_stats = $connect->query($sql_stats);
$stats = [];
if ($result_stats && $result_stats->num_rows > 0) {
    while ($row = $result_stats->fetch_assoc()) {
        $stats[] = $row;
    }
}

// Tìm kiếm sản phẩm hoặc bộ sản phẩm dựa trên từ khóa
$targetItem = null;
foreach ($products as $product) {
    if (stripos($product['namepro'], $query) !== false) {
        $targetItem = $product;
        break;
    }
}
if (!$targetItem) {
    foreach ($kits as $kit) {
        if (stripos($kit['tensp'], $query) !== false) {
            $targetItem = $kit;
            break;
        }
    }
}

// tạo câu trả lời cho chatbot
$context = "Bạn là một chatbot chuyên về cà phê của website Kalita Cafe. Nhiệm vụ của bạn là trả lời các câu hỏi của người dùng một cách tự nhiên, chính xác và ngắn gọn. Dưới đây là dữ liệu từ database:\n";

$context .= "--- Sản phẩm cà phê và dụng cụ ---\n";
foreach ($products as $product) {
    $context .= "Tên sản phẩm: {$product['namepro']} \n" .
        "Mã sản phẩm: {$product['ID']} \n" .
        "Giá: " . number_format($product['price'], 0, ',', '.') . " VND \n" .
        "Số lượng tồn kho: {$product['amount']} \n" .
        "----------------------------------------\n";
}

$context .= "--- Bộ sản phẩm cà phê ---\n";
foreach ($kits as $kit) {
    $context .= "Tên bộ sản phẩm: {$kit['tensp']} \n" .
        "Mã sản phẩm: {$kit['masp']} \n" .
        "Thành phần: {$kit['tp']} \n" .
        "Giá: " . number_format($kit['gia'], 0, ',', '.') . " VND \n" .
        "----------------------------------------\n";
}

$context .= "--- Cửa hàng ---\n";
foreach ($shops as $shop) {
    $context .= "Tên cửa hàng: {$shop['shopname']} \n" .
        "Địa chỉ: {$shop['shopaddr']} \n" .
        "----------------------------------------\n";
}

$context .= "--- Sản phẩm bán chạy ---\n";
foreach ($stats as $stat) {
    $context .= "Sản phẩm: {$stat['namepro']} \n" .
        "Cửa hàng: {$stat['shopname']} \n" .
        "Số lượng bán: {$stat['amount']} \n" .
        "----------------------------------------\n";
}

if ($isGreeting) {
    $context .= "Nếu người dùng chào (ví dụ: 'chào bạn', 'hello'), hãy trả lời thân thiện: 'Chào bạn! Mình là chatbot của Kalita Cafe, sẵn sàng giúp bạn với thông tin về cà phê, sản phẩm, hoặc cửa hàng nhé!' ";
} elseif (stripos($query, 'có ngon không') !== false || stripos($query, 'ngon không') !== false) {
    if ($targetItem) {
        $popularity = 0;
        foreach ($stats as $stat) {
            if ($stat['namepro'] == $targetItem['namepro']) {
                $popularity += $stat['amount'];
            }
        }
        if ($popularity > 100) {
            $context .= "Nếu người dùng hỏi về việc sản phẩm có ngon không, hãy trả lời: '{$targetItem['namepro']} bán được {$popularity} đơn, được nhiều khách hàng yêu thích, rất đáng thử!' ";
        } elseif ($popularity > 0) {
            $context .= "Nếu người dùng hỏi về việc sản phẩm có ngon không, hãy trả lời: '{$targetItem['namepro']} bán được {$popularity} đơn, là một lựa chọn ổn, bạn có thể thử!' ";
        } else {
            $context .= "Nếu người dùng hỏi về việc sản phẩm có ngon không mà không có dữ liệu bán, hãy trả lời: 'Hiện tại, chưa có thông tin đánh giá về {$targetItem['namepro']}. Tuy nhiên, với giá " . number_format($targetItem['price'] ?? $targetItem['gia'], 0, ',', '.') . " VND, đây là một sản phẩm đáng để thử!' ";
        }
    } else {
        $context .= "Nếu không tìm thấy sản phẩm, hãy trả lời: 'Xin lỗi, tôi không tìm thấy thông tin về sản phẩm bạn hỏi. Bạn có thể thử hỏi theo cách khác không?' ";
    }
} else {
    $context .= "Nếu câu hỏi yêu cầu gợi ý sản phẩm, hãy chọn sản phẩm hoặc bộ sản phẩm phù hợp nhất dựa trên tiêu chí (giá, loại sản phẩm, cửa hàng, v.v.). ";
}

$context .= "Nếu không tìm thấy thông tin phù hợp và không phải lời chào, hãy trả lời: 'Xin lỗi, tôi không tìm thấy thông tin phù hợp. Bạn có thể thử hỏi theo cách khác không?' Đừng trả lời các câu hỏi không liên quan đến cà phê, bộ sản phẩm, hoặc cửa hàng. Câu hỏi của người dùng: \"$query\"";

// Call Gemini API
$apiKey = 'AIzaSyCHiPYt701_-Vmot-5pZJNDcW7YVQJ-qKk';
$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $apiKey;

$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => $context]
            ]
        ]
    ]
];

$ch = curl_init($url);
if (!$ch) {
    echo json_encode(['reply' => 'Lỗi khởi tạo yêu cầu API. Vui lòng thử lại sau.']);
    exit;
}
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
if ($response === false) {
    echo json_encode(['reply' => 'Lỗi gọi API. Vui lòng thử lại sau.']);
    curl_close($ch);
    exit;
}
curl_close($ch);

$geminiResponse = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON Decode Error: " . json_last_error_msg());
    echo json_encode(['reply' => 'Lỗi phân tích phản hồi API. Vui lòng thử lại sau.']);
    exit;
}
$reply = $geminiResponse['candidates'][0]['content']['parts'][0]['text'] ?? 'Tôi không hiểu câu hỏi của bạn. Hãy thử lại nhé!';
$reply = str_replace(['*', '**', '***'], '', $reply);
echo json_encode(['reply' => $reply]);
