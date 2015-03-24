<?php
require 'car.requiresLogin.php';
require('sec.php');
$user = $_SESSION['user'];
$request = $mysqli->query("SELECT COUNT(*) AS anzahl FROM request WHERE userkennung='".$user."'");
$var = mysqli_fetch_object($request);
if ($var->anzahl == 1){
$result = $mysqli->query("SELECT id FROM request WHERE userkennung='".$user."'");
while($row = mysqli_fetch_object($result))
   {
   $aid = "$row->id";
   }
$aid = encrypt($aid, $key);
$url ="http://s569318136.online.de/de/thisone.php?$aid";
header ( 'Location:'.$url );
}
include('userheader.php');

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




  session_start();
$id = $_SESSION['id'];

echo "<h3>Bitte w&auml;hlen einen deiner nachfolgend aufgelisteten Auftr&auml;ge aus</h3>";

$result = $mysqli->query("SELECT id, userkennung, gegenstand, price, hight, width, depth, info, city, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate FROM request WHERE userkennung='".$user."' ORDER BY placed DESC");
 if (!$row_cnt = $result->num_rows){
echo '</br>Bitte erstelle erst einen Auftrag <a href="auftrag.php">Erstelle einen Auftrag</a>, dann komme zurück!</br>';
}else{
while($row = mysqli_fetch_object($result))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td></td><td><b>Gegenstand: </b></td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td></td><td><b>Max. Preis: </b></td>";
   echo "<td>$row->price $</td></tr>";
   echo "<tr><td>SIZE:</td>";
   echo "<td>$row->hight x $row->width x $row->depth</td></tr>";
   echo "<tr><td colspan='2'><b>Start-Addresse</b></td></tr>";
   echo "<tr><td>Stadt</td>";
   echo "<td>$row->city</td>";
   echo "<td>Strasse:</td>";
   echo "<td>$row->str</td></tr>";
   echo "<td>PLZ:</td>";
   echo "<td>$row->plz</td>";
   echo "<td>Land:</td>";
   echo "<td>$row->land</td></tr>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td></td></tr>";
   echo "<tr><td colspan='2'><b>Ziel</b></td></tr>";
   echo "<tr><td>Stadt</td>";
   echo "<td>$row->arrcity</td>";
   echo "<td>Strasse:</td>";
   echo "<td>$row->arrstr</td></tr>";
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->arrplz</td>";
   echo "<td>Land:</td>";
   echo "<td>$row->arrland</td></tr>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->arrdate</td></tr></br>";
   echo "<tr><td>Zus&auml;tzliche Infos</td>";
   echo "<td>$row->info</td></tr>";
   $aid = "$row->id";
   $aid = encrypt($aid, $key);
   $userkennungA = "$row->userkennung";
   echo "<tr><td></td><td></td><td align='right'><a href='thisone.php?$aid'>Dieses</a></td></tr>";
   echo "</table>";
             }
             }


echo "</div>";
echo "</section>";

include('footer.php');
        ?>
</body>
</html>