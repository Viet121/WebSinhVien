<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['student_name'])){
   header('location:test.php');
}
$ms = htmlspecialchars($_SESSION['student_ms']);
$ms = mysqli_real_escape_string($conn, $ms);

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
                    <i class="uil uil-file-bookmark-alt" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Điểm</span>
                </a></li>
                <li><a href="student_y.php">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Đăng ký</span>
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
                    <span class="text">Điểm </span>
                </div>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Mã lớp học phần</th>
                            <th>Mã môn học</th>
                            <th>Môn học</th>
                            <th>Điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['search']) && $_GET['search'] != ''){
                                $search = htmlspecialchars($_GET['search']); // Xử lý dữ liệu nhập vào để tránh XSS
                                $search = mysqli_real_escape_string($conn, $search); // Xử lý dữ liệu để tránh SQL injection
                                $lietke_sql = "SELECT KQUA.maLHP, LOPHOCPHAN.maMH, MONHOC.tenMH, KQUA.diem
                                FROM KQUA
                                JOIN LOPHOCPHAN ON KQUA.maLHP = LOPHOCPHAN.maLHP
                                JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH
                                WHERE KQUA.maSV = '$ms' AND KQUA.maLHP LIKE '%" . $search . "%';";
                            }
                            else{
                                $lietke_sql = "SELECT KQUA.maLHP, LOPHOCPHAN.maMH, MONHOC.tenMH, KQUA.diem
                                FROM KQUA
                                JOIN LOPHOCPHAN ON KQUA.maLHP = LOPHOCPHAN.maLHP
                                JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH
                                WHERE KQUA.maSV = '$ms';";
                            }
                            //cau lenh
                            //thuc thi cau lenh
                            $result = mysqli_query($conn, $lietke_sql);
                            //duyet qua result va in ra
                            while ($r = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                                <td><?php echo $r['maLHP'];?></td>
                                <td><?php echo $r['maMH'];?></td>
                                <td><?php echo $r['tenMH'];?></td>
                                <td><?php echo $r['diem'];?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>