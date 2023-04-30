<?php

@include 'config.php';

error_reporting(0);

if(isset($_POST['submit'])){
    $magv = mysqli_real_escape_string($conn, $_POST['magv']);
    $ht = mysqli_real_escape_string($conn, $_POST['hoten']);
    $date = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioiT'];
    $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);
    $diachi = mysqli_real_escape_string($conn, $_POST['diachi']);
    $namnhv = $_POST['namnhv'];
    $mactdt = $_POST['mactdt'];
    $pass = md5($_POST['magv']);

   $select = " SELECT * FROM giaovien WHERE maGV = '$magv' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Mã số giáo viên đã tồn tại!';

   }
   else{
      
     //viet lenh sql de them du lieu
     $themsql = "INSERT INTO giaovien (maGV, tenGV, ngaySinh, gioiTinh, SDT, diaChi) VALUES ('$magv', '$ht', '$date', '$gioitinh', '$sdt', '$diachi')";
     $user_type = "teacher";
     $themtkGV = "INSERT INTO user_form (name, email, password, user_type) VALUES('$ht','$magv','$pass','$user_type')";
     // echo $themsql; exit;
     //$complete = 'Bạn đã đăng ký thành công!';
     //header('location:test.php');
     if (mysqli_multi_query($conn, $themsql.";".$themtkGV)){
        //in thong bao thanh cong
        //tro ve trang liet ke
        header("Location: admin_c+.php");
    }
   }

};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
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
        <h1 style="text-align: center;">Form thêm giáo viên</h1>
        <form action="#" method="post">
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                };
            }
            ?>
            <div class="form-group">
                <label for="magv">Mã giáo viên</label>
                <input type="text" name="magv" id="magv" class="form-control"  required placeholder="Mời nhập mã giáo viên">
            </div>
            <div class="form-group">
                <label for="hoten">Họ tên giáo viên</label>
                <input type="text" id="hoten" class="form-control" name="hoten" required placeholder="Mời nhập họ tên giáo viên">
            </div>
            <div class="form-group">
                <label for="ngaysinh">Ngày sinh</label>
                <input type="date" id="ngaysinh" class="form-control" name="ngaysinh" required placeholder="Mời nhập ngày sinh">
            </div>
            <div class="form-group">
                <label for="gioiT">Giới tính</label>
                <select id="gioiT" name="gioiT" class="form-control">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" id="sdt" class="form-control" name="sdt" required placeholder="Mời nhập số điện thoại">
            </div>
            <div class="form-group">
                <label for="diachi">Địa chỉ</label>
                <input type="text" id="diachi" class="form-control" name="diachi" required placeholder="Mời nhập địa chỉ">
            </div>
            <button name="submit" class="btn btn-primary">Thêm giáo viên</button>
        </form>
    </div>
    <br>
</body>

</html>
<?php 
    mysqli_close($conn);
?>