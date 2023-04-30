<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['teacher_name'])){
   header('location:test.php');
}
$ms = htmlspecialchars($_SESSION['teacher_ms']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </style>
    
</head>
<body>
<nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo_n6.png" alt="">
            </div>

            <span class="logo_name">Teacher</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="teacher_page.php">
                    <i class="uil uil-chat-info"></i>
                    <span class="link-name">Tiếp nhận</span>
                </a></li>
                <li><a href="teacher_l.php">
                    <i class="uil uil-presentation-edit"></i>
                    <span class="link-name">Lớp học phần</span>
                </a></li>
                <li><a href="teacher_tkb.php">
                    <i class="uil uil-schedule" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Thời khóa biểu</span>
                </a></li>
                <li><a href="teacher_dd.php">
                    <i class="uil uil-file-check-alt"></i>
                    <span class="link-name">Điểm danh</span>
                </a></li>
                <li><a href="teacher_tk.php">
                    <i class="uil uil-user-circle"></i>
                    <span class="link-name">Tài khoản</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Đăng xuất</span>
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
                    <input type="text" name="search" placeholder="Tìm kiếm ...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-comment-dots"></i>
                    <span class="text">Thời khóa biểu</span>
                </div>

                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Thứ</th>
                            <th>Giờ</th>
                            <th>Mã lớp</th>
                            <th>Mã môn</th>
                            <th>Tên môn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $lietke_sql = "SELECT LOPHOCPHAN.thu, LOPHOCPHAN.gio, LOPHOCPHAN.maLHP, MONHOC.maMH, MONHOC.tenMH 
                                    FROM LOPHOCPHAN 
                                    JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH 
                                    WHERE LOPHOCPHAN.maGV = '$ms';";
                            //cau lenh
                            //thuc thi cau lenh
                            $result = mysqli_query($conn, $lietke_sql);
                            //duyet qua result va in ra
                            while ($r = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                                <td><?php echo $r['thu'];?></td>
                                <td><?php echo $r['gio'];?></td>
                                <td><?php echo $r['maLHP'];?></td>
                                <td><?php echo $r['maMH'];?></td>
                                <td><?php echo $r['tenMH'];?></td>
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
<?php 
    mysqli_close($conn);
?>