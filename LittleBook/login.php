<?php 
include 'connect.php';
$con = mysqli_connect('localhost','root','','little_shop') or die('connection failed');
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($con,$_POST['email']);
   $pass = mysqli_real_escape_string($con,$_POST['password']);

   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($con,"SELECT * FROM register WHERE email ='$email' AND password = '$pass'") or die('Query faild');

   if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);
      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
       
   }else{
      $message[] = 'incorrect email address or password';
       }
   }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">

<form action="" method="post">
   <h3>login now</h3>
   <input type="email" name="email" placeholder="enter your email" required class="box">
   <input type="password" name="password" placeholder="enter your password" required class="box">
   <input type="submit" name="submit" value="login now" class="btn">
   <p>don't have an account? <a href="register.php">register now</a></p>
</form>

</div>
    
</body>
</html>