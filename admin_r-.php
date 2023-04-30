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

    <!----======== bootstrap 5 ======== -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
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
                    <i class="uil uil-chat-info" ></i>
                    <span class="link-name" >Tiếp nhận</span>
                </a></li>
                <li><a href="admin_r-.php">
                    <i class="uil uil-users-alt" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Sinh viên </span>
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
                    <i class="uil uil-presentation-edit"></i>
                    <span class="link-name">Lớp học phần</span>
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
                    <input type="text" name="search" placeholder="Tìm kiếm theo mssv...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-comment-dots"></i>
                    <span class="text">Danh sách thông tin sinh viên</span>
                </div>
                
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>MSSV</th>
                            <th>Họ và tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>SDT</th>
                            <th>Địa chỉ</th>
                            <th style="text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_GET['search']) && $_GET['search'] != ''){
                                $search = htmlspecialchars($_GET['search']); // Xử lý dữ liệu nhập vào để tránh XSS
                                $search = mysqli_real_escape_string($conn, $search); // Xử lý dữ liệu để tránh SQL injection
                                $lietke_sql = "SELECT * FROM sinhvien WHERE maSV LIKE '%" . $search . "%' ORDER BY maSV";
                            }
                            else{
                                $lietke_sql = "SELECT * FROM sinhvien order by maSV";
                            }
                            //cau lenh
                            //$lietke_sql = "SELECT * FROM sinhvien order by maSV";
                            //thuc thi cau lenh
                            $result = mysqli_query($conn, $lietke_sql);
                            //duyet qua result va in ra
                            while ($r = mysqli_fetch_assoc($result)){
                        ?>
                            <tr>
                                <td><?php echo $r['maSV'];?></td>
                                <td><?php echo $r['tenSV'];?></td>
                                <td><?php echo $r['ngaySinh'];?></td>
                                <td><?php echo $r['gioiTinh'];?></td>
                                <td><?php echo $r['SDT'];?></td>
                                <td><?php echo $r['diaChi'];?></td>
                                <td style="text-align: center;">
                                    <a href = "editSV.php?smaSV=<?php echo $r['maSV'];?>" class="btn btn-outline-primary">Sửa</a>
                                    <a onclick="return confirm('Bạn có muốn xoá sinh viên này không !');" href = "xoaSV.php?smaSV=<?php echo $r['maSV'];?>" class="btn btn-outline-danger">Xóa</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <br>
                <div style="float:right; margin-right: 25px;"><a href = "form+SV.php" class="btn btn-outline-success">Thêm sinh viên</a></div>    
                <br>
                <br>    
                
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
?>
