<?php

//ket noi
require_once 'config.php';

$malhp = htmlspecialchars($_GET['smaLHP']);
$malhp = mysqli_real_escape_string($conn, $malhp);

//cau lenh de lay thong tin ve sinh vien co maSV = $masv
$select_sql = "SELECT SINHVIEN.maSV, tenSV, diem 
                FROM SINHVIEN, KQUA, MONHOC, LOPHOCPHAN
                WHERE SINHVIEN.maSV = KQUA.MaSV
                    AND KQUA.maLHP = LOPHOCPHAN.maLHP
                    AND LOPHOCPHAN.maMH = MONHOC.maMH
                    AND LOPHOCPHAN.maLHP = '$malhp'";

$result = mysqli_query($conn, $select_sql);
$list = [];
while($row = mysqli_fetch_array($result,1)){
    $list[] = $row;
}
if(isset($_POST['button2'])){
    //nhan du lieu tu form
    $masv = $_POST['masv'];
    $diem = mysqli_real_escape_string($conn, $_POST['sdiem']);
    
        //viet lenh sql de cap nhat du lieu
        $update_sql = "UPDATE kqua SET diem='$diem' WHERE maLHP='$malhp' AND maSV='$masv'";
        
        //echo $update_sql; exit;
        //thuc thi cau lenh them
        if (mysqli_query($conn, $update_sql)){
            //in thong bao thanh cong
            //tro ve trang liet ke
            header("Location: editD.php?smaLHP=$malhp");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <br>
        <h1 style="text-align: center;">Form chỉnh sửa điểm sinh viên</h1>
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th>STT</th>
                        <th>Mã số sinh viên</th>
                        <th>Họ tên</th>
                        <th>Điểm</th>
                        <th style="text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($list as $std){
                        echo '<form action="#" method="post">
                            <tr>
                                <td>'.($i++).'</td>
                                <td><input type="text" name="masv" style="width: 200px;" id="masv" class="form-control form-control-sm"  value="'.$std['maSV'].'" readonly></td>
                                <td>'.$std['tenSV'].'</td>
                                <td><input type="text" name="sdiem" style="width: 55px; id="sdiem" class="form-control form-control-sm" value="'.$std['diem'].'" onfocus="this.value=\'\'" onblur="if(this.value==\'\') this.value=\''.$std['diem'].'\'"></td>
                                <td style="text-align: center;"><button name="button2" id="button2" class="btn btn-outline-success btn-sm">Sửa</button></td>
                            </tr>
                            </form>';
                    }
                    ?>
                </tbody>
            </table>
            <button name="button1" id="button1" onclick="window.location.href='teacher_d.php?smaLHP=<?php echo $malhp; ?>'" class="btn btn-primary" style="float:right; margin-right: 50px;">Cập nhật</button>
            <script>

            </script>
    </div>
</body>

</html>
<?php 
    mysqli_close($conn);
?>