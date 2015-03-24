<?php
require 'requiresLogin.php';
require 'update.php';
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

$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

if($update) {
echo "Dein Auftrag wurde ge&auml;ndert.";
}
$request = $mysqli->query("SELECT userkennung, id, gegenstand, price, hight, width, depth, city, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate, info FROM request WHERE id=$id");
while($row = mysqli_fetch_object($request))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td></td><td><b>GEGENSTAND: </b></td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td></td><td><b>Max. TRANSPORT-PREIS: </b></td>";
   echo "<td>$row->price</td></tr>";
   echo "<tr><td>SIZE:</td>";
   echo "<td <td colspan='2'>$row->hight x $row->width x $row->depth</td></tr>";
   echo "<tr><td colspan='2'><b>START-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT:</td>";
   echo "<td>$row->city</td>";
   echo "<td>STRASSE:</td>";
   $str = "$row->str";
   $str = utf8_encode($str);
   echo "<td><b>$str</b></td></tr>";
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->plz</td>";
   echo "<td>LAND:</td>";
   echo "<td>$row->land</td></tr>";
   echo "<tr><td>DATUM:</td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td colspan='2'><b>ZIEL-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT:</td>";
   echo "<td>$row->arrcity</td>";
   echo "<td>STRASSE:</td>";
     $arrstr = "$row->arrstr";
   $arrstr = utf8_encode($arrstr);
   echo "<td><b>$arrstr</b></td></tr>";
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->arrplz</td>";
   echo "<td>LAND:</td>";
   echo "<td>$row->arrland</td></tr>";
   echo "<tr><td>DATUM:</td>";
   echo "<td>$row->arrdate</td></tr>";
   echo "<tr><td>ZUS&Auml;TZLICHE INFO</td>";
     $info = "$row->info";
   $info = utf8_encode($info);
   echo "<td><b>$info</b></td></tr>";
   $id ="$row->id";
   $user ="$row->userkennung";

   $_SESSION['user']= $user;

   $id = encrypt($id, $key);

   echo "<tr><td><a href='requests.php'>Alle deine Auftr&auml;ge</a></td><td><a href='request_delete.php?$id'>L&ouml;schen</a></td><td colspan='4'><a href='change.php?$id'>Bearbeite deinen Auftrag</a></td></tr>";
   echo "</table>";
   }

      echo "</div>";
    echo "</section>";
include('footer.php');

?>
</body>
</html>