<?php
include('../connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background: #f3f4f6;
            padding: 30px;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        form {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 20px;
        }

        form p {
            margin: 0 0 6px 4px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="file"]:focus,
        select:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            width: 100%;
            background-color: rgb(74, 167, 225);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        select {
            appearance: none;
            background-color: #fff;
        }
    </style>

</head>

<body>
    <a style="text-decoration: none; color: black" href="dashboard.php">
        <h2>Quay lại trang bảng</h2>
    </a>
    <H1> Thêm sản phẩm mới</H1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <p>Mã sản phẩm</p>
            <input type="text" name="ma_san_pham" placeholder="Điền mã sản phẩm" required>
        </div>
        <div>
            <p>Tên sản phẩm</p>
            <input type="text" name="ten_san_pham" placeholder="Điền tên sản phẩm" required>
        </div>
        <div>
            <p>Mô tả</p>
            <input type="text" name="mo_ta" placeholder="Điền mô tả" required>
        </div>
        <div>
            <p>Hãng sản phẩm</p>
            <input type="text" name="hang" placeholder="Điền hãng sản phẩm" required>
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
            <input type="number" name="gia_tien" placeholder="Điền giá" required>
        </div>
        <div>
            <p>Ảnh</p>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <button type="submit"> Thêm sản phẩm</button>
    </form>
    <?php
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


        //Xử lý ảnh
        #Bắt đầu xử lý thêm ảnh
        // Xử lý ảnh
        $target_dir = "../img/";
        $file_name = basename($_FILES["fileToUpload"]["name"]);

        // đường dẫn upload
        $target_file = $target_dir . $file_name;

        // đường dẫn lưu DB
        $image_url = "img/" . $file_name;

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra xem file ảnh có hợp lệ không
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File không phải là ảnh.";
                $uploadOk = 0;
            }
        }

        // Kiểm tra nếu file đã tồn tại
        if (file_exists($target_file)) {
            echo "File này đã tồn tại trên hệ thống";
            $uploadOk = 2;
        }

        // Kiểm tra kích thước file
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            echo "File quá lớn";
            $uploadOk = 0;
        }

        // Cho phép các định dạng file ảnh nhất định
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Chỉ những file JPG, JPEG, PNG & GIF mới được chấp nhận.";
            $uploadOk = 0;
        }

        #Kết thúc xử lý ảnh
        if ($uploadOk == 0) {
            echo "File của bạn chưa được tải lên";
        } else {
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $sql = "INSERT INTO `san_pham`( `ma_san_pham`, `ten_san_pham`, `mo_ta`, `hang`, `loai_he_dieu_hanh_id`, `gia_tien`, `image_url`) 
        VALUES ('$ma_san_pham','$ten_san_pham','$mo_ta','$hang','$loai_he_dieu_hanh','$gia_tien','$image_url')";
            // echo $sql;
            mysqli_query($conn, $sql);
            // header('location: dashboard.php');
            // echo "<script> 
            //     window.location.href ='dashboard.php'
            // </script>";
        }
    }

    ?>

</body>

</html>