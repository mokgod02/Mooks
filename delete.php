<?php
include_once 'config.php';
if (isset($_GET['deleteid'])){
	$id=$_GET['deleteid'];

	$sql="DELETE FROM user_form where id='$id'";
	$result=mysqli_query($conn,$sql);
	if($result){
		header('location:admin_page.php');
		die(mysqli_error($conn));
	}
}

?>