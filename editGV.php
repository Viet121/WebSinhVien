<?php

//lay du lieu maSV can chinh
$magv = $_GET['smaGV'];

//ket noi
require_once 'config.php';

//cau lenh de lay thong tin ve sinh vien co maSV = $masv
$edit_sql = "SELECT * FROM giaovien WHERE maGV like '$magv'";

$result = mysqli_query($conn, $edit_sql);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
    //nhan du lieu tu form
    $magvc = $_POST['magvc'];
    $magv = $_POST['magv'];
    $ht = $_POST['hoten'];
    $date = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioiT'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    
    //viet lenh sql de cap nhat du lieu
    $update_sql = "UPDATE giaovien SET maGV='$magv', tenGV='$ht', ngaySinh='$date', gioiTinh='$gioitinh', SDT='$sdt', diaChi='$diachi' WHERE maGV='$magvc'";
    $updateTK = "UPDATE user_form SET name='$ht', email='$magv'WHERE email='$magvc'";
    //echo $update_sql; exit;
    //thuc thi cau lenh them
    if (mysqli_multi_query($conn, $update_sql.";".$updateTK)){
        //in thong bao thanh cong
        //tro ve trang liet ke
    header("Location: admin_c+.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit giao vien</title>
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
        <h1 style="text-align: center;">Form chỉnh sửa thông tin giáo viên</h1>
        <form action="#" method="post">
            <input type="hidden" id="magvc" name="magvc" value="<?php echo $row['maGV']?>">
            <div class="form-group">
                <label for="magv">Mã giáo viên</label>
                <input type="text" name="magv" id="magv" class="form-control"  value="<?php echo $row['maGV']?>" readonly>
            </div>
            <div class="form-group">
                <label for="hoten">Họ tên giáo viên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" value="<?php echo $row['tenGV']?>">
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