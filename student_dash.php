<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['student_name'])){
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
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Tìm kiếm...">
            </div>
            
            <img src="images/logo_n6.png" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-comment-dots"></i>
                    <span class="text">Ý kiến phản hồi</span>
                </div>
                <h1 style="font-size: 50px; text-align: center; color:#0b47c09e ">Welcome to HCMUE</h1>
                <br>
                <h2>Chào <?php echo $_SESSION['student_name'] ?></h2> 
                <p style="font-size: 25px;">- Chào mừng bạn đến với hệ thống hỗ trợ quản lý sinh viên </p>
                <p style="font-size: 25px;">- Chúc bạn có một trải nghiệm và làm việc hài lòng với hệ thống của chúng tôi </p>
                <p style="font-size: 25px;">- Nhằm cải thiện và nâng cao chất lượng hệ thống, chúng tôi mong muốn nhận được sự đóng góp ý kiến chân thành và xây dựng từ phía các bạn. </p>
                <p style="font-size: 25px;">- Vì vậy bất kể là góp ý, ý tưởng hay đề xuất mới, chúng tôi rất mong chờ nhận được những đóng góp từ phía các bạn. </p>
                <p style="font-size: 25px;">- Mọi ý kiến đóng góp vui lòng liên hệ qua: </p>
                <div class="wrapper">
                    <a href="https://www.facebook.com/profile.php?id=100026100860936" class="button">
                        <div class="icon">
                        <i class="fab fa-facebook-f"></i>
                        </div>
                        <span>Facebook</span>
                    </a>
                    <a href="https://www.instagram.com/qucviet/" class="button">
                        <div class="icon">
                        <i class="fab fa-instagram"></i>
                        </div>
                        <span>Instagram</span>
                    </a>
                    <a href="https://github.com/Viet121" class="button">
                        <div class="icon">
                        <i class="fab fa-github"></i>
                        </div>
                        <span>Github</span>
                    </a>
                </div>
                <br>
                <h2>Trân trọng cảm ơn và chúc bạn một ngày tốt lành!</h2>
            </div>
        </div>
    </section>


    <script src="Dashboard.js"></script>
</body>
</html>
