<?php

@include 'config.php';

if(isset($_POST['submit'])){

//    $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $passc = md5($_POST['passwordc']);
   $passm = md5($_POST['passwordm']);
   $cpassm = md5($_POST['cpasswordm']);
//    $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' ";

   $result = mysqli_query($conn, $select);
   $r = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){

        if($passc != $r['password']){
            $error[] = 'Mật khẩu cũ không đúng!';
        }
        else if($passm != $cpassm){
            $error[] = 'Mật khẩu không khớp!';
        }
        else{
            $updateTK = "UPDATE user_form SET password='$passm'WHERE email='$email'";
            mysqli_query($conn, $updateTK);
            $complete = 'Bạn đã đổi mật khẩu thành công!';
            //header('location:test.php');
        }

    }
    else{
        $error[] = 'Mã số không tồn tại!';
    }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đổi mật khẩu</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>đổi mật khẩu</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      }elseif(isset($complete)){
            echo '<span class="complete-msg">'.$complete.'</span>';
      };
      ?>
      <!-- <input type="text" name="name" required placeholder="Nhập họ và tên"> -->
      <input type="text" name="email" required placeholder="Nhập mã số">
      <input type="password" name="passwordc" required placeholder="Nhập mật khẩu cũ">
      <input type="password" name="passwordm" required placeholder="Nhập mật khẩu mới">
      <input type="password" name="cpasswordm" required placeholder="Xác nhận lại mật khẩu mới">
      <input type="submit" name="submit" value="đổi mật khẩu ngay" class="form-btn">
   </form>
</div>

</body>
</html>