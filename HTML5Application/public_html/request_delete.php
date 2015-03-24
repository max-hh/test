<?php
require 'requiresLogin.php';
include('userheader.php');
include ('sec.php');
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
  <title>Auftr&auml;ge</title>
  <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
 <body>

  <section class="container">
   <div class="login">
   <?php

$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

   $user = $_SESSION['user'];
   $_SESSION['id'] = $id;




echo "<p>Möchtest du wirklich deinen Auftrag entgültig löschen?</p>";
echo "<table>";
echo "<form name='Formular' action='requests.php' method='post'>";
echo "<input type='hidden' name='id' value='$id'</p>";
echo "<tr><td><a href='auftrag_details.php?id=$id'>Zurück</a></td><td></td><td><p class='submit'><input type='submit' name='delete' value='Löschen'></p></td></tr>";
echo "</table>";

   echo "</div>";
    echo "</section>";
include('footer.php');
           ?>
</body>
</html>