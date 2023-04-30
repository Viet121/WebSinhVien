<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:test.php');
}

if(isset($_POST['submit'])){

    //$malhp; đã có ở trên
    $tenchucnang =  $_POST['tenchucnang'];
    $capphep = $_POST['capphep'];;
    
 
    $update = "UPDATE CHUCNANG SET tinhTrang='$capphep' WHERE tenChucNang='$tenchucnang'";
    mysqli_query($conn, $update);
    
    //header('location:test.php');
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
                    <i class="uil uil-presentation-edit"></i>
                    <span class="link-name">Lớp học phần</span>
                </a></li>
                <li><a href="admin_cp.php">
                    <i class="uil uil-cog" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Cấp phép</span>
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
                    <input type="text" name="search" placeholder="Tìm kiếm ...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
            <div class="title">
                    <i class="uil uil-users-alt"></i>
                    <span class="text">Đóng mở chức năng</span>
                </div>
                <table class="table">
                    <thead class="table-primary">
                    <tr>
                        <th>Tên chức năng</th>
                        <th style="text-align: center;">Tình trạng</th>
                        <th style="text-align: center;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Thực hiện truy vấn
                        if(isset($_POST['search']) && $_POST['search'] != ''){
                            $search = htmlspecialchars($_POST['search']); // Xử lý dữ liệu nhập vào để tránh XSS
                            $search = mysqli_real_escape_string($conn, $search); // Xử lý dữ liệu để tránh SQL injection
                            $sql = "SELECT * FROM CHUCNANG
                                WHERE tenChucNang LIKE '%" . $search . "%' ";
                        }
                        else{
                            $sql = "SELECT * FROM CHUCNANG";
                        }
                        $result1 = mysqli_query($conn, $sql);  
                        
                        while($row = mysqli_fetch_assoc($result1)) {
                    ?>
                        <form action="#" method="post">
                        <tr>
                            <td><input type="text" style="font-size: 14px;" name="tenchucnang" id="tenchucnang"  value="<?php echo $row["tenChucNang"];?>" readonly></td>
                            <td style="text-align: center;">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio1" name="capphep" value=1 <?php echo ($row["tinhTrang"] == 1) ? 'checked="checked"' : '' ?>>
                                <label style="margin-left: 10px; margin-right: 10px;" class="form-check-label" for="radio1">Mở</label>
                                <input type="radio" class="form-check-input" id="radio2" name="capphep" value=0 <?php echo ($row["tinhTrang"] == 0) ? 'checked="checked"' : '' ?>>
                                <label style="margin-left: 10px;" class="form-check-label" for="radio2">Đóng</label>
                            </div>
                            </td>
                            <td style="text-align: center;">
                                    <button style="width: 51px; height: 32px;" name="submit" class="btn btn-outline-primary">Lưu</button>
                            </td>
                        </tr>
                        </form>    
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
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
