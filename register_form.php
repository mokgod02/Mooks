<?php

@include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $error[] = "Please enter a proper email!";
      }

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }elseif (strlen(trim($_POST["password"])) < 6) {
         $error[] ="Password must have atleast 6 characters.";
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<?php 
include_once 'header.php';

?>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid justify-content-center d-flex bd-highlight mb-3">
    <a class="navbar-brand me-auto p-2 bd-highlight" href="home.php">
      Mooks
    </a>
    <ul class="nav nav-pills mb-3 justify-content-end"> 
        <li class= 'nav-item p-2 bd-highlight'>
    <a class= 'nav-link' href= 'home.php' >Home</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link active' href= 'register_form.php' >Sign Up</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='login_form.php'>Log In</a>
  </li></ul>
  </div>
</nav>
<div class="form-container">

   <form action="" method="post">
      <h3>Register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name" autocomplete="off">
      <input type="email" name="email" required placeholder="Enter your email" autocomplete="off">
      <input type="password" name="password" required placeholder="Enter your password" autocomplete="off">
      <input type="password" name="cpassword" required placeholder="Confirm your password" autocomplete="off">
      <select name="user_type" autocomplete="off">
         <option value="user">user</option>
         <option value="admin">admin</option>
         <option value="vip">vip</option>
      </select>
      <input type="submit" name="submit" value="Register now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form></div>

<?php 
include_once 'footer.php';
?>