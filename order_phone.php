<?php
include('connect.php');
session_start();
if (!isset($_SESSION['ten_dang_nhap'])) {
    header("Location: manager/login.php");
}

$sql_orders = "SELECT * FROM dat_hang ";
$result_orders = mysqli_query($conn, $sql_orders);

$id_product = $_GET['id'];
$product = "SELECT * FROM san_pham WHERE id = $id_product";
$result = mysqli_query($conn, $product);
$row = mysqli_fetch_assoc($result);

$error = "";

if (
    isset($_POST['ten_khach_hang']) &&
    isset($_POST['email']) &&
    isset($_POST['so_dien_thoai']) &&
    isset($_POST['so_luong'])
) {
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email = $_POST['email'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $so_luong = $_POST['so_luong'];
    $ghi_chu = $_POST['ghi_chu'];
    $nguoi_dung_id = $_SESSION['nguoi_dung_id'];
    $ngay_dat_hang = date("Y-m-d H:i:s"); // ngày đặt là hôm nay
    $sql = "INSERT INTO dat_hang 
                (san_pham_id, nguoi_dung_id, ten_khach_hang, email, so_dien_thoai, so_luong, ghi_chu, ngay_dat_hang) 
                VALUES 
                ('$id_product', '$nguoi_dung_id', '$ten_khach_hang', '$email', '$so_dien_thoai', '$so_luong', '$ghi_chu', '$ngay_dat_hang')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                    window.location.href = 'index.php';
            </script>";
    } else {
        // $error = "Lỗi đặt hàng: " . mysqli_error($conn);
    }
} else {
    // $error = "Vui lòng nhập đầy đủ thông tin!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Điện thoại</title>

</head>

<body>
    <h2> Đặt điện thoại: <?php echo $row['ten_san_pham'] ?></h2>

    <!-- Thông báo lỗi -->
    <?php if (!empty($error)): ?>
        <p style="text-align:center; color: red; font-weight: bold;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div>
            <p>Tên khách hàng :</p>
            <input type="text" name="ten_khach_hang" placeholder="Tên khách của bạn" required>
        </div>
        <div>
            <p>Email :</p>
            <input type="email" name="email" placeholder="Email của bạn" required>
        </div>
        <div>
            <p>Số điện thoại :</p>
            <input type="number" name="so_dien_thoai" placeholder="Số điện thoại của bạn" required>
        </div>
        <div>
            <p>Số lượng sản phẩm :</p>
            <input type="number" name="so_luong" min=1>
        </div>
        <div>
            <p>Ghi chú:</p>
            <textarea name="ghi_chu" placeholder="Ghi chú (nếu có)"></textarea>
        </div>
        <div>
            <button type="submit">Xác nhận đặt hàng</button>
        </div>
    </form>
</body>

</html>