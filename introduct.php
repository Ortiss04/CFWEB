<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Giới Thiệu - Kalita Coffee</title>
  <meta name="description" content="Giới thiệu về Kalita Coffee - cửa hàng cà phê trực tuyến với sản phẩm chất lượng từ Đà Lạt, Buôn Ma Thuột.">
  <meta name="keywords" content="cà phê, Kalita Coffee, cà phê Việt Nam, giới thiệu">
  <link rel="stylesheet" href="css/styleindex.css" />
  <link rel="stylesheet" href="css/introduction.css" />
  <!-- Bootstrap CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
</head>

<body>
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
        <li><a href="news.php">Tin Tức</a></li>
        <li><a href="contact.php">Liên hệ</a></li>
        <li><a href="introduct.php">Giới thiệu</a></li>
      </ul>
    </div>

    <div class="overlay" onclick="toggleMenu()"></div>

    <img id="logo" src="imgs/Kalitalogo.png" alt="" />
  </div>

  <div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="main__breadcrumb" aria-label="Điều hướng">
      <div class="breadcrumb__item">
        <a href="index.php" class="breadcrumb__link">Trang chủ</a>
      </div>
      <div class="breadcrumb__item">
        <a href="introduct.php" class="breadcrumb__link">Giới thiệu</a>
      </div>
    </div>

    <!-- Video -->
    <div class="video-container">
      <iframe src="https://www.youtube.com/embed/6kS0v_SSeMM?si=NqTjjyKR5_bOTNH2" title="Giới thiệu Kalita Coffee" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <!-- Who We Are -->
    <div class="intro-section">
      <img src="imgs/Kalitalogo.png" alt="Kalita Coffee Icon" />
      <h1 class="intro-h1">CHÚNG TÔI LÀ AI?</h1>
      <p class="intro-p">Kalita Coffee được xây dựng từ niềm đam mê mãnh liệt dành cho cà phê và mong muốn mang đến trải nghiệm thưởng thức cà phê chất lượng nhất. Chúng tôi tự hào cung cấp:</p>
      <ul>
        <li>Hạt cà phê tuyển chọn từ Đà Lạt, Buôn Ma Thuột, Sơn La.</li>
        <li>Quy trình rang xay khắt khe, giữ trọn hương vị thuần khiết.</li>
        <li>Sản phẩm đa dạng cho mọi phong cách pha chế: phin, espresso, pour-over, cold brew.</li>
      </ul>
      <p class="intro-p">Chúng tôi không chỉ bán cà phê, mà còn lan tỏa văn hóa cà phê Việt đến mọi khách hàng.</p>
    </div>

    <!-- Mission -->
    <div class="intro-section">
      <img src="imgs/Kalitalogo.png" alt="Kalita Coffee Icon" />
      <h1 class="intro-h1">SỨ MỆNH</h1>
      <p class="intro-p">Sứ mệnh của Kalita Coffee là mang đến trải nghiệm cà phê đích thực với các cam kết:</p>
      <ul>
        <li>Sản phẩm sạch, an toàn, nguồn gốc rõ ràng.</li>
        <li>Kết nối cộng đồng yêu cà phê qua những tách cà phê chất lượng.</li>
        <li>Tiện lợi, dễ dàng thưởng thức cà phê mọi lúc, mọi nơi.</li>
      </ul>
      <p class="intro-p">Chúng tôi không ngừng cải tiến để mỗi khoảnh khắc thưởng thức cà phê đều trọn vẹn và đáng nhớ.</p>
      <a href="productcf.php" class="btn-cta" aria-label="Khám phá sản phẩm cà phê">Khám phá sản phẩm</a>
    </div>
  </div>

  <footer id="footer">
    <div class="footer-section">
      <img src="imgs/logofooter.png" alt="Kalita Coffee Logo" />
    </div>
    <div class="footer-section">
      <h3>TẬP ĐOÀN KALITA COFFE</h3>
      <p>82-84 Bùi Thị Xuân, P. Bến Thành, Q.1, Tp Hồ Chí Minh</p>
      <p>Hotline: 1900 6011</p>
      <p>Tel: (84.28) 39251852</p>
      <p>Fax: (84.28) 39251848</p>
    </div>
    <div class="footer-section">
      <h3>© 2018 TẬP ĐOÀN KALITA COFFE.</h3>
      <p>LIÊN KẾT NHANH</p>
      <p>TRUYỀN THÔNG</p>
      <p>CƠ HỘI NGHỀ NGHIỆP</p>
      <p>CHÍNH SÁCH BẢO MẬT</p>
      <p>THÔNG TIN LIÊN HỆ</p>
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
    function toggleMenu() {
      document.getElementById("menu").classList.toggle("active");
      document.querySelector(".overlay").classList.toggle("active");
    }
  </script>
</body>

</html>