<?php

@include 'config.php';


session_start();
if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}



?>

<?php
include_once'header.php';

 ?>
<body>
<nav class="navbar nav-pills navbar-light bg-light">
  <div class="container-fluid justify-content-center d-flex bd-highlight mb-3">
    <a class="navbar-brand me-auto p-2 bd-highlight" href="home.php">
      Mooks
    </a>
    <ul class="nav nav-pills justify-content-end">
  <li class="nav-item p-2 bd-highlight">
    <a class="nav-link" aria-current="page" href="home.php">Home</a>
  </li>
     <li class="nav-item p-2 bd-highlight">
    <a class="nav-link active" aria-current="page" href="admin_page.php">Users</a>
  </li>
  <li class="nav-item p-2 bd-highlight">
    <a class="nav-link" aria-current="page" href="user_page.php">Download</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='logout.php'>Log Out</a>
  </li></ul>
  </div>
</nav>
   
<div >

   <div class="d-flex justify-content-center d-block p-2">

   </div>
   <div class="d-flex justify-content-center d-block p-2 fs-3">User Form</div>
   <div class="d-flex justify-content-center d-block p-2">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">E-Mail</th>
      <th scope="col">User-type</th>
    </tr>
  </thead>
  <tbody>
<?php
  $sql="SELECT * FROM user_form";
  $result=mysqli_query($conn, $sql);
  if($result){
    while($row=mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
      $user_type = $row['user_type'];

        echo '
        <tr>
      <th scope="row">'.$id.'</th>
      <td>'.$name.'</td>
      <td>'.$email.'</td>
      <td>'.$user_type.'</td>

    <td>
  <button class="btn btn-secondary my-1"><a href="update.php? updateid= '.$id.'" class=" text-light text-decoration-none">Update</a></button> 
  <button class="btn btn-danger my-1"><a href="delete.php? deleteid='.$id.'" class=" text-light text-decoration-none" >Delete</a></button>
  </td>

    </tr>';

    }
  }
?>
  
  </tbody>
</table>

    </div>
    </div>
<?php 

  if (!isset($_SESSION['admin_name']) && !isset($_SESSION['vip_name']) && !isset($_SESSION['user_name'])) {
include_once 'footer.php';
}else{
include_once 'footer2.php';
};
?>
    
