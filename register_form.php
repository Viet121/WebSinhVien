<?php

@include 'config.php';

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
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
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
         <option value="student">student</option>
         <option value="teacher">teacher</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="tạo tài khoản ngay" class="form-btn">
   </form>
</div>

</body>
</html>