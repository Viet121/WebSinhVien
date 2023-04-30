<?php
//lay du lieu id can xoa
$mamh = $_GET['smaMH'];

//ket noi
require_once 'config.php';
//cau lenh sql 
$xoa_sql = "DELETE FROM monhoc WHERE maMH like '$mamh'";

mysqli_query($conn, $xoa_sql);
// echo "<h1>Xoa thanh cong</h1>";
//tro ve trang liet ke
header("Location: admin_c-.php");
mysqli_close($conn);
?>