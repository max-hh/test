<?php
error_reporting(E_ALL ^ E_NOTICE);
require 'requiresLogin.php';
require_once 'config4.php';
include('userheader.php');
include('sec.php');
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
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
 <body>

  <section class="container">
    <div class="login">

 <?php
$_SESSION['user'];

$userkennung = $_SERVER['QUERY_STRING'];
$user = decrypt($userkennung, $key);
$_SESSION['userkennung'] = $user;



    echo "<h1>Sende eine Nachricht</h1>";
     if(isset($_POST['send']))
        {
        echo "Danke! Deine nNachricht wurde an den User geschickt";
        }
   echo "<form name='sendMessageForm' action='' method='post'>";
   echo "<table>";
   echo "<tr><td colspan='2' ><textarea name='messageText'></textarea></td></tr>";
   echo "<tr><td><input type='submit' value='Send' name='send'/></td></tr>";

   echo "</table>";
   echo "</form>";
   echo "</section>";
   echo "</div>";
   include('footer.php');
  ?>
</body>
</html>