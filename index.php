<?php
include("admincp/config/config.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalita Cafe</title>
    <link rel="stylesheet" type="text/css" href="css/styleindex.css" />
</head>

<body>
    <div id="header">
        <a href="login.php"><button class="admin-login-btn">Đăng Nhập</button></a>
        <button class="menu-btn" onclick="toggleMenu()">☰ Menu</button>

        <div class="menu" id="menu">
            <ul class="menu-items">
                <li><a href="index.php">Trang chủ</a></li>
                <li>
                    <a href="produccf.php">Sản phẩm</a>
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
        <img id="logo" src="imgs/Kalitalogo.png" alt="Kalita Café Logo">
    </div>
    <div id="wrapper">
        <div id="gt">
            <img src="imgs/tbg.png" alt="Background Image">
            <div id="ls">
                <img src="imgs/ls.png">
                <br>
                <h3>HỆ SẢN PHẨM LỐI SỐNG TỈNH THỨC</h3></br>
                <br>
                <h4 class="text">Như chúng ta đang chứng kiến: dịch bệnh, thiên tai, chiến tranh, nghèo đói, … đang xảy ra liên tục
                    không loại trừ bất kỳ một cá nhân nào; không một tổ chức, tập đoàn, doanh nghiệp… nào không bị ảnh hưởng;
                    không phân biệt một quốc gia hay cường quốc nào thì hơn lúc nào hết, đây là thời điểm mà mỗi cá nhân, mỗi gia
                    đình, mỗi tổ chức, mỗi quốc gia – dân tộc… và toàn thể nhân loại buộc phải tìm kiếm hoặc thay đổi lối sống theo
                    hướng tìm về sự cân bằng hài hoà với Vũ Trụ, của Tự Nhiên, của Xã Hội Loài Người.</h4>
                <br>
                <h4 class="text">Nhận thức được tầm quan trọng của điều đó, trong suốt quá trình xây dựng và phát triển của Tập đoàn Trung
                    Nguyên Legend từ năm 1996 đến nay, bên cạnh việc không ngừng nghiên cứu và cung ứng đến cộng đồng người tiêu dùng
                    toàn cầu những ly cà phê năng lượng tuyệt hảo mà Trung Nguyên Legend còn luôn trăn trở, khát vọng kiến tạo một lối sống mới bền vững hơn,
                    hài hòa hơn. Và sau quá trình nghiên cứu, tìm tòi cách thức phát triển của lịch sử các nền văn minh, các đế chế vĩ đại nhất từ khi thành lập đến
                    phát triển cực thịnh rồi suy tàn; những tấm gương vĩ nhân thành công nhất trong lịch sử của nhân loại để tìm ra có mẫu số chung và công thức thành
                    công nào của từng đề chế, từng vĩ nhân… Tập đoàn Trung Nguyên Legend nhận ra rằng, con đường để mỗi cá nhân, mỗi quốc gia – dân tộc đạt tới sự giàu có đó chính
                    là trải nghiệm, học hỏi, áp dụng và thực hành một lối sống mới – Lối Sống Tỉnh Thức.</h4>
            </div>
            <div class="sp"><a>BỘ SẢN PHẨM 3 NỀN VĂN MINH CÀ PHÊ</a></div>
            <div class="container">
                <div class="product">
                    <img src="imgs/ottoman.jpg" alt="Ottoman Coffee">
                    <h3>Văn Minh Cà Phê Ottoman</h3>
                    <p>Với cách pha cà phê truyền thống của người Ottoman với tình hoa là chiếc bình Ibrik, mang đến những tách cà phê nóng lượng hương vị độc đáo, kèm lớp crema dày, béo và mịn đặc trưng.</p>
                    <a href="#">Tìm hiểu thêm ></a>
                </div>
                <div class="product">
                    <img src="imgs/roman.jpg" alt="Roman Coffee">
                    <h3>Văn Minh Cà Phê Roman</h3>
                    <p>Với cách pha chế cà phê Espresso bằng chiếc bình Moka, mang đến tách cà phê nóng lượng tuyệt hảo với thể chất đậm, trọn vị cùng đầy khói nhẹ, đặc trưng, xen lẫn chút hương vị tràng cay tươi.</p>
                    <a href="#">Tìm hiểu thêm ></a>
                </div>
                <div class="product">
                    <img src="imgs/thien.jpg" alt="Thien Coffee">
                    <h3>Văn Minh Cà Phê Thiền</h3>
                    <p>Với phương pháp pha cà phê phin truyền thống Việt Nam cùng với bộ công cụ là chiếc bếp lửa cám hừng từ chiếc trồng dồng Sơn và chiếc âm pha trà của người Việt cổ, mang đến tách cà phê Thiên đọc nhất với hương vị thanh tao như những bắt cứ hương vị nào của gian, như những vẻ vừa đá, hoa quyên và làm thức tình riêng giác quan.</p>
                    <a href="#">Tìm hiểu thêm ></a>
                </div>
            </div>
            <div class="sp"><a>BỘ SẢN PHẨM THIỀN CÀ PHÊ</a></div>
            <div class="containerr">

                <div class="product1"><img src="imgs/hemingway.jpg" />
                    <h3>The Spririt of Philosophy (Hemingway)</h3>
                    <a>Lấy cảm hứng từ tinh thần dám dấn thân vì đam mê để
                        vượt qua nghịch cảnh cuộc đời và để lại kho tàng tuyệt tác
                        văn chương mang đậm triết lý cho nhân loại của nhà văn Ernest
                        Hemingway; bộ sản phẩm Tinh thần Triết gia – The Spririt of Philosophy
                        mong muốn đem đến cho người trải nghiệm nguồn năng lượng của tinh thần dấn
                        thân để thách thức mọi nghịch cảnh – chinh phục khát vọng cuộc đời.</a>
                    <p><a class="link" href="spirit.php">Tìm Hiểu Thêm ></a>
                </div>

                <div class="product1"> <img src="imgs/creativy.jpg" />
                    <h3>The Spirit of Creativity
                        <p>(The Creation of Adam)
                    </h3>
                    <a>Lấy cảm hứng từ bức họa nổi tiếng “Chúa trời tạo ra Adam” của Michelangelo
                        – Bộ Sản phẩm The Spirit of Creativity - The Creation of Adam mong muốn đem đến cho người trải
                        nghiệm nguồn năng lượng của sự sáng tạo để xây dựng nên những trang sử vĩ đại cho cuộc đời mình.</a>
                    <p><a class="link" href="creativity.php">Tìm Hiểu Thêm ></a>
                </div>
                <div class="product1"><img src="imgs/philosophy.jpg" />
                    <h3>The Spirit of Philosophy
                        <p>(Vitruvian man)
                    </h3>
                    <a>Lấy cảm hứng từ bức họa “Người Vitruvian” của Leonardo da Vinci, bức họa đã góp một phần quan trọng trong y
                        học, giải phẫu học ngày nay. Bộ Sản phẩm The Spirit of Philosophy - Vitruvian man mong muốn đem đến cho người
                        trải nghiệm nguồn năng lượng của tinh thần triết gia để hình thành lý tưởng sốn
                        g phù hợp, hoặc tự giải thích được tất cả những sự việc quanh đời sống bằng quan điểm, lý lẽ thuyết phục.</a>
                    <p><a class="link" href="philosophy.php">Tìm Hiểu Thêm ></a>
                </div>
                <div class="product1"><img src="imgs/chienbinhtam.jpg" />
                    <h3>The Spirit of Warrior
                        <p>(Chiến Binh Tâm)
                    </h3>
                    <a>Lấy cảm hứng từ tinh thần chiến binh của Nhà khai sáng trên lưng ngựa Napoleon,
                        bộ sản phẩm Chiến Binh Tâm mong muốn khơi dậy ở mọi người đặc biệt là giới trẻ
                        tinh thần chiến binh (phẩm chất cao quý, kỹ năng, đạo đức, khí chất… ) & khát vọng
                        để thành công trong mọi lĩnh vực của cuộc sống.</a>
                    <p><a class="link" href="chienbinhtam.php">Tìm Hiểu Thêm ></a>
                </div>
            </div>
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
            <p> Facebook</p>
            <p>Instagram</p>
            <p>Youtube</p>
            <p>Tiktok</p>
        </div>
    </footer>
</body>

</html>