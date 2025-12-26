<?php
include('../connect.php');
$id = $_GET['id'];

$delete_sql = "DELETE FROM `san_pham` WHERE id=$id ";
mysqli_query($conn, $delete_sql);
// echo "<script> 
//             window.location.href ='dashboard.php'
//     </script>";
header('location:dashboard.php');
