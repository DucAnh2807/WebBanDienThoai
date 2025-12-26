<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/order_manager.css">
</head>

<body>
    <a style="text-decoration: none; color: black" href="dashboard.php">
        <h2>Quay lại trang bảng</h2>
    </a>
    <h1>Quản lí đặt hàng</h1>
    <table>

        <head>
            <tr>
                <th>Sản phẩm</th>
                <th>Người dùng</th>
                <th>Tên khách hàng</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Số lượng</th>
                <th>Ghi chú</th>
                <th>Ngày đặt hàng</th>
            </tr>
            <?php
            include('../connect.php');
            $sql = "SELECT sp.ten_san_pham, nd.ten_dang_nhap, dh.* 
                    FROM dat_hang dh 
                    JOIN san_pham sp ON dh.san_pham_id = sp.id
                    JOIN nguoi_dung nd ON dh.nguoi_dung_id = nd.id ";
            $result = mysqli_query($conn, $sql);
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
                </tr>
            <?php
            }
            ?>
        </head>

    </table>

</body>

</html>