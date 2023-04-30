<?php

@include 'config.php';

error_reporting(0);

if(isset($_POST['submit'])){
    $mamh = mysqli_real_escape_string($conn, $_POST['mamh']);
    $ht = mysqli_real_escape_string($conn, $_POST['hoten']);
    $sotin = $_POST['sotin'];
    $mactdt = $_POST['mactdt'];

   $select = " SELECT * FROM monhoc WHERE maMH = '$mamh' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Mã môn học đã tồn tại!';

   }
   else{
      
     //viet lenh sql de them du lieu
     $themsql = "INSERT INTO monhoc (maMH, tenMH, soTinChiMH, maCTDT) VALUES ('$mamh', '$ht', '$sotin', '$mactdt')";
     // echo $themsql; exit;
     //$complete = 'Bạn đã đăng ký thành công!';
     //header('location:test.php');
     if (mysqli_query($conn, $themsql)){
        //in thong bao thanh cong
        //tro ve trang liet ke
        header("Location: admin_c-.php");
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
    <title>Thêm môn học</title>
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
        <h1 style="text-align: center;">Form thêm môn học</h1>
        <form action="#" method="post">
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                };
            }
            ?>
            <div class="form-group">
                <label for="mamh">Mã môn học</label>
                <input type="text" name="mamh" id="mamh" class="form-control"  required placeholder="Mời nhập mã môn học">
            </div>
            <div class="form-group">
                <label for="hoten">Tên môn học</label>
                <input type="text" id="hoten" class="form-control" name="hoten" required placeholder="Mời nhập tên môn học">
            </div>
            <div class="form-group">
                <label for="sotin">Số tín chỉ </label>
                <input type="text" id="sotin" class="form-control" name="sotin" required placeholder="Mời nhập số tín chỉ">
            </div>
            <div class="form-group">
                <label for="mactdt">Mã chương trình đào tạo</label>
                <input type="text" id="mactdt" class="form-control" name="mactdt" value="CNTT_47" readonly>
            </div>
            <button name="submit" class="btn btn-primary">Thêm môn học</button>
        </form>
    </div>
    <br>
</body>

</html>
<?php 
    mysqli_close($conn);
?>