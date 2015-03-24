<?php
require_once 'car.requiresLogin.php';
include('header.php');
require('sec.php');
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

 <?php
 $user = $_SESSION['car.user'];
   echo "<section class='container'>";
   echo "<div class='login'>";


$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

$change_transport = $mysqli->query("SELECT id, fahrzeug, licence, start,ziel, startdate, tarrdate FROM transport WHERE id=$id");
while($row = mysqli_fetch_object($change_transport))
   {
    $id = "$row->id";
   $_SESSION['id'] = $id;

   $id = encrypt($id, $key);
   echo "<form name='Formular' action='car.request.php?$id' method='post' >";
   echo "<h1>Bearbeite dein Auftrag</h1>";
   echo "<table cellpadding='5'>";
   echo "<tr><td><input type='text' name='fahrzeug' value='$row->fahrzeug' placeholder='Fahrzeug'></td></tr>";
   echo "<tr><td><input type='text' name='licence' value='$row->licence' placeholder='Kennzeichen'></td></tr>";
   echo "<tr><td><p>Start-Address</p></td></tr>";
   echo "<tr><td><input type='text' name='start' value='$row->start' placeholder='Stadt'></td></tr>";
   echo "<tr><td><input type='text' name='startdate' value='$row->startdate' placeholder='Start-Datum'></td></tr>";
   echo "<tr><td><p>Destination</p></td></tr>";
   echo "<tr><td><input type='text' name='ziel' value='$row->ziel' placeholder='Stadt'></td></tr>";
   echo "<tr><td><input type='text' name='tarrdate' value='$row->tarrdate' placeholder='Ankunft-Datum'></td></tr>";
   echo "<tr><td><input type='submit' name='submitButton' value='&Auml;ndern!'></td></tr>";
   echo "</table>";
   }

      echo "</div>";
    echo "</section>";
include('footer.php');
?>
</body>
</html>