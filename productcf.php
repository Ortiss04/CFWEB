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

    public function getProducts()
    {
        $sql = "SELECT namepro, price, img FROM product where ID like 'C%'";
        $result = $this->connection->query($sql);

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

$db = new Database();
$products = $db->getProducts();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm </title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .product-grid {
            display: grid;
            grid-auto-flow: row;
            grid-auto-columns: 180px;
            gap: 15px;
            padding-bottom: 10px;
            max-width: 1200px;
            justify-content: flex-end;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            background-color: #444;
            padding-left: 200px;
            height: auto;
            padding-top: 120px;
            padding-bottom: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-right: 10px;

        }

        .product-card:hover {

            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            position: relative;
            padding-top: 100%;
            overflow: hidden;
            background: #f8f8f8;
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.1);
        }

        .product-card:hover .product-image img {
            transform: scale(1.1);
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            margin: 10px 0;
            color: #333;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 40px;
        }

        .product-price {
            color: #ee4d2d;
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 10px;
                padding: 10px;
            }

        }

        .product-name {
            font-size: 14px;
            min-height: 35px;
        }

        .product-price {
            font-size: 16px;
        }

        #header {
            background-color: #ffffff;
            width: 100%;
            height: 100px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            text-align: center;
            position: fixed;
            max-width: 1560px;
            border: none;
            z-index: 1000;
            padding: 0 10px;
        }

        #header img {
            height: 100px;
            width: auto;
            max-width: 100%;
            order: 2;
        }

        .menu-items li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .menu-items li:hover {
            background: #444;
        }

        #giohang {
            padding: 15px;
            order: 3;
            max-width: 500px;
            display: flex;
            border: 1px solid black;
            height: 70px;


        }

        .total-price {
            color: red;
        }

        #giohang img {
            width: 60px;
            height: 60px;
        }

        .menu-btn {
            position: fixed;
            top: 25px;
            left: 80px;
            background: #0e0b0b;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 100;
            order: 1;
        }

        .menu {
            position: fixed;
            left: -60px;
            top: 0;
            width: 250px;
            height: 100%;
            background: #333;
            transition: 0.3s;
        }

        .menu.active {
            left: 0;
        }

        .menu-items {
            padding: 90px 0 0 0;
            margin: 0;
            list-style: none;
        }

        .menu-items li {
            padding: 15px 30px;
            border-bottom: 1px solid #444;

        }

        #footer {
            background-color: black;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            width: 100%;
            max-width: 1600px;
            box-sizing: border-box;
            margin: auto;
            padding-left: 150px;
        }

        .footer-section {
            flex: 1;
            padding: 10px;
            text-align: center;
        }

        .footer-section a:hover {
            color: #dd9933;
        }

        #footer img {
            width: 200px;
            display: block;
            margin: 0 auto;
        }

        #footer .footer-section p:focus,
        #footer .footer-section a:focus {
            outline: none;
            box-shadow: 0 0 4px rgba(221, 153, 51, 0.3);
            transition: box-shadow 0.3s ease;
        }

        #footer .footer-section p,
        #footer .footer-section a {
            color: white;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.3s ease;
            margin-bottom: 0.2rem;
            line-height: 1.1;
            display: block;
        }

        #footer .footer-section h3 {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 0.2rem;
            color: white;
        }

        #footer .footer-section p:hover,
        #footer .footer-section a:hover {
            color: #dd9933;
        }

        .add-to-cart-btn {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            margin-left: 10px;
            font-size: 14px;
            padding-left: 5px;
            width: 120px;
            height: 40px;
        }

        .add-to-cart-btn:hover {
            background-color: #218838;
        }

        .product-price {
            display: flex;
        }

        .reset-btn,
        .view-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 8px;
            height: 30px;
            margin-left: 10px;
            align-items: center;
        }

        .btnn {
            display: flex;
            flex-direction: column;

            justify-content: space-between;

            align-items: center;
        }

        .menu-items li:hover .sub-menu {
            display: block;
            visibility: visible;
            opacity: 1;
        }

        .sub-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            list-style: none;
            padding: 0;
            margin: 0;
            z-index: 1000;
            top: 138px;
            /* Điều chỉnh vị trí trên cùng của sub-menu */
            left: 100%;
            /* Hiển thị sub-menu bên phải của menu chính */
            background-color: #333;
            width: 250px;
            visibility: hidden;
            /* Thêm thuộc tính này */
            opacity: 0;

        }

        .sub-menu li a {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            display: block;
            white-space: nowrap;
            height: 100%;
        }

        .sub-menu li a:hover {
            background-color: #444;
        }

        .btdong {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            margin-top: 10px;
            margin-left: 200px;
        }

        .hinhgiohang {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body style="background-color: #f5f5f5; margin: 0; padding: 0;">
    <div id="header">
        <button class="menu-btn" onclick="toggleMenu()">☰ Menu</button>

        <div class="menu" id="menu">
            <ul class="menu-items">
                <li><a href="index.php">Trang chủ</a></li>
                <li>
                    <a href="#">Sản phẩm</a>
                    <ul class="sub-menu">
                        <li><a href="productcf.php">Cà Phê</a></li>
                        <li><a href="product2.php">Dụng cụ pha Cà Phê</a></li>
                    </ul>
                </li>
                <li><a href="news.php">Tin tức</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                <li><a href="introduct.php">Giới thiệu</a></li>
            </ul>
        </div>


        <div class="overlay" onclick="toggleMenu()"></div>

        <script>
            function toggleMenu() {
                document.getElementById('menu').classList.toggle('active');
                document.querySelector('.overlay').classList.toggle('active');
            }
        </script>
        <div><img src="imgs/Kalitalogo.png" alt="Kalita Café Logo"></div>
        <div class="giohang" id="giohang">
            <div><img src="imgs/giohang.png" alt=""></div>
            <div class="cart-info">
                Số lượng: <span class="cart-quantity"> 0</span>
                <br><span class="total-price">0 VND</span>
            </div>
            <div class="btnn">
                <button id="reset-cart" class="reset-btn">Reset Giỏ Hàng</button>
                <button id="view-cart" class="view-btn">Xem Sản Phẩm</button>
            </div>
        </div>
    </div>
    <div class="product-grid">
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
    </div>
    <?php $db->close(); ?>
    <footer id="footer">
        <div class="footer-section">
            <img src="imgs/logofooter.png" alt="Logo">
        </div>
        <div class="footer-section">
            <h3>TẬP ĐOÀN KALITA COFFE</h3>
            <p>82-84 Bùi Thị Xuân, P. Bến Thành, Q.1, Tp Hồ Chí Minh</p>
            <p>Hotline: 1900 6011</p>
            <p>Tel: (84.28) 39251852</p>
            <p>Fax: (84.28) 39251848</p>
        </div>
        <div class="footer-section">
            <h3>© 2018 TẬP ĐOÀN KALITA COFFE</h3>
            <p>LIÊN KẾT NHANH</p>
            <p>- TRUYỀN THÔNG</p>
            <p>- CƠ HỘI NGHỀ NGHIỆP</p>
            <p>- CHÍNH SÁCH BẢO MẬT</p>
            <p>- THÔNG TIN LIÊN HỆ</p>
        </div>
        <div class="footer-section">
            <h3>SOCIAL MEDIA</h3>
            <p>Facebook</p>
            <p>Instagram</p>
            <p>Youtube</p>
            <p>Tiktok</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartQuantity = document.querySelector('.cart-quantity');
            const totalPrice = document.querySelector('.total-price');
            const viewCartBtn = document.getElementById('view-cart');
            const resetBtn = document.getElementById('reset-cart');
            let cartCount = 0;
            let cartTotal = 0;
            let cartItems = [];


            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productElement = this.closest('.product-info');
                    const name = productElement.querySelector('.product-name').innerText;
                    const priceText = productElement.querySelector('.product-price').innerText;
                    const price = parseFloat(priceText.replace(/[^\d]/g, ''));
                    const imgSrc = this.closest('.product-card').querySelector('.product-image img').src;

                    if (!isNaN(price)) {
                        cartCount += 1;
                        cartTotal += price;


                        cartItems.push({
                            name,
                            price,
                            imgSrc
                        });


                        cartQuantity.innerText = cartCount;
                        totalPrice.innerText = cartTotal.toLocaleString('vi-VN') + ' VND';
                    }
                });
            });


            resetBtn.addEventListener('click', function() {
                cartCount = 0;
                cartTotal = 0;
                cartItems = [];
                cartQuantity.innerText = cartCount;
                totalPrice.innerText = cartTotal.toLocaleString('vi-VN') + ' VND';
            });


            viewCartBtn.addEventListener('click', function() {
                if (cartItems.length === 0) {
                    alert("Giỏ hàng của bạn hiện tại không có sản phẩm.");
                    return;
                }

                let cartContent = "<h2>Sản phẩm trong giỏ hàng</h2><ul class='cart-items'>";
                cartItems.forEach(item => {
                    cartContent += `<li>
                                <img class="hinhgiohang" src="${item.imgSrc}" alt="${item.name}" style="width: 50px; height: 50px;">
                                ${item.name} - ${item.price.toLocaleString('vi-VN')} VND
                            </li>`;
                });
                cartContent += "</ul>";


                const modal = document.createElement('div');
                modal.style.position = 'fixed';
                modal.style.top = '30%';
                modal.style.left = '70%';
                modal.style.transform = 'translate(-50%, -50%)';
                modal.style.backgroundColor = '#fff';
                modal.style.padding = '20px';
                modal.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.2)';
                modal.style.zIndex = '1000';
                modal.innerHTML = cartContent + '<button class="btdong" onclick="this.parentElement.remove()">Đóng</button>';


                document.body.appendChild(modal);
            });
        });
    </script>
</body>

</html>