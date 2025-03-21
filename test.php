<?php
class Database
{
    private $connection;

    public function __construct()
    {
        include("admincp/config/config.php");
        $this->connection = new mysqli($sever, $user, $pass, $database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        $this->connection->set_charset("utf8mb4");
    }

    public function getProducts($searchTerm = '')
    {
        // Modify the SQL query to include search functionality
        $sql = "SELECT namepro, price, img FROM product WHERE (ID LIKE 'L%')";
        
        if (!empty($searchTerm)) {
            // Use prepared statement to prevent SQL injection
            $searchParam = "%{$searchTerm}%";
            $sql .= " AND namepro LIKE ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $this->connection->query($sql);
        }

        $products = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }

        return $products;
    }

    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}

// Get search term from GET request
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

$db = new Database();
$products = $db->getProducts($searchTerm);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <!-- Previous head content remains the same -->
    <style>
        /* Previous styles remain the same */
        .search-container {
            display: flex;
            justify-content: center;
            padding: 20px 0;
            background-color: #444;
            padding-left: 400px;
        }

        .search-input {
            width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .search-button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .no-results {
            text-align: center;
            color: white;
            padding: 20px;
            background-color: #444;
            padding-left: 400px;
        }
    </style>
</head>
<body style="background-color: #f5f5f5; margin: 0; padding: 0;">
    <!-- Previous header content remains the same -->

    <!-- Add search container -->
    <div class="search-container">
        <form action="" method="GET">
            <input type="text" name="search" class="search-input" 
                   placeholder="Tìm kiếm sản phẩm..." 
                   value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit" class="search-button">Tìm kiếm</button>
        </form>
    </div>

    <div class="product-grid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="imgs/<?php echo htmlspecialchars($product['img']); ?>"
                            alt="<?php echo htmlspecialchars($product['namepro']); ?>">
                    </div>
                    <div class="product-info">
                        <h3 class="product-name">
                            <?php echo htmlspecialchars($product['namepro']); ?>
                        </h3>
                        <div class="product-price">
                            <?php echo number_format($product['price'], 0, ',', '.'); ?>₫
                            <button class="add-to-cart-btn">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                Không tìm thấy sản phẩm nào phù hợp với từ khóa "<?php echo htmlspecialchars($searchTerm); ?>".
            </div>
        <?php endif; ?>
    </div>

    <?php $db->close(); ?>

    <!-- Previous footer and script content remains the same -->
</body>
</html>