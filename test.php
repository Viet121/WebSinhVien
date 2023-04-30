<?php

@include 'config.php';

session_start();
error_reporting(0);
if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_ms'] = $row['email'];
         header('location:admin_chat.php');

      }
      elseif($row['user_type'] == 'student'){

         $_SESSION['student_name'] = $row['name'];
         $_SESSION['student_ms'] = $row['email'];
         header('location:student_dash.php');

      }
      elseif($row['user_type'] == 'teacher'){

        $_SESSION['teacher_name'] = $row['name'];
        $_SESSION['teacher_ms'] = $row['email'];
        header('location:teacher_page.php');

     }
     
   }else{
     $error[] = '<span style="color:red;">Tài khoản hoặc mật khẩu không tồn tại!. Vui lòng nhập lại!</span>';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="test.css">
    
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
            <form action="#" class="sign-in-form" method="post">
              <h2 class="title">Sign in</h2>
              <?php
                if(isset($error)){
                  foreach($error as $error){
                      echo '<span class="error-msg">'.$error.'</span>';
                  };
                };
              ?>
              <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="email" placeholder="Tài khoản" />
              </div>
              <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" />
              </div>
              <div class="checkbox-text">
                <div class="checkbox-content">
                    <input type="checkbox" id="logCheck">
                    <label for="logCheck" class="text">Ghi nhớ lần đăng nhập sau</label>
                </div> 
              </div>

            <input type="submit" name="submit" value="Đăng nhập" class="btn solid" />
            </form>
        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h1 class="title1">HCMUE</h1>
            <p>
              Hệ thống hỗ trợ quản lý sinh viên
              được xây dựng và phát triển bởi các thành viên Nhóm 6 - Lớp COMP130302
            <br>
                Trường Đại học Sư Phạm TP.HCM 
            </p>
          </div>
          <img src="img/log.svg" class="image" alt ="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>