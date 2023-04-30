<?php
//lay du lieu id can xoa
$magv = $_GET['smaGV'];

//ket noi
require_once 'config.php';
//cau lenh sql 
$xoa_sql = "DELETE FROM giaovien WHERE maGV like '$magv'";
$xoa_tk = "DELETE FROM user_form WHERE email like '$magv'";

mysqli_multi_query($conn, $xoa_sql.";".$xoa_tk);
// echo "<h1>Xoa thanh cong</h1>";
//tro ve trang liet ke
header("Location: admin_c+.php");
mysqli_close($conn);
?>