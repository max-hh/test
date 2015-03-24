<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'config.php';
include('connect.php');
include ('userheader.php');

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
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
 }

// Check file size
if ($_FILES["image"]["size"] > 10000000) {
    echo "Sorry, deine Datei ist zu groß.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;

}
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $sql = "UPDATE user SET image = '$pic' WHERE username='".$user."'";
    $mysqli->query($sql)
    OR die('Error: ' . mysqli_error($mysqli));
    $upload = true;

    }else {
     $uploadFailed = true;
    }

 }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dn'deliver</title>
  <link rel="stylesheet" href="style.css">
  <script type="text/javascript" src="jquery.easing.1.3.js"></script>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

  <script type="text/javascript">

function doIt(group) {

var isHidden = (group.style.display != "none" ) ? 0 : 1;
if (isHidden)
{
group.style.display ="";
}
else {
group.style.display ="none";
}

}

</script>

  </head>
        <body>
        <?php

        echo "<div id='top'>";
    echo "<div id='navi'>";
    echo "<table cellpadding='15'>";
    echo "<tr><td><a href='ownreview.php'>Your Reviews</a></td></tr>";
    echo "</table>";
     echo "</div>";
     echo "</div>";
          echo "<section class='container'>";
        echo "<div class='main'>";

$user = $_SESSION['user'];

if($uploadFailed) {
         echo "Sorry, aber dein Bild konnte nicht hochgeladen werden.";
        }
        if($upload) {
        echo "Dein Bild ". basename( $_FILES["image"]["name"]). " wurde erfolgreich hochgeladen.";
        }

$sql = $mysqli->query("SELECT image FROM user WHERE username='".$user."'");
 while($rows = mysqli_fetch_object($sql))
                  {
   $image= "$rows->image";
   }
   if($image==''){
   $profil = $mysqli->query("SELECT username, firstname, lastname, image FROM  user WHERE username='".$user."'");
   while($row = mysqli_fetch_object($profil))
                  {
   $image= "$row->image";
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%'>";
   echo "<tr><td>E-Mail: </td>";
   echo "<td>$row->username</td><td><img src=../pic/profil.png width='120px' height='auto'></td></tr>";
   echo "<tr><td>Firstname: </td>";
   echo "<form action='' method='post' enctype='multipart/form-data'>";
   echo "<td>$row->firstname</td><td><input  type='file' name='image'/></td></tr>";
   echo "<tr><td>Lastname: </td>";
   echo "<td>$row->lastname</td><td><input type='submit' value='Upload' /></td></tr>";
     echo "</table></br>";
     }
   }else {
$profil_info = $mysqli->query("SELECT username, firstname, lastname, image FROM  user WHERE username='".$user."'");
   while($row = mysqli_fetch_object($profil_info))
                  {
   $image= "$row->image";
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%'>";
   echo "<tr><td>E-Mail: </td>";
   echo "<td>$row->username</td><td rowspan='3'><img src=../pic/".$image." width='120px' height='auto'></td></tr>";
   echo "<tr><td>Firstname: </td>";
   echo "<td>$row->firstname</td></tr>";
   echo "<tr><td>Lastname: </td>";
   echo "<td>$row->lastname</td></tr>";
     echo "</table></br>";

     }
     }






     $password =$_POST['password'];
   $password2 =$_POST['password2'];

if($password == $password2)
   {
      if(isset($_POST['changePassword'])AND !empty($password))
  {
   $hashedPassword = buildHash($password);
   $sql_select = "UPDATE user SET `password` = '".$hashedPassword."'  WHERE username='".$user."'";

     if (!mysqli_query($mysqli,$sql_select)) {
  die('Error: ' . mysqli_error($mysqli));
                         }

        echo "Dein Passwort wurde ge&auml;ndert.";
  }
  }else{
  echo "Die Passw&ouml;rter stimmen nicht &uuml;berein";

  }

    echo "<ul id='toggle-view'>";
   echo "<li>";
   echo "<div id='password_menu' onclick='doIt(password)' >";
   echo "<h3>Change your Password</h3>";
   echo "</div>";
   echo"<div id='password' style='display:none;'>";
   echo "<form name='Formular' action='' method='post' >";
   echo "<p><input type='password' name='password' value='' placeholder='New Password'></p>";
   echo "<p><input type='password' name='password2' value='' placeholder='Repeat Password'></p>";
   echo "<p class='submit'><input type='submit' name='changePassword' value='Change!'></p>";
   echo "</div>";
   echo "</li>";
   echo "</ul>";

      echo "</div>";
    echo "</section>";
include('footer.php');
?>
        </body>
</html>