
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chi tiết lớp học phần</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <br>
  <h1 style="text-align: center;">Form chi tiết lớp học phần</h1>
  <br>
  <h5>Chi tiết giáo viên, ca dạy:</h5>
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>Mã lớp học phần</th>
        <th>Mã môn học</th>
        <th>Môn học</th>
        <th>Mã giáo viên</th>
        <th>Tên giáo viên</th>
        <th>Thứ</th>
        <th>Giờ</th>
      </tr>
    </thead>
    <tbody>
    <?php
        $malhp = $_GET['smaLHP'];

        //ket noi
        require_once 'config.php';
        // Thực hiện truy vấn
        $sql = "SELECT maLHP, MONHOC.maMH, tenMH,GIAOVIEN.maGV, tenGV, thu, gio
                FROM LOPHOCPHAN, MONHOC, GIAOVIEN
                WHERE MONHOC.maMH = LOPHOCPHAN.maMH AND LOPHOCPHAN.maGV = GIAOVIEN.maGV AND LOPHOCPHAN.maLHP = '$malhp'";
        $result = mysqli_query($conn, $sql);  
        // Kiểm tra và hiển thị kết quả truy vấn
        //if (mysqli_num_rows($result) > 0) {      
        //duyet qua result va in ra
        while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row["maLHP"];?></td>
            <td><?php echo $row["maMH"];?></td>
            <td><?php echo $row["tenMH"];?></td>
            <td><?php echo $row["maGV"];?></td>
            <td><?php echo $row["tenGV"];?></td>
            <td><?php echo $row["thu"];?></td>
            <td><?php echo $row["gio"];?></td>
        </tr>
    <?php
        }
        //}
    ?>                        
    </tbody>
  </table>
  <h5>Chi tiết sinh viên:</h5>
  <table class="table">
    <thead class="table-info">
    <tr>
        <th>Mã lớp học phần</th>
        <th>Mã môn học</th>
        <th>Môn học</th>
        <th>Mã sinh viên</th>
        <th>Tên sinh viên</th>
        <th>Điểm</th>
      </tr>
    </thead>
    <tbody>
    <?php
        $malhp = $_GET['smaLHP'];

        // Thực hiện truy vấn
        $sql = "SELECT KQUA.maLHP, MONHOC.maMH, tenMH, SINHVIEN.maSV, tenSV, diem 
                FROM SINHVIEN, KQUA, MONHOC, LOPHOCPHAN
                WHERE SINHVIEN.maSV = KQUA.MaSV AND KQUA.maLHP = LOPHOCPHAN.maLHP AND LOPHOCPHAN.maMH = MONHOC.maMH AND LOPHOCPHAN.maLHP = '$malhp'";
        $result = mysqli_query($conn, $sql);  
        // Kiểm tra và hiển thị kết quả truy vấn
        //if (mysqli_num_rows($result) > 0) {      
        //duyet qua result va in ra
        while($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row["maLHP"];?></td>
            <td><?php echo $row["maMH"];?></td>
            <td><?php echo $row["tenMH"];?></td>
            <td><?php echo $row["maSV"];?></td>
            <td><?php echo $row["tenSV"];?></td>
            <td><?php echo $row["diem"];?></td>
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
