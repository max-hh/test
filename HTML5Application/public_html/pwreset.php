<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<meta name="Keywords" content="#">
<meta name="Description" content="#">
<meta http-equiv="Content-Language" content="en">
<meta name="robots" content="index,follow">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dn'deliverr</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dec">

    <div class="login">
<?php
include('connect.php');
include('sec.php');

$user = $_SERVER['QUERY_STRING'];
$user = decrypt($user, $key);

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
   echo "<table cellpadding='5'>";
   echo "<tr><td align='center'><h2>Setze dein Passwort zur&uuml;ck</h2></td></tr>";
   echo "<form name='Formular' action='' method='post' >";
   echo "<tr><td><input type='password' name='password' value='' placeholder='New Password'></td></tr>";
   echo "<tr><td><input type='password' name='password2' value='' placeholder='Repeat Password'></td></tr>";
   echo "<tr><td align='center'><input type='submit' name='changePassword' value='Change!'></td></tr>";
   echo "</table>";
 ?>
 </div>
 </div>
 </body>
 </html>