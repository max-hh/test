<?php
require 'car.requiresLogin.php';
require('sec.php');
$user = $_SESSION['car.user'];
$_SESSION['id'];

$request = $mysqli->query("SELECT COUNT(*) AS anzahl FROM transport WHERE userkennung='".$user."'");
$var = mysqli_fetch_object($request);
if ($var->anzahl == 1){
$result = $mysqli->query("SELECT id FROM transport WHERE userkennung='".$user."'");
while($row = mysqli_fetch_object($result))
   {
   $aid = "$row->id";
   }
$aid = encrypt($aid, $key);
$url ="http://s569318136.online.de/de/handling.php?$aid";
header ( 'Location:'.$url );
}
include('header.php');

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
  echo "<section class='container'>";
  echo "<div class='main'>";


$user = $_SESSION['car.user'];
$_SESSION['id'];
echo "<h3>Bitte w&auml;hlen einen deiner nachfolgend aufgelisteten Fahrzeuge aus</h3>";

$result = $mysqli->query("SELECT id, userkennung, fahrzeug, licence, start, startdate, ziel, tarrdate FROM transport WHERE userkennung='".$user."' ORDER BY placed DESC");
while($row = mysqli_fetch_object($result))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
    echo "<tr><td></td><td><b>Fahrzeug: </b></td>";
   echo "<td>$row->fahrzeug</td></tr>";
   echo "<tr><td>Kennzeichen</td>";
   echo "<td>$row->licence</td></tr>";
   echo "<tr><td colspan='2'><b>Start-Adresse</b></td></tr>";
   echo "<tr><td>Stadt:</td>";
   echo "<td>$row->start</td>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->startdate</td></tr>";
   echo "<tr><td></td></tr>";
   echo "<tr><td colspan='2'><b>Ziel</b></td></tr>";
   echo "<tr><td>Stadt:</td>";
   echo "<td>$row->ziel</td>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->tarrdate</td></tr>";
   $aid = "$row->id";
   $aid = encrypt($aid, $key);
   echo "<tr><td></td><td></td><td align='right'><a href='handling.php?$aid'>Dieses</a></td></tr>";
   echo "</table></br>";
             }



echo "</div>";
echo "</section>";

include('footer.php');
        ?>
</body>
</html>