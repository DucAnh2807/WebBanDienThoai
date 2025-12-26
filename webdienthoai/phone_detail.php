<?php
include('connect.php');
session_start();

if (isset($_GET['id'])) {
    $productsId = $_GET['id'];
    $sql = "SELECT sp.* , hdh.loai_he_dieu_hanh
    FROM san_pham sp
    JOIN he_dieu_hanh hdh ON sp.loai_he_dieu_hanh_id = hdh.id WHERE sp.id = $productsId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $phone = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy phone!";
    }
} else {
    echo "Thiếu ID phone!";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết điện thoại - <?= $phone['ten_san_pham'] ?></title>
    <link rel="stylesheet" href="">
    <style>
        .phone-detail{
           
            width: 40%;
            margin: 15px auto;
            border:1px solid black;
            border-radius:8px;
        }
        .phone-title{
            text-align:center;
        }
        .phone-info{
           text-align:center; 
        }
        .phone-image{
           text-align:center; 
        }
        a{
            text-decoration:none;
        
        }
        button{
            padding:15px;
            background-color:aqua;
            border-radius:5px;
        }
        img{
            height:300px;
            width: 80%;
        }
    </style>
    
</head>

<body>
    <div class="phone-detail">
        <h2 class="phone-title"><?= $phone['ten_san_pham'] ?></h2>
        <div class="phone-content">
            <div class="phone-image">
                <img src="<?= $phone['image_url'] ?>" alt="<?= $phone['ten_san_pham'] ?>">
            </div>
            <div class="phone-info">
                <p><b>Mã sản phẩm:</b> <?= $phone['ma_san_pham'] ?></p>
                <p><b>Hãng:</b> <?= $phone['hang'] ?></p>
                <p><b>Hệ điều hành:</b> <?= $phone['loai_he_dieu_hanh'] ?></p>
                <p><b>Giá:</b>
                    <span class="price"><?= number_format($phone['gia_tien'], 0, ',', '.') ?> VND</span>
                </p>
                <p><b>Mô tả:</b></p>
                <p class="description"><?= $phone['mo_ta'] ?></p>

               <button><a href="order_phone.php?id=<?= $phone['id'] ?>" class="btn">Đặt ngay</a></button>
            </div>
        </div>
    </div>
</body>

</html>