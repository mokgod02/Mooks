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

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_type'] = $row['type'];

         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
          $_SESSION['user_type'] = $row['type'];
         header('location:user_page.php');

      }elseif($row['user_type'] == 'vip'){

         $_SESSION['vip_name'] = $row['name'];
          $_SESSION['vip_type'] = $row['type'];
         header('location:user_page.php');

      }else{
      $error[] = 'incorrect email or password!';
   }

};
}
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
    <ul class="nav nav-pills navbar-light mb-3 justify-content-end"> 
        <li class= 'nav-item p-2 bd-highlight'>
    <a class= 'nav-link ' href= 'home.php' >Home</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'register_form.php' >Sign Up</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link active' href='login_form.php'>Log In</a>
  </li></ul>
  </div>
</nav>
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email" autocomplete="off">
      <input type="password" name="password" required placeholder="Enter your password" autocomplete="off">
      <input type="submit" name="submit" value="Login now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>
</div>

<?php 
include_once 'footer.php';
?>