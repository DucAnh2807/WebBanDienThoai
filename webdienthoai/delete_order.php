<?php
include('connect.php');
$id = $_GET['id'];

$delete_sql = "DELETE FROM `dat_hang` WHERE id=$id ";
mysqli_query($conn, $delete_sql);

echo "<script> 
        window.location.href ='order_history.php'
    </script>";
