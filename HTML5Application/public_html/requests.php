<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'requiresLogin.php';
require 'config1.php';
require 'config7.php';
require 'finaledelete.php';
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
    <div class="main">
 <?php
 $user = $_SESSION['user'];



$request = $mysqli->query("SELECT id, gegenstand, price, city, str, plz, land, date FROM request WHERE userkennung='".$user."' ORDER BY placed DESC");
if (!$row_cnt = $request->num_rows){
echo '</br>You have no requests right now';
}else{
while($row = mysqli_fetch_object($request))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td rowspan='8'align='right'>";
   echo "<tr><td></td><td>GEGENSTAND:</td>";
   echo "<td colspan='2'><b>$row->gegenstand</b></td></tr>";
   echo "<tr><td></td><td>Max. TRANSPORT-PREIS:</td>";
   echo "<td><b>$row->price</b></td></tr>";
   echo "<tr><td colspan='2'><b>START-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT</td>";
   echo "<td>$row->city</td>";
   echo "<td>STRASSE:</td>";
   $str = "$row->str";
   $str = utf8_encode($str);
   echo "<td><b>$str</b></td>";;
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->plz</td>";
   echo "<td>LAND:</td>";
   echo "<td>$row->land</td></tr>";
   echo "<tr><td>DATUM:</td></td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td></td></tr>";
   $id= "$row->id";

   $id = encrypt($id, $key);

   echo "<tr><td></td><td><td></td></td><td></td><td align='right'><a href='auftrag_details.php?$id'>Details</a></td></tr>";
   echo "</br></table>";
   }
   }

echo "</div>";
echo "</section>";
include('footer.php');
?>
</body>
</html>