<?php 
include 'config.php';
$id=$_GET['updateid'];
$sql="SELECT * FROM `user_form` where id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$user_type = $row['user_type'];
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $user_type=$_POST['user_type'];
    

    $sql="UPDATE `user_form` SET id='$id', name='$name', email='$email', user_type='$user_type' where id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
         header("location: admin_page.php");
        
    }else{
        die(mysqli_error($conn));
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; margin: 20px; }
    </style>

</head>
<body>
<nav class="navbar nav-pills navbar-light bg-light">
  <div class="container-fluid justify-content-center d-flex bd-highlight mb-3">
    <a class="navbar-brand me-auto p-2 bd-highlight" href="home.php">
      Mooks
    </a>
    <ul class="nav justify-content-end">
  <li class="nav-item p-2 bd-highlight">
    <a class="nav-link" aria-current="page" href="admin_page.php">Users</a>
  </li>
</ul>
  </div>
</nav>

<div class="form-container">
    <form method="post">
        <div class="d-flex justify-content-center">
    <h2>Update User</h2>
</div>

<p class="d-flex justify-content-start">Update Name</p>
    <input type="text" name="name" required placeholder="Enter your name" autocomplete="off" value= <?php echo $name;?>>
    <p class="d-flex justify-content-start">Update Email</p>
      <input type="email" name="email" required placeholder="Enter your email" autocomplete="off" value= <?php echo $email;?>>
       <p class="d-flex justify-content-start">Update User Level</p>
      <select name="user_type" autocomplete="off" value= <?php echo $user_type;?>>
         <option value="user">user</option>
         <option value="admin">admin</option>
         <option value="vip">vip</option>
      </select>
        <button type="submit" class="btn btn-primary mt-3" name="submit">Update</button>
  </div>

</form>
</div>


    </body>
</html>