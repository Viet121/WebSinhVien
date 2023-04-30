<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['teacher_name'])){
   header('location:test.php');
}


    $ngaydd = $_POST['dsdd'];
    $malhp = $_POST['smaLHP'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Danh sách điểm danh</title>
</head>
<body>
    
<div class="container mt-3">
  <br>
  <h1 style="text-align: center;">Danh sách điểm danh</h1>
  <br>
  <h5>Danh sách điểm danh ngày: <?php echo date("d/m/Y", strtotime($ngaydd)); ?></h5>
  <table class="table">
    <thead class="table-info">
    <tr>
        <th>Ngày</th>
        <th>Mã lớp học phần</th>
        <th>Mã sinh viên</th>
        <th>Tên sinh viên</th>
        <th>Điểm danh</th>
      </tr>
    </thead>
    <tbody>
    <?php

        // Thực hiện truy vấn
        $sql = "SELECT DIEMDANH.ngayDD, DIEMDANH.maLHP, DIEMDANH.maSV, SINHVIEN.tenSV, DIEMDANH.diemdanh
                                FROM DIEMDANH
                                JOIN SINHVIEN ON DIEMDANH.maSV = SINHVIEN.maSV
                                WHERE DIEMDANH.maLHP = '$malhp' AND DIEMDANH.ngayDD = '$ngaydd'";
        $result = mysqli_query($conn, $sql);  
        // Kiểm tra và hiển thị kết quả truy vấn
        //if (mysqli_num_rows($result) > 0) {      
        //duyet qua result va in ra
        while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row["ngayDD"];?></td>
            <td><?php echo $row["maLHP"];?></td>
            <td><?php echo $row["maSV"];?></td>
            <td><?php echo $row["tenSV"];?></td>
            <td><?php echo $row["diemdanh"];?></td>
        </tr>
    <?php
        }
        //}
        mysqli_close($conn);
    ?>
    </tbody>
  </table>
</div>

</body>
</html>