<?php 


if (isset($_GET['file_id'])) {
	include "config.php";

    $id = $_GET['file_id'];

    $sql = "SELECT * FROM images WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'upload/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/' . $file['name']));
        readfile('upload/' . $file['name']);
        exit;
    }

}

?>
 

