<?php
session_start();
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ điện thoại</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <div class="header">
        <nav>
            <b style="text-decoration: none; margin: 8px">
                <li style="font-size: 20px;">SMARTPHONE</li>
            </b>
            <a href="index.php">
                <li>Trang Chủ</li>
            </a>
            <a href="#introduce">
                <li>Giới thiệu</li>
            </a>
            <a href="#service">
                <li>Dịch vụ </li>
            </a>
            <a href="#contact">
                <li>Liên hệ</li>
            </a>
        </nav>
        <div class="btn">
            <div class="cuoi">
                <button onclick="doiCheDo()">Đổi chế độ</button>
            </div>
            <script>
                let chedo = true;

                function doiCheDo() {
                    if (chedo == true) {
                        document.getElementsByTagName("body")[0].style =
                            "background-color: gray";
                        chedo = false;
                    } else {
                        document.getElementsByTagName("body")[0].style =
                            "background-color: white";
                        chedo = true;
                    }
                }
            </script>
            <?php
            if (isset($_SESSION['ten_dang_nhap'])) : ?>
                Xin chào <b><?php echo $_SESSION['ten_dang_nhap']; ?></b>
                <a href="order_history.php">Lịch sử đặt hàng</a>
                <a href="./manager/logout.php">Đăng xuất</a>
            <?php else: ?>
                <a href="./manager/login.php">Đăng nhập</a>
                <a href="./manager/register.php">Đăng kí</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="banner">
        <img src="img/banner-ip14.jpg" alt="">
    </div>
    <?php
    $sql = "SELECT * FROM he_dieu_hanh";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $typesId = $row['id'];

        $sql2 = "SELECT * FROM san_pham 
             WHERE loai_he_dieu_hanh_id = $typesId 
             ORDER BY id DESC 
             LIMIT 5";
        $result2 = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($result2) == 0) {
            continue;
        }
    ?>
        <div class="type">
            <div class="tentype">
                <h1> hệ điều hành <?= $row['loai_he_dieu_hanh'] ?></h1>
            </div>

            <div class="list">
                <?php while ($products = mysqli_fetch_assoc($result2)) { ?>
                    <div class="product">

                        <a href="phone_detail.php?id=<?= $products['id'] ?>">
                            <div class="anh">
                                <img src="<?= $products['image_url'] ?>" alt="">
                            </div>
                            <h3><?= $products['ten_san_pham'] ?></h3>
                        </a>

                        <p class="foreign-product-price">
                            Giá tiền: <?= number_format($products['gia_tien'], 0, ',', '.') ?>đ
                        </p>

                        <p class="foreign-product-destination">
                            Hãng: <?= $products['hang'] ?>
                        </p>

                        <a class="btn-dat" href="order_phone.php?id=<?= $products['id'] ?>">
                            ĐẶT NGAY
                        </a>

                    </div>

                <?php } ?>
            </div>
        </div>
    <?php
    }
    ?>
    <footer>
        <div style="text-align:center;font-size:36px;"><b>VỀ SMARTPHONE</b></div>
        <div class="footer4" id="contact" style="display:flex; color: rgb(18, 19, 20);">

            <div style="text-align:center;width:23%;margin:20px;">
                <div style="margin: 15px;">
                    <h2>Tổng đài hỗ trợ miễn phí</h2>
                </div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Mua hàng - bảo hành 1800.2097
                        (7h30 -
                        22h00)</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Khiếu nại 1800.2063 (8h00 -
                        21h30)</a></div>

            </div>
            <div style="text-align:center;width:23%;margin:20px;">
                <div style="margin: 15px;">
                    <h2>Thông tin về chính sách</h2>
                </div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Mua hàng và thanh toán Online</a>
                </div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Mua hàng trả góp Online</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Mua hàng trả góp bằng thẻ tín
                        dụng</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Chính sách giao hàng</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Chính sách đổi trả</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Tra điểm Smember</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Xem ưu đãi Smember</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Tra thông tin bảo hành</a></div>
            </div>
            <div style="text-align:center;width:23%;margin:20px;">
                <div style="margin: 15px;">
                    <h2>Dịch vụ và thông tin khác</h2>
                </div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Khách hàng doanh nghiệp (B2B)</a>
                </div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Ưu đãi thanh toán</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Quy chế hoạt động</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Chính sách bảo mật thông tin cá
                        nhân</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Chính sách Bảo hành</a></div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Liên hệ hợp tác kinh doanh</a>
                </div>
                <div style="margin: 15px;"><a style="color: rgb(18, 19, 20);" href="">Tuyển dụng</a></div>
            </div>
            <div style="text-align:center;width:23%;margin:20px;">
                <div style="margin: 15px;">
                    <h2>Kết nối với SMARTPHONE</h2>
                </div>
                <div style="display:flex;margin-left:75px;">
                    <div style="margin: 15px;"><i class="fa-brands fa-facebook"></i></div>
                    <div style="margin: 15px;"><i class="fa-brands fa-youtube"></i></div>
                    <div style="margin: 15px;"><i class="fa-brands fa-tiktok"></i></div>
                    <div style="margin: 15px;"><i class="fa-brands fa-instagram"></i></div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>