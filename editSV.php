<?php

//lay du lieu maSV can chinh
$masv = $_GET['smaSV'];

//ket noi
require_once 'config.php';

//cau lenh de lay thong tin ve sinh vien co maSV = $masv
$edit_sql = "SELECT * FROM sinhvien WHERE maSV like '$masv'";

$result = mysqli_query($conn, $edit_sql);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
    //nhan du lieu tu form
    $masvc = $_POST['masvc'];
    $masv = $_POST['masv'];
    $ht = $_POST['hoten'];
    $date = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioiT'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    
        //viet lenh sql de cap nhat du lieu
        $update_sql = "UPDATE sinhvien SET maSV='$masv', tenSV='$ht', ngaySinh='$date', gioiTinh='$gioitinh', SDT='$sdt', diaChi='$diachi' WHERE maSV='$masvc'";
        $updateTK = "UPDATE user_form SET name='$ht', email='$masv'WHERE email='$masvc'";
        //echo $update_sql; exit;
        //thuc thi cau lenh them
        if (mysqli_multi_query($conn, $update_sql.";".$updateTK)){
            //in thong bao thanh cong
            //tro ve trang liet ke
            header("Location: admin_r-.php");
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit sinh vien</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <br>
        <h1 style="text-align: center;">Form chỉnh sửa thông tin sinh viên</h1>
        <form action="#" method="post">
            <input type="hidden" id="masvc" name="masvc" value="<?php echo $row['maSV']?>">
            <div class="form-group">
                <label for="masv">Mã sinh viên</label>
                <input type="text" name="masv" id="masv" class="form-control"  value="<?php echo $row['maSV']?>" readonly>
            </div>
            <div class="form-group">
                <label for="hoten">Họ tên sinh viên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" value="<?php echo $row['tenSV']?>">
            </div>
            <div class="form-group">
                <label for="ngaysinh">Ngày sinh</label>
                <input type="date" id="ngaysinh" class="form-control" name="ngaysinh" value="<?php echo $row['ngaySinh']?>">
            </div>
            <div class="form-group">
                <label for="gioiT">Giới tính</label>
                <input type="text" id="gioiT" name="gioiT" class="form-control"  value="<?php echo $row['gioiTinh']?>">
            </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" id="sdt" class="form-control" name="sdt" value="<?php echo $row['SDT']?>">
            </div>
            <div class="form-group">
                <label for="diachi">Địa chỉ</label>
                <input type="text" id="diachi" class="form-control" name="diachi" value="<?php echo $row['diaChi']?>">
            </div>
            <button name="submit" class="btn btn-primary">Cập nhật thông tin</button>
        </form>
    </div>
</body>

</html>
<?php 
    mysqli_close($conn);
?>