<?php
include('connect.php');

session_start();
$_SESSION['user'];
$user = $_SESSION['user'];

$target_dir = "../pic/";
$newfilename = rand(1,9999999) . '.' .basename($_FILES["image"]["name"]);
$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$pic= $newfilename;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 10000000) {
    $size = true;
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {

    $format = true;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $upload = true;
     header('Location: http://s569318136.online.de/de/profil.php');
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $sql = "UPDATE user SET image = '$pic' WHERE username='".$user."'";
    $mysqli->query($sql)
    OR die('Error: ' . mysqli_error($mysqli));

    header('Location: http://s569318136.online.de/de/profil.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }


}
?>