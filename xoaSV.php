<?php
//lay du lieu id can xoa
$masv = $_GET['smaSV'];

//ket noi
require_once 'config.php';
//cau lenh sql 
$xoa_sql = "DELETE FROM sinhvien WHERE maSV like '$masv'";
$xoa_tk = "DELETE FROM user_form WHERE email like '$masv'";

mysqli_multi_query($conn, $xoa_sql.";".$xoa_tk);
// echo "<h1>Xoa thanh cong</h1>";
//tro ve trang liet ke
session_start();

header("Location: admin_r-.php");
mysqli_close($conn);
?>