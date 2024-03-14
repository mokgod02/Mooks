<?php 
@include 'config.php';

session_start();
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
    <a class= 'nav-link active' href= 'home.php' >Home</a>
  </li>
  <?php 

  if (isset($_SESSION['admin_name'])) {
  	echo "<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'admin_page.php'>Users</a>
  </li>
  <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'user_page.php'>Download</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='logout.php'>Log Out</a>
  </li>";
  }elseif (isset($_SESSION['user_name'])) {
  	echo "<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'user_page.php'>Download</a>
  </li>
  <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='logout.php'>Log Out</a>
  </li>";
  }elseif (isset($_SESSION['vip_name'])) {
  	echo "
    <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'user_page.php'>Download</a>
  </li>
  <li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='logout.php'>Log Out</a>
  </li>";
  }else{
  	echo"<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link ' href= 'register_form.php' >Sign Up</a>
  </li>
<li class= 'nav-item p-2 bd-highlight' >
    <a class= 'nav-link' href='login_form.php'>Log In</a>
  </li>";

  };


  ?>
</ul>
  </div>
</nav>


<div class="d-flex justify-content-center d-block p-2 fs-3">Books</div>

   <div>
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
<?php
  $sql="SELECT * FROM images";
  $result=mysqli_query($conn, $sql);
  if($result){
    while($row=mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $author = $row['author'];
      $desc = $row['descript'];

        echo '
        <tr>
      <th scope="row">'.$id.'</th>
      <td>'.$name.'</td>
      <td>'.$author.'</td>
      <td>'.$desc.'</td>

    </tr>';

    }
  }
?>

  </tbody>

</table>

    </div>


<?php 

  if (!isset($_SESSION['admin_name']) && !isset($_SESSION['vip_name']) && !isset($_SESSION['user_name'])) {
    echo"   <div class='d-flex justify-content-center d-block p-2 fs-6 my-5'><a href='register_form.php'>Sign Up</a><span class='mx-1'>Or</span><a href='login_form.php'>Log In</a> <span class='ms-1'>To Upload And Download Books</span></div>";
  }
?>
 



<?php 

  if (!isset($_SESSION['admin_name']) && !isset($_SESSION['vip_name']) && !isset($_SESSION['user_name'])) {
include_once 'footer.php';
}else{
include_once 'footer2.php';
};
?>