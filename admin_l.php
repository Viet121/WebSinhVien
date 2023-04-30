<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:test.php');
}

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

            <span class="logo_name">Admin</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="admin_chat.php">
                    <i class="uil uil-chat-info"></i>
                    <span class="link-name">Tiếp nhận</span>
                </a></li>
                <li><a href="admin_r-.php">
                <i class="uil uil-users-alt"></i>
                    <span class="link-name">Sinh viên</span>
                </a></li>
                <li id="like"><a href="admin_c+.php">
                    <i class="uil uil-book-reader"></i>
                    <span class="link-name">Giáo viên</span>
                </a></li>
                <li><a href="admin_c-.php">
                    <i class="uil uil-book-open"></i>
                    <span class="link-name">Môn học</span>
                </a></li>
                <li><a href="admin_l.php">
                    <i class="uil uil-presentation-edit" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Lớp học phần</span>
                </a></li>
                <li><a href="admin_cp.php">
                    <i class="uil uil-cog"></i>
                    <span class="link-name">Cấp phép</span>
                </a></li>
                <li><a href="admin_register.php">
                    <i class="uil uil-user-plus" ></i>
                    <span class="link-name" >Tạo tài khoản</span>
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
                    <input type="text" name="search" placeholder="Tìm kiếm theo mã lớp học phần...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-comment-dots"></i>
                    <span class="text">Danh sách thông tin lớp học phần</span>
                </div>
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>Mã lớp học phần</th>
                            <th>Mã môn học</th>
                            <th>Môn học</th>
                            <th>Số lượng</th>
                            <th style="text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['search']) && $_GET['search'] != ''){
                                $search = htmlspecialchars($_GET['search']); // Xử lý dữ liệu nhập vào để tránh XSS
                                $search = mysqli_real_escape_string($conn, $search); // Xử lý dữ liệu để tránh SQL injection
                                
                                $sql = "SELECT LOPHOCPHAN.maLHP,MONHOC.maMH, tenMH, COUNT(MaSV) AS SoLuong_SV
                                    FROM LOPHOCPHAN 
                                    LEFT OUTER JOIN KQUA ON KQUA.maLHP = LOPHOCPHAN.maLHP
                                    INNER JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH
                                    WHERE LOPHOCPHAN.maLHP LIKE '%" . $search . "%' 
                                    GROUP BY LOPHOCPHAN.maLHP,MONHOC.maMH, tenMH";
                            }
                            else{
                                $sql = "SELECT LOPHOCPHAN.maLHP,MONHOC.maMH, tenMH, COUNT(MaSV) AS SoLuong_SV
                                    FROM LOPHOCPHAN 
                                    LEFT OUTER JOIN KQUA ON KQUA.maLHP = LOPHOCPHAN.maLHP
                                    INNER JOIN MONHOC ON LOPHOCPHAN.maMH = MONHOC.maMH
                                    GROUP BY LOPHOCPHAN.maLHP,MONHOC.maMH, tenMH";
                            }
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
                                <td style="text-align: center;">
                                    <a href = "formLHP.php?smaLHP=<?php echo $row["maLHP"];?>" class="btn btn-outline-primary">Chi tiết</a>
                                    <a onclick="return confirm('Bạn có muốn xoá lớp học phần này không !');" href = "xoaLHP.php?smaLHP=<?php echo $row["maLHP"];?>" class="btn btn-outline-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php
                            }
                            //}
                        ?>
                    </tbody>
                </table>
                <br>
                <div style="float:right; margin-right: 25px;"><a href = "form+LHP.php" class="btn btn-outline-success">Thêm lớp học phần</a></div>        
                    

            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
?>

