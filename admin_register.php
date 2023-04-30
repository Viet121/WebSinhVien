
<?php

@include 'config.php';
session_start();
if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
 
    $select = " SELECT * FROM user_form WHERE email = '$email' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $error[] = 'Mã số đã tồn tại!';
 
    }
    else{
 
       if($pass != $cpass){
          $error[] = 'Mật khẩu không khớp!';
       }else{
          $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
          mysqli_query($conn, $insert);
          $complete = 'Bạn đã đăng ký thành công!';
          //header('location:test.php');
       }
    }
 
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
                    <span class="link-name">Sinh viên </span>
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
                    <i class="uil uil-user-plus" style="color:#0E4BF1;"></i>
                    <span class="link-name" style="color:#0E4BF1;">Tạo tài khoản</span>
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
                    <input type="text" name="search" placeholder="Tìm kiếm...">
                </form>   
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-user-plus"></i>
                    <span class="text">Tạo tài khoản cho Admin</span>
                </div>

                <div class="form-container">
                    <form action="" method="post">
                        <h3>tạo tài khoản</h3>
                        <?php
                        if(isset($error)){
                            foreach($error as $error){
                                echo '<span class="error-msg">'.$error.'</span>';
                            };
                        }elseif(isset($complete)){
                                echo '<span class="complete-msg">'.$complete.'</span>';
                        };
                        ?>
                        <input type="text" name="name" required placeholder="Nhập họ và tên">
                        <input type="text" name="email" required placeholder="Nhập mã số">
                        <input type="password" name="password" required placeholder="Nhập mật khẩu">
                        <input type="password" name="cpassword" required placeholder="Xác nhận lại mật khẩu">
                        <select name="user_type">
                            <option value="admin">admin</option>
                        </select>
                        <input type="submit" name="submit" value="tạo tài khoản ngay" class="form-btn">
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>
<?php 
    mysqli_close($conn);
?>