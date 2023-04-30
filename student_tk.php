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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/></style>

    
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
                    <i class="uil uil-estate" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;" >Tiếp nhận</span>
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
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Đăng ký </span>
                </a></li>
                <li><a href="student_tk.php">
                    <i class="uil uil-user-circle" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Tài khoản</span>
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
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
            <div class="title">
                    <i class="uil uil-comment-dots"></i>
                    <span class="text">Thông tin cá nhân</span>
                </div>

                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th style="text-align: center; font-size: 25px;" >Thông tin sinh viên</th>
                            <th style="text-align: center; font-size: 25px;" >Thông tin liên lạc</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $lietke_sql = "select * from sinhvien WHERE maSV = '$ms';";
                            //cau lenh
                            //thuc thi cau lenh
                            $result = mysqli_query($conn, $lietke_sql);
                            //duyet qua result va in ra
                            while ($r = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                                <td>
                                    <div style="font-size: 20px;"><strong>- Mã sinh viên:</strong> <?php echo $r['maSV'];?></div>
                                    <div style="font-size: 20px;"><strong>- Tên sinh viên:</strong> <?php echo $r['tenSV'];?></div>
                                    <div style="font-size: 20px;"><strong>- Ngày sinh:</strong> <?php echo date("d/m/Y", strtotime($r['ngaySinh'])); ?></div>
                                    <div style="font-size: 20px;"><strong>- Giới tính:</strong> <?php echo $r['gioiTinh'];?></div>
                                </td>
                                <td>
                                    <div style="font-size: 20px;"><strong>- Số điện thoại:</strong> <?php echo $r['SDT'];?></div>
                                    <div style="font-size: 20px;"><strong>- Địa chỉ:</strong> <?php echo $r['diaChi'];?></div>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="menu-items" style="float:right; margin-right: 25px;">
                    <ul class="nav-links">
                    <li><a href="editSV.php?smaSV=<?php echo $ms;?>">
                        <i class="uil uil-sync"></i>
                        <span class="link-name">Cập nhật thông tin</span>
                    </a></li>
                    <li><a href="doimk.php">
                        <i class="uil uil-padlock"></i>
                        <span class="link-name">Đổi mật khẩu</span>
                    </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>
