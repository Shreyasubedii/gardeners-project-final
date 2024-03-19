<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   // modified code 
   // if (preg_match('/^\d/', $name)) {
   //    $message[] = 'Username cannot start with numbers!';
   // }
   // till here 
   
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   
   // modified code 
   // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   //    $message[] = 'Invalid email address!';
   // }
   // till here 
   
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   // $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $pass = mysqli_real_escape_string($conn, $filter_pass);
   // modified 
   // $pass = md5($pass);
   // till here 
   
   // modified code 

   // if (strlen($pass) <= 8) {
   //    $message[] = 'Password must be longer than 8 characters!';
   // }
   // if (!preg_match('/^(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/', $pass)) {
   //    $message[] = 'Password must contain at least one letter and one special character!';
   // }
   // else{
   //    $pass = mysqli_real_escape_string($conn, md5($pass));
   // }
   //  else {
   //    $pass = md5($pass);
   // }
   // till here 

   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, ($filter_cpass));
   // modified 
   // if (strlen($cpass) <= 8) {
   //    $message[] = 'Password must be longer than 8 characters!';
   // }
   // if (!preg_match('/^(?=.*[a-zA-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/', $cpass)) {
   //    $message[] = 'Confirm password must contain at least one letter and one special character!';
   // }
   //  else{
   //   $cpass = mysqli_real_escape_string($conn, md5($cpass));
      
   //  }
   // till here 

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

    <section class="form-container">

        <form action="" method="post">
            <h3>register now</h3>
            <input type="text" name="name" class="box" placeholder="enter your username" required>
            <input type="email" name="email" class="box" placeholder="enter your email" required>
            <input type="password" name="pass" class="box" placeholder="enter your password" required>
            <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
            <input type="submit" class="btn" name="submit" value="register now">
            <p>already have an account? <a href="login.php">login now</a></p>

        </form>

    </section>
    <!-- <script src="reg.js"></script> -->
</body>

</html>