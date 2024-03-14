<?php

@include 'config.php';
@include 'filelogic.php';


session_start();
if(!isset($_SESSION['user_name']) && !isset($_SESSION['admin_name']) && !isset($_SESSION['vip_name'])){
   header('location:login_form.php');
}



?>

<?php 
include_once 'header.php'

?>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid justify-content-center d-flex bd-highlight mb-3">
    <a class="navbar-brand me-auto p-2 bd-highlight" href="home.php">
      Mooks
    </a>
    <ul class='nav nav-pills justify-content-end'>
    <?php 
      if (isset($_SESSION['admin_name'])) {
   echo "
     <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='home.php'>Home</a>
  </li>
   <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'admin_page.php'>Users</a>
  </li>

  <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link active ' href= 'user_page.php'>Download</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='logout.php'>Log Out</a>
  </li>";
  }elseif(isset($_SESSION['user_name']) || isset($_SESSION['vip_name']))  {
     echo"
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='home.php'>Home</a>
  </li>
  <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link active ' href= 'user_page.php'>Download</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='logout.php'>Log Out</a>
  </li>";
  }

    ?>
    </ul>
  </div>
</nav>
    
   
<div style="margin-left: 15px; display: inline;">
   
 <div class="d-flex justify-content-center d-block p-2 fs-3">Books</div>
   <div class="d-flex justify-content-center d-block p-2">
    <table class="table fs-6">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
 <?php foreach ($files as $file): ?>
    <tr>
      <td><?php echo $file['id']; ?></td>
      <td><?php echo $file['name']; ?></td>
      <td><?php echo $file['author']; ?></td>
      <td><?php echo $file['descript']; ?></td>
      <td><button class="btn btn-secondary my-1"><a href="user_page.php?file_id=<?php echo $file['id'] ?>" class=" text-light text-decoration-none">Download</a></button></td>
    </tr>
  <?php endforeach;?>
  
  </tbody>
</table>

    </div>

<?php if (isset($_SESSION['admin_name']) || isset($_SESSION['vip_name'])) {
   echo " <div class='container-fluid p-4 position-static'>
<form action='upload.php' method='post' enctype='multipart/form-data' class='fs-6 fst-normal m-4'>
        <h2 class='fs-4 fst-normal m-2'>Upload Book</h2>
        <input type='text' name='author' placeholder='Book Author..' class='d-block mb-3' autocomplete='off' style='padding: 4px; background-color: darkgrey;'>
        <input type='text' name='name' placeholder='Book Name..' class='d-block mb-3' autocomplete='off' style='padding: 4px; background-color: darkgrey;'>
        <input type='text' name='descript' placeholder='Book Description..' class='d-block mb-3' autocomplete='off'  style='padding: 4px; background-color: darkgrey;'>
        <label for='fileSelect'>Filename:</label>
        <input type='file' name='file' id='fileSelect'>
        <button type='submit' name='submit' style='padding: 4px;'>Upload</button> 
    </form>
    </div>
        </div>";
      }elseif(isset($_SESSION['user_name'])){
        echo"<div class='d-flex justify-content-center d-block p-2 fs-6 my-5'>You must be a Vip to upload books</div>";
      }


?>



    <?php if (isset($_GET['error'])): ?>
        <p class="d-flex justify-content-center "><?php echo $_GET['error']; ?></p>
    <?php endif ?>
<?php 

  if (!isset($_SESSION['admin_name']) && !isset($_SESSION['vip_name']) && !isset($_SESSION['user_name'])) {
include_once 'footer.php';
}else{
include_once 'footer2.php';
};
?>