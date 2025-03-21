<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalita Cafe</title>
    <link rel="stylesheet" type="text/css" href="css/stylesp.css"/>
</head>
<body>
<div id="header">
        <button class="menu-btn" onclick="toggleMenu()">☰ Menu</button>

            <div class="menu" id="menu">
                <ul class="menu-items">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a></li>
                    <ul class="sub-menu">
                        <li><a href="productcf.php">Cà Phê</a></li>
                        <li><a href="product2.php">Dụng cụ pha Cà Phê</a></li>
                    </ul>
                   
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
                Số lượng:  <span class="cart-quantity"> 0</span>
                    <br><span class="total-price">0 VND</span>
                </div>
                
            </div>
    </div>
    <div id="hienthi">
        <div id="anh">
          <img src="imgs/creativy.jpg"/>
        
        </div>
        <div id="mota">
            <?php
                include("admincp/config/config.php");
                $connect = new mysqLi($sever, $user, $pass, $database);
                if ($connect->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `productkitp` WHERE masp='T007'";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                
                    $product = $result->fetch_assoc();
                    
                    echo "<h1>{$product['tensp']}</h1>";
                    echo "<p>Mã sản phẩm: {$product['masp']}</p>";
                    echo "<h3>The Spirit Of Philosophy (Vitruvian)</h3>
                    <br> 01 Bộ sản phẩm bao gồm:";
                    echo "<ul>";
                    $package_contents = explode(".", $product['tp']);
                    foreach ($package_contents as $tp) 
                    { 
                        if (!empty(trim($tp))) 
                        { echo "<li>" . trim($tp) . ".</li>";
                        } 
                        }
                    echo "</ul>";
                    
                    echo "<p class='price'>Giá: " . number_format($product['gia'], 0, ',', '.') . " VND</p>";
                    echo"
                    <div class='nhapsl'>
                    <a> Chọn số lượng: </a>
                    <button class='btngiam'>-</button>
                    <input type='number' value='1' min='0' class='sl'>
                    <button class='btntang'>+</button>
                    </div>
                                        
                     ";
                    echo "<button class='them'>Thêm vào giỏ hàng</button>";
                } else {
                    echo "Không tìm thấy sản phẩm.";
                }


                $connect->close();

            ?>

    <script>
            const btnGiam = document.querySelector('.btngiam');
    const btnTang = document.querySelector('.btntang');
    const Sl = document.querySelector('.sl');
    const btnThem = document.querySelector('.them');
    const cartQuantity = document.querySelector('.cart-quantity');
    const totalPrice = document.querySelector('.total-price');

    const pricePerItem = 2484000;

    let currentQuantity = 1;

    
    btnGiam.addEventListener('click', () => {
        if (Sl.value > 0) {
            Sl.value = parseInt(Sl.value) - 1;
            currentQuantity = Sl.value;
        }
    });

   
    btnTang.addEventListener('click', () => {
        Sl.value = parseInt(Sl.value) + 1;
        currentQuantity = Sl.value;
    });

   
    btnThem.addEventListener('click', () => {
        const quantity = parseInt(Sl.value);
        const newTotal = quantity * pricePerItem;

        cartQuantity.textContent = quantity;  
        const formattedTotal = newTotal.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

    totalPrice.textContent = formattedTotal;
    });
    
</script>
        </div>
     </div>
     <footer id="footer"> 
        <div class="footer-section">
         <img src="imgs/logofooter.png" alt="Logo"> 
        </div> 
        <div class="footer-section">
             <h3>TẬP ĐOÀN KALITA COFFE</h3>
              <p>82-84 Bùi Thị Xuân, P. Bến Thành, Q.1, Tp Hồ Chí Minh</p>
               <p>Hotline: 1900 6011</p> 
               <p>Tel: (84.28) 39251852</p> 
               <p>Fax: (84.28) 39251848</p> </div> 
               <div class="footer-section"> 
                <h3>© 2018 TẬP ĐOÀN KALITA COFFE</h3>
                <p>LIÊN KẾT NHANH</p> <p>- TRUYỀN THÔNG</p> <p>- CƠ HỘI NGHỀ NGHIỆP</p> 
                <p>- CHÍNH SÁCH BẢO MẬT</p> <p>- THÔNG TIN LIÊN HỆ</p> </div>
                 <div class="footer-section">
                     <h3>SOCIAL MEDIA</h3>
                      <p> Facebook</p>
                       <p>Instagram</p> 
                       <p>Youtube</p>
                        <p>Tiktok</p> 
                    </div> 
        </footer>
</body>
</html>













