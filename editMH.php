<?php

//lay du lieu maSV can chinh
$mamh = $_GET['smaMH'];

//ket noi
require_once 'config.php';

//cau lenh de lay thong tin ve sinh vien co maSV = $masv
$edit_sql = "SELECT * FROM monhoc WHERE maMH like '$mamh'";

$result = mysqli_query($conn, $edit_sql);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
    //nhan du lieu tu form
    $mamhc = $_POST['mamhc'];
    $mamh = $_POST['mamh'];
    $ht = $_POST['hoten'];
    $sotin = $_POST['sotin'];
    //viet lenh sql de cap nhat du lieu
    $update_sql = "UPDATE monhoc SET maMH='$mamh', tenMH='$ht', soTinChiMH='$sotin' WHERE maMH='$mamhc'";
    //echo $update_sql; exit;
    //thuc thi cau lenh them
    if (mysqli_query($conn, $update_sql)){
        //in thong bao thanh cong
        //tro ve trang liet ke
    header("Location: admin_c-.php");
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
        <h1 style="text-align: center;">Form chỉnh sửa thông tin môn học</h1>
        <form action="#" method="post">
            <input type="hidden" id="mamhc" name="mamhc" value="<?php echo $row['maMH']?>">
            <div class="form-group">
                <label for="mamh">Mã môn học</label>
                <input type="text" name="mamh" id="maMH" class="form-control"  value="<?php echo $row['maMH']?>" readonly>
            </div>
            <div class="form-group">
                <label for="hoten">Tên môn học</label>
                <input type="text" id="hoten" class="form-control" name="hoten" value="<?php echo $row['tenMH']?>">
            </div>
            <div class="form-group">
                <label for="sotin">Số tín chỉ</label>
                <input type="text" id="sotin" class="form-control" name="sotin" value="<?php echo $row['soTinChiMH']?>">
            </div>
            <button name="submit" class="btn btn-primary">Cập nhật thông tin</button>
        </form>
    </div>
</body>

</html>
<?php 
    mysqli_close($conn);
?>