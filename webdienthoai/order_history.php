<?php
include "connect.php";
session_start();

$nguoi_dung_id = $_SESSION['nguoi_dung_id'];

$sql = "SELECT sp.ten_san_pham, nd.ten_dang_nhap, dh.* 
                FROM dat_hang dh 
                JOIN san_pham sp ON dh.san_pham_id = sp.id
                JOIN nguoi_dung nd ON dh.nguoi_dung_id = nd.id 
                WHERE dh.nguoi_dung_id = $nguoi_dung_id 
                ORDER BY dh.ngay_dat_hang DESC";
//ASC | DESC

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đặt hàng</title>
    <style>
        .formOrder {
            /* background-color : aqua;
        width: 60%; */
            /* padding :10%; */
            /* margin : 15px auto; */
            /* border: 1px solid black; */
            height: 400px;
            border-radius: 20px;

        }

        table {
            width: 100%;
        }

        .back-button {
            text-align: center;
            text-decoration: none;
        }

        .back-button button {
            padding: 15px;
            background-color: pink;
        }

        a {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <div class="formOrder">
        <table border=1>
            <caption style="margin:20px;">
                <font size="20"><b> Lịch sử đặt hàng</b></font>
            </caption>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Người dùng</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Số lượng</th>
                <th>Ghi chú</th>
                <th>Ngày đặt hàng</th>
                <th>Chức năng</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['ten_san_pham']; ?></td>
                    <td><?php echo $row['ten_dang_nhap']; ?></td>
                    <td><?php echo $row['ten_khach_hang']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['so_dien_thoai']; ?></td>
                    <td><?php echo $row['so_luong']; ?> </td>
                    <td><?php echo $row['ghi_chu']; ?></td>
                    <td><?php echo $row['ngay_dat_hang']; ?></td>
                    <td><a class="delete" href="delete_order.php?id=<?= $row['id'] ?>">Huỷ Đơn</a></td>

                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="back-button">
        <button><a href="./index.php">Quay về trang chủ</a></button>
    </div>
</body>

</html>