<?php
//lay du lieu id can xoa
$malhp = $_GET['smaLHP'];

//ket noi
require_once 'config.php';
//cau lenh sql 
$xoa_sql = "DELETE FROM lophocphan WHERE maLHP like '$malhp'";
//echo $xoa_sql;
mysqli_query($conn, $xoa_sql);
// echo "<h1>Xoa thanh cong</h1>";
//tro ve trang liet ke
header("Location: admin_l.php");
mysqli_close($conn);
?>