<?php
include('../connect.php');

$id = $_GET['id'];

$sql = "SELECT * FROM san_pham WHERE id= $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/update.css">

</head>

<body>
    <a style="text-decoration: none; color: black" href="dashboard.php">
        <h2>Quay lại trang bảng</h2>
    </a>
    <H1> Cập nhật sản phẩm</H1>
    <form action="update.php?id=<?php echo $id ?>" method="post">

        <p>Bạn đang sửa sản phẩm có id là: <?php echo $_GET['id'] ?></p>

        <div>
            <p>Mã sản phẩm</p>
            <input type="text" name="ma_san_pham" placeholder="Điền mã sản phẩm"
                value="<?php echo $row['ma_san_pham'] ?>" required>
        </div>
        <div>
            <p>Tên sản phẩm</p>
            <input type="text" name="ten_san_pham" placeholder="Điền tên sản phẩm"
                value="<?php echo $row['ten_san_pham'] ?>" required>
        </div>
        <div>
            <p>Mô tả</p>
            <input type="text" name="mo_ta" placeholder="Điền mô tả" value="<?php echo $row['mo_ta'] ?>" required>
        </div>
        <div>
            <p>Hãng sản phẩm</p>
            <input type="text" name="hang" placeholder="Điền hãng sản phẩm" value="<?php echo $row['hang'] ?>" required>
        </div>
        <div>
            <p>Hệ điều hành</p>
            <select name="loai_he_dieu_hanh">
                <option value="">--- Chọn loại hệ điều hành ---</option>
                <?php
                $sqlHDH = "SELECT * FROM he_dieu_hanh";
                $resultHDH = mysqli_query($conn, $sqlHDH);
                while ($rowHDH = mysqli_fetch_array($resultHDH)) {
                    echo "<option value='{$rowHDH['id']}'>{$rowHDH['loai_he_dieu_hanh']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <p>Giá tiền</p>
            <input type="number" name="gia_tien" placeholder="Điền giá tiền" value="<?php echo $row['gia_tien'] ?>"
                required>
        </div>


        <button type="submit"> Cập nhật</button>
    </form>
    <?php
    $id = $_GET['id'];

    if (
        !empty($_POST['ma_san_pham']) &&
        !empty($_POST['ten_san_pham']) &&
        !empty($_POST['mo_ta']) &&
        !empty($_POST['hang']) &&
        !empty($_POST['loai_he_dieu_hanh']) &&
        !empty($_POST['gia_tien'])

    ) {
        $ma_san_pham = $_POST['ma_san_pham'];
        $ten_san_pham = $_POST['ten_san_pham'];
        $mo_ta = $_POST['mo_ta'];
        $hang = $_POST['hang'];
        $loai_he_dieu_hanh = $_POST['loai_he_dieu_hanh'];
        $gia_tien = $_POST['gia_tien'];
        $sqlNew = "UPDATE `san_pham` 
                SET `ma_san_pham`='$ma_san_pham',`ten_san_pham`='$ten_san_pham',`mo_ta`='$mo_ta',`hang`='$hang',`loai_he_dieu_hanh_id`='$loai_he_dieu_hanh',`gia_tien`='$gia_tien' WHERE id='$id'";

        mysqli_query($conn, $sqlNew);
        header('location:dashboard.php');
    }
    ?>

</body>

</html>