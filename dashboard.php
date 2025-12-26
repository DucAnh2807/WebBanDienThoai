<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Admin</title>
  <style>
    body {
      font-family: 'Times New Roman';
      background-color: #f9f9f9;

    }

    h1 {
      text-align: center;
      color: #2c3e50;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      /* padding: 4px; */
      border: 1px solid #ddd;
    }

    th {
      background-color: rgb(74, 167, 225);
      color: black;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .description {
      width: 400px;
    }

    img {
      width: 120px;
      height: 80px;
    }

    .delete,
    .update {
      text-decoration: none;
      color: black;
      font-weight: bolder;
      padding: 8px;
      font-family: 'Times New Roman';
    }

    .add {
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid black;
      width: 150px;
      background-color: rgb(74, 167, 225);
    }

    .add a {
      text-decoration: none;
      color: black;
    }

    .add:hover {
      cursor: pointer;
      background-color: skyblue;
    }

    .delete:hover {
      border-radius: 10px;
      color: white;
      background-color: black;
    }

    .update:hover {
      color: white;
      border-radius: 10px;
      background-color: black;
    }

    .btn-add {
      text-align: center;
      display: flex;
      justify-content: space-evenly;
    }
  </style>
</head>

<body>
  <h1>Màn hình chính của Admin</h1>
  <div class="btn-add">
    <div class="add"><a href="../admin/add.php"> Thêm sản phẩm mới</a></div>
    <div class="add"><a href="../admin/order_manage.php"> Quản lí đặt hàng</a></div>
    <div class="add"><a href="../index.php"> Trang chủ</a></div>
  </div>
  <table border="1">

    <head>
      <tr>
        <th>ID</th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Mô tả</th>
        <th>Hãng sản phẩm</th>
        <th>Hệ điều hành</th>
        <th>Giá tiền</th>
        <th>Ảnh</th>
        <th>Chức năng</th>
      </tr>
      <?php
      include('../connect.php');
      $sql = "SELECT sp.* , hdh.loai_he_dieu_hanh
              FROM san_pham sp
              JOIN he_dieu_hanh hdh ON sp.loai_he_dieu_hanh_id = hdh.id";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <tr style="text-align: center;">
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['ma_san_pham']; ?></td>
          <td><?php echo $row['ten_san_pham']; ?></td>
          <td class="description"><?php echo $row['mo_ta']; ?></td>
          <td><?php echo $row['hang']; ?></td>
          <td><?php echo $row['loai_he_dieu_hanh']; ?></td>
          <td><?php echo ($row['gia_tien']); ?> VNĐ</td>
          <td>
            <?php if (!empty($row['image_url'])) { ?>
              <a href="phone_detail.php?id=<?= $row['id'] ?>">
                <img src="../<?= $row['image_url'] ?>" width="300px">
              </a>
            <?php } ?>
          </td>
          <td>
            <a class="delete" href="delete.php?id=<?php echo $row['id']; ?>">Xóa</a>
            <a class="update" href="update.php?id=<?php echo $row['id']; ?>">Cập nhật</a>
          </td>
        </tr>

      <?php
      }
      ?>
    </head>

  </table>

</body>

</html>