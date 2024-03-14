<?php 
include_once 'config.php';

$sql = "SELECT * FROM images";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['submit']) && isset($_FILES['file'])) {
    include "config.php";

    
    $newFileName = mysqli_real_escape_string($conn, $_POST['name']);
    if (empty($newFileName)) {
       $newFileName = "book";
    }else{
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $desc = mysqli_real_escape_string($conn, $_POST['descript']);

    $file = $_FILES['file'];


    $filename = $file["name"];
    $tmpname = $file["tmp_name"];
    $size = $file["size"];
    $error = $file["error"];

    $extension = explode(".", $filename );
    $extension_lc = strtolower(end($extension));

    if (!in_array($extension_lc, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['file']['size'] < 200000000) { 
        $fileFullName = $newFileName . "." . uniqid("", true) . "." . $extension_lc;

        $destination = 'upload/' . $fileFullName;

        include_once "config.php";
        if (empty($author) || empty($desc)) {
            header("Location: ../user_page.php?upload=empty");
            exit();
        }else{
            move_uploaded_file($tmpname, $destination);
            $sql = "INSERT INTO images (name, author, descript) VALUES ('$fileFullName', '$author', '$desc')";
            if (mysqli_query($conn, $sql)) {
                header("Location:user_page.php");
                echo "File uploaded successfully";
  
            }else {
            echo "Failed to upload file.";
        }
}
    } else {
        echo"Fie is too large";    
}
}

if (isset($_GET['file_id'])) {
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