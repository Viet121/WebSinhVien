<?php

@include 'config.php';

error_reporting(0);

if(isset($_POST['submit'])){
    $malhp = mysqli_real_escape_string($conn, $_POST['malhp']);
    $mamh = mysqli_real_escape_string($conn, $_POST['mamh']);
    $magv = mysqli_real_escape_string($conn, $_POST['magv']);
    $thu = mysqli_real_escape_string($conn, $_POST['thu']);
    $gio = mysqli_real_escape_string($conn, $_POST['gio']);

   $select = " SELECT * FROM lophocphan WHERE maLHP = '$malhp' ";
   $select2 = " SELECT * FROM lophocphan WHERE maGV = '$magv' AND thu = '$thu' AND gio = '$gio'";

   $result = mysqli_query($conn, $select);
   $result2 = mysqli_query($conn, $select2);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Mã lớp học phần đã tồn tại!';

   }
   else if(mysqli_num_rows($result2) > 0){
      $error[] = 'Giờ dạy của giáo viên đã bị trùng lịch!';
   }
   else{
      
     //viet lenh sql de them du lieu
     $themsql = "INSERT INTO lophocphan (maLHP, maMH, maGV, thu, gio) VALUES ('$malhp', '$mamh', '$magv', '$thu', '$gio')";
     // echo $themsql; exit;
     //$complete = 'Bạn đã đăng ký thành công!';
     //header('location:test.php');
     if (mysqli_query($conn, $themsql)){
        //in thong bao thanh cong
        //tro ve trang liet ke
        header("Location: admin_l.php");
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
    <title>Thêm lớp học phần</title>
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
        <h1 style="text-align: center;">Form thêm lớp học phần</h1>
        <form action="#" method="post">
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                };
            }
            ?>
            <div class="form-group">
                <label for="malhp">Mã lớp học phần</label>
                <input type="text" name="malhp" id="malhp" class="form-control"  required placeholder="Mời nhập mã lớp học phần">
            </div>
            <div class="form-group">
                <label for="mamh">Môn học</label>
                <select id="mamh" name="mamh" class="form-control">
                    <?php
                        //ketnoi
                        //require_once 'config.php'; vì câu lệnh @include 'config.php'; ở đầu trang đang kết nối sql cho cả trang rồi 
                        //cau lenh
                        $lietke_sql = "SELECT * FROM monhoc order by maMH";
                        //thuc thi cau lenh
                        $result = mysqli_query($conn, $lietke_sql);
                        //duyet qua result va in ra
                        while ($r = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $r['maMH'];?>"><?php echo $r['maMH']. " - " .$r['tenMH'];?></option>
                    <?php
                    }
                    //mysqli_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="magv">Giáo viên</label>
                <select id="magv" name="magv" class="form-control">
                    <?php
                        $lietke_sql = "SELECT * FROM giaovien order by maGV";
                        //thuc thi cau lenh
                        $result = mysqli_query($conn, $lietke_sql);
                        //duyet qua result va in ra
                        while ($r = mysqli_fetch_assoc($result)){
                    ?>
                    <option value="<?php echo $r['maGV'];?>"><?php echo $r['maGV']. " - " .$r['tenGV'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="thu">Thứ</label>
                <select id="thu" name="thu" class="form-control">
                    <option value="Thứ hai">Thứ hai</option>
                    <option value="Thứ ba">Thứ ba</option>
                    <option value="Thứ tư">Thứ tư</option>
                    <option value="Thứ năm">Thứ năm</option>
                    <option value="Thứ sáu">Thứ sáu</option>
                    <option value="Thứ bảy">Thứ bảy</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gio">Giờ học</label>
                <select id="gio" name="gio" class="form-control">
                    <option value="6h30 đến 11h40">6h30 đến 11h40</option>
                    <option value="6h30 đến 9h00">6h30 đến 9h00</option>
                    <option value="9h00 đến 11h40">9h00 đến 11h40</option>
                    <option value="12h30 đến 17h40">12h30 đến 17h40</option>
                    <option value="12h30 đến 15h00">12h30 đến 15h00</option>
                    <option value="15h10 đến 17h40">15h10 đến 17h40</option>
                </select>
            </div>
            <button name="submit" class="btn btn-primary">Thêm lớp học phần</button>
        </form>
    </div>
    <br>
</body>

</html>
<?php 
    mysqli_close($conn);
?>