<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['student_name'])){
   header('location:test.php');
}
$ms = htmlspecialchars($_SESSION['student_ms']);
$ms = mysqli_real_escape_string($conn, $ms);

if(isset($_POST['submit2'])){
    $malhp = mysqli_real_escape_string($conn, $_POST['malhp']);
    $thu = mysqli_real_escape_string($conn, $_POST['thu']);
    $gio = mysqli_real_escape_string($conn, $_POST['gio']);

   $select = " SELECT * FROM kqua WHERE maLHP = '$malhp' AND maSV = '$ms' ";
   $select2 = " SELECT LOPHOCPHAN.maLHP, LOPHOCPHAN.thu, LOPHOCPHAN.gio
                FROM LOPHOCPHAN
                INNER JOIN KQUA ON LOPHOCPHAN.maLHP = KQUA.maLHP
                INNER JOIN SINHVIEN ON KQUA.maSV = SINHVIEN.maSV
                WHERE SINHVIEN.maSV = '$ms' AND LOPHOCPHAN.thu = '$thu' AND LOPHOCPHAN.gio = '$gio';";

   $result = mysqli_query($conn, $select);
   $result2 = mysqli_query($conn, $select2);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Lớp học phần này đã đăng ký!';

   }
   else if(mysqli_num_rows($result2) > 0){
      $error[] = 'Lớp học phần này đã bị trùng lịch!';
   }
   else{
      
     //viet lenh sql de them du lieu
     $themsql = "INSERT INTO KQUA (maLHP, maSV) VALUES ('$malhp', '$ms')";
     // echo $themsql; exit;
     //$complete = 'Bạn đã đăng ký thành công!';
     //header('location:test.php');
     if (mysqli_query($conn, $themsql)){
        //in thong bao thanh cong
        //tro ve trang liet ke
        header("Location: student_y.php");
    }
   }
};

if(isset($_POST['submit1'])){
    $malhp = mysqli_real_escape_string($conn, $_POST['malhp']);
   $xoa_sql = "DELETE FROM kqua WHERE maSV = '$ms' AND maLHP = '$malhp'";
    //echo $xoa_sql;
    mysqli_query($conn, $xoa_sql);
    // echo "<h1>Xoa thanh cong</h1>";
    //tro ve trang liet ke
    header("Location: student_y.php");
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="Dashboard.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo_n6.png" alt="">
            </div>

            <span class="logo_name">Sinh viên</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="student_dash.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Tiếp nhận</span>
                </a></li>
                
                <li><a href="student_me.php">
                    <i class="uil uil-presentation-edit"></i>
                    <span class="link-name">Lớp học phần</span>
                </a></li>
                <li><a href="student_tkb.php">
                    <i class="uil uil-schedule"></i>
                    <span class="link-name">Thời khóa biểu</span>
                </a></li>
                <li id="like"><a href="student_diem.php">
                    <i class="uil uil-file-bookmark-alt"></i>
                    <span class="link-name">Điểm</span>
                </a></li>
                <li><a href="student_y.php">
                    <i class="uil uil-comments" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Đăng ký</span>
                </a></li>
                <li><a href="student_tk.php">
                    <i class="uil uil-user-circle"></i>
                    <span class="link-name">Tài khoản</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            

            <div class="search-box">
                <form method="get">
                    <i class="uil uil-search"></i>
                    <input type="text" name="search" placeholder="Tìm kiếm theo mã lớp học phần...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Đăng ký học phần</span>
                </div>
                <?php                  
                     $sql3 = "SELECT * FROM CHUCNANG
                                WHERE tenChucNang = 'DangKyHocPhan_SV'";
                     $result3 = mysqli_query($conn, $sql3);    
                     $row = mysqli_fetch_assoc($result3);
                    if($row['tinhTrang']==0){
                        echo '<p style="font-size: 25px;"> Hiện tại chức năng Đăng ký học phần chưa được mở! </p>';
                    }
                    else{
                ?>  
                <?php                  
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<div class="alert alert-danger">'.$error.'</div>';
                        };
                    }                                                         
                ?>                                                                            
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Mã lớp học phần</th>
                            <th>Mã môn học</th>
                            <th>Môn học</th>
                            <th>Mã giáo viên</th>
                            <th>Giáo viên</th>
                            <th>Thứ</th>
                            <th>Giờ</th>
                            <th style="text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['search']) && $_GET['search'] != ''){
                                $search = htmlspecialchars($_GET['search']); // Xử lý dữ liệu nhập vào để tránh XSS
                                $search = mysqli_real_escape_string($conn, $search); // Xử lý dữ liệu để tránh SQL injection
                                $lietke_sql = "SELECT L.maLHP, M.maMH, M.tenMH, G.maGV, G.tenGV, L.thu, L.gio
                                FROM LOPHOCPHAN L
                                INNER JOIN MONHOC M ON L.maMH = M.maMH
                                INNER JOIN GIAOVIEN G ON L.maGV = G.maGV
                                WHERE LOPHOCPHAN.maLHP LIKE '%" . $search . "%';";
                            }
                            else{
                                $lietke_sql = "SELECT L.maLHP, M.maMH, M.tenMH, G.maGV, G.tenGV, L.thu, L.gio
                                FROM LOPHOCPHAN L
                                INNER JOIN MONHOC M ON L.maMH = M.maMH
                                INNER JOIN GIAOVIEN G ON L.maGV = G.maGV;";
                            }
                            //cau lenh
                            //thuc thi cau lenh
                            $result = mysqli_query($conn, $lietke_sql);
                            //duyet qua result va in ra
                            while ($r = mysqli_fetch_assoc($result)){
                        ?>
                            <form action="#" method="post">
                            <tr>
                                <td><input type="text" name="malhp" id="malhp" style="font-size: 14px;" value="<?php echo $r['maLHP'];?>" readonly></td>
                                <td><?php echo $r['maMH'];?></td>
                                <td><?php echo $r['tenMH'];?></td>
                                <td><?php echo $r["maGV"];?></td>
                                <td><?php echo $r["tenGV"];?></td>
                                <td><input type="text" name="thu" id="thu" style="font-size: 14px;" value="<?php echo $r["thu"];?>" readonly></td>
                                <td><input type="text" name="gio" id="gio" style="font-size: 14px;" value="<?php echo $r['gio'];?>" readonly></td>
                                <td style="text-align: center;">
                                    <input type="submit" name="submit2" value="Đăng ký" class="btn btn-outline-primary">
                                </td>
                            </tr>
                            </form>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="title">
                    <i class="uil uil-presentation-check"></i>
                    <span class="text">Các lớp học phần đã đăng ký</span>
                </div>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Mã lớp học phần</th>
                            <th>Mã môn học</th>
                            <th>Môn học</th>
                            <th>Mã giáo viên</th>
                            <th>Giáo viên</th>
                            <th>Thứ</th>
                            <th>Giờ</th>
                            <th style="text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $lietke_sql2 = "SELECT LOPHOCPHAN.maLHP, MONHOC.maMH, MONHOC.tenMH, GIAOVIEN.maGV, GIAOVIEN.tenGV, LOPHOCPHAN.thu, LOPHOCPHAN.gio
                                FROM LOPHOCPHAN
                                INNER JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH
                                INNER JOIN GIAOVIEN ON LOPHOCPHAN.maGV = GIAOVIEN.maGV
                                INNER JOIN KQUA ON LOPHOCPHAN.maLHP = KQUA.maLHP
                                WHERE KQUA.maSV = '$ms';";
                            //cau lenh
                            //thuc thi cau lenh
                            $result2 = mysqli_query($conn, $lietke_sql2);
                            //duyet qua result va in ra
                            while ($r2 = mysqli_fetch_assoc($result2)){
                        ?>
                            <form action="#" method="post">
                            <tr>
                            <td><input type="text" name="malhp" id="malhp" style="font-size: 14px;" value="<?php echo $r2['maLHP'];?>" readonly></td>
                                <td><?php echo $r2['maMH'];?></td>
                                <td><?php echo $r2['tenMH'];?></td>
                                <td><?php echo $r2["maGV"];?></td>
                                <td><?php echo $r2["tenGV"];?></td>
                                <td><?php echo $r2["thu"];?></td>
                                <td><?php echo $r2["gio"];?></td>
                                <td style="text-align: center;">
                                    <input type="submit" name="submit1" value="Hủy" onclick="return confirm('Bạn có muốn hủy lớp học phần này không !');" class="btn btn-outline-danger">
                                </td>
                            </tr>
                            </form>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                    }
                ?>
                <br>
                <br>
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>