<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="css/styleindex.css" />
  <link rel="stylesheet" href="css/contact.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
        <li><a href="news.php">Tin Tức</a></li>
        <li><a href="contact.php">Liên hệ</a></li>
        <li><a href="introduct.php">Giới thiệu</a></li>
      </ul>
    </div>

    <div class="overlay" onclick="toggleMenu()"></div>

    <img src="imgs/Kalitalogo.png" alt="" />
  </div>

  <div class="content">
    <div class="iframe-container">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.9751342719505!2d106.33242139291085!3d10.423547759492648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310abb77abfeb299%3A0x3047216743107681!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUaeG7gW4gR2lhbmcgY8ahIHPhu58gMg!5e0!3m2!1svi!2s!4v1733493957352!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="contact-form-container">
      <div class="contact-info">
        <ul>
          <li>
            <i class="fas fa-map-marked-alt"></i>Đại học Tiền Giang, Cơ sở 2
          </li>
          <li>
            <a href="tel:0582718134" class="contact__link">
              <i class="fas fa-phone"></i> 058 271 8134
            </a>
          </li>
          <li>
            <a href="mailto:Vinh022101102@tgu.edu.vn" class="contact__link">
              <i class="fas fa-envelope"></i> Vinh022101102@tgu.edu.vn
            </a>
          </li>
        </ul>
      </div>

      <div class="contact-form" style="text-align: center;">
        <div class="contact-form-title">Liên hệ với chúng tôi</div>
        <div class="form-group" style="text-align: center;">
          <input type="text" placeholder="Họ và tên" />
          <input type="email" placeholder="Email" />
          <input type="text" placeholder="Địa chỉ" />
          <input type="tel" placeholder="Số điện thoại" />
        </div>
        <textarea placeholder="Lời nhắn"></textarea>
        <button type="submit" class="btn btn--default">Gửi</button>
      </div>
    </div>
  </div>

  <footer id="footer">
    <div class="footer-section">
      <img src="imgs/logofooter.png" alt="Logo" />
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
      <p>- TRUYỀN THÔNG</p>
      <p>- CƠ HỘI NGHỀ NGHIỆP</p>
      <p>- CHÍNH SÁCH BẢO MẬT</p>
      <p>- THÔNG TIN LIÊN HỆ</p>
    </div>
    <div class="footer-section">
      <h3>SOCIAL MEDIA</h3>
      <p>- Facebook</p>
      <p>- Instagram</p>
      <p>- Youtube</p>
      <p>- Tiktok</p>
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