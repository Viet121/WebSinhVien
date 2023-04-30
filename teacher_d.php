<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['teacher_name'])){
   header('location:test.php');
}
$malhp = htmlspecialchars($_GET['smaLHP']);
$malhp = mysqli_real_escape_string($conn, $malhp);

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
                    <i class="uil uil-presentation-edit" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Lớp học phần</span>
                </a></li>
                <li><a href="teacher_tkb.php">
                    <i class="uil uil-schedule"></i>
                    <span class="link-name">Thời khóa biểu</span>
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
                <form action="#" method="post">
                    <i class="uil uil-search"></i>
                    <input type="text" name="search" placeholder="Tìm kiếm theo mã sinh viên...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-comment-dots"></i>
                    <span class="text">Chi tiết lớp học phần</span>
                </div>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Mã lớp học phần</th>
                            <th>Mã môn học</th>
                            <th>Môn học</th>
                            <th>Số lượng</th>
                            <th>Thứ</th>
                            <th>Giờ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ms = htmlspecialchars($_SESSION['teacher_ms']);
                            $ms = mysqli_real_escape_string($conn, $ms);
                            
                                $sql = "SELECT LOPHOCPHAN.maLHP,MONHOC.maMH, tenMH, COUNT(MaSV) AS SoLuong_SV, thu, gio
                                    FROM LOPHOCPHAN 
                                    LEFT OUTER JOIN KQUA ON KQUA.maLHP = LOPHOCPHAN.maLHP
                                    INNER JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH
                                    WHERE LOPHOCPHAN.maGV LIKE '%" . $ms . "%' AND LOPHOCPHAN.maLHP LIKE '$malhp' 
                                    GROUP BY LOPHOCPHAN.maLHP,MONHOC.maMH, tenMH";
                            // Thực hiện truy vấn
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
                                <td><?php echo $row["SoLuong_SV"];?></td>
                                <td><?php echo $row["thu"];?></td>
                                <td><?php echo $row["gio"];?></td>
                            </tr>
                        <?php
                            }
                            //}
                        ?>
                    </tbody>
                </table>
                <br>
                <div style="float:right; margin-right: 25px;"><a href = "teacher_l.php" class="btn btn-outline-danger">Thoát</a></div>
                
                <div class="title">
                    <i class="uil uil-users-alt"></i>
                    <span class="text">Chi tiết sinh viên</span>
                </div>
                <table class="table">
                    <thead class="table-primary">
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
                        // Thực hiện truy vấn
                        if(isset($_POST['search']) && $_POST['search'] != ''){
                            $search = htmlspecialchars($_POST['search']); // Xử lý dữ liệu nhập vào để tránh XSS
                            $search = mysqli_real_escape_string($conn, $search); // Xử lý dữ liệu để tránh SQL injection
                            $sql = "SELECT KQUA.maLHP, MONHOC.maMH, tenMH, SINHVIEN.maSV, tenSV, diem 
                                FROM SINHVIEN, KQUA, MONHOC, LOPHOCPHAN
                                WHERE SINHVIEN.maSV = KQUA.MaSV AND KQUA.maLHP = LOPHOCPHAN.maLHP AND LOPHOCPHAN.maMH = MONHOC.maMH AND LOPHOCPHAN.maLHP = '$malhp'AND  SINHVIEN.maSV LIKE '%" . $search . "%' ORDER BY maSV";
                        }
                        else{
                            $sql = "SELECT KQUA.maLHP, MONHOC.maMH, tenMH, SINHVIEN.maSV, tenSV, diem 
                                FROM SINHVIEN, KQUA, MONHOC, LOPHOCPHAN
                                WHERE SINHVIEN.maSV = KQUA.MaSV AND KQUA.maLHP = LOPHOCPHAN.maLHP AND LOPHOCPHAN.maMH = MONHOC.maMH AND LOPHOCPHAN.maLHP = '$malhp'";
                        }
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
                    ?>
                    </tbody>
                </table>
                <br>
                <div style="float:right; margin-right: 25px;"><a href = "editD.php?smaLHP=<?php echo $malhp;?>" class="btn btn-outline-success">Sửa điểm</a></div>
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
?>