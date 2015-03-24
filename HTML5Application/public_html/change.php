<?php
error_reporting(E_ALL ^ E_NOTICE);
require 'requiresLogin.php';
require 'config3.php';
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
$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);


$_SESSION['user'];
$user =$_SESSION['user'];

$change = $mysqli->query("SELECT id, gegenstand, price, city, hight, width, depth, info, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate FROM request WHERE id=$id");
while($row = mysqli_fetch_object($change))
   {
   $id = "$row->id";
   $_SESSION['id'] = $id;

   $id = encrypt($id, $key);

   echo "<form name='Formular' action='auftrag_details?$id' method='post' >";
   echo "<h1>Bearbeite deinen Auftrag</h1>";
   echo "<table cellpadding='5'>";
   echo "<tr><td><input type='text' name='gegenstand' value='$row->gegenstand' placeholder='Gegenstand'></td></tr>";
   echo "<tr><td><input type='text' name='price' value='$row->price' placeholder='Max. Transport-Preis'></td></tr>";
   echo "</table>";
   echo "<table>";
   echo "<tr><td>SIZE</td></tr>";
   echo "<tr><td><select name='hight'><option value='$row->hight'>$row->hight</option><option value='<50'> < 50</option><option value='50-100'>50-100</option>
   <option value='100-150'>100-150</option><option value='150-200'>150-200</option><option value='200-250'>200-250</option>
   <option value='250-300'>250-300</option><option value='300-350'>300-350</option><option value='350-400'>350-400</option>
   <option value='>400'> > 400</option></select></td>
   <td><select name='width'><option value='$row->width'>$row->width</option><option value='<50'> < 50</option><option value='50-100'>50-100</option>
   <option value='100-150'>100-150</option><option value='150-200'>150-200</option><option value='200-250'>200-250</option>
   <option value='250-300'>250-300</option><option value='300-350'>300-350</option><option value='350-400'>350-400</option>
   <option value='>400'> > 400</option></select></td>
   <td><select name='depth'><option value='$row->depth'>$row->depth</option><option value='<50'> < 50 </option><option value='50-100'>50-100</option>
   <option value='100-150'>100-150</option><option value='150-200'>150-200</option><option value='200-250'>200-250</option>
   <option value='250-300'>250-300</option><option value='300-350'>300-350</option><option value='350-400'>350-400</option>
   <option value='>400'> > 400</option></select></td></tr></table>";
   echo "<tr><td><p>START-ADRESSE</p></td></tr>";
   echo "<tr><td><input type='text' name='city' value='$row->city' placeholder='Stadt'></td></tr>";
   echo "<tr><td><input type='text' name='str' value='$row->str' placeholder='Strasse'></td></tr>";
   echo "<tr><td><input type='text' name='plz' value='$row->plz' placeholder='PLZ'></td></tr>";
   echo "<tr><td><input type='text' name='land' value='$row->land' placeholder='Land'></td></tr>";
   echo "<tr><td><input type='text' name='date' value='$row->date' placeholder='Datum'></td></tr>";
   echo "<tr><td><p>ZIEL</p></td></tr>";
   echo "<tr><td><input type='text' name='arrcity' value='$row->arrcity' placeholder='Stadt'></td></tr>";
   echo "<tr><td><input type='text' name='arrstr' value='$row->arrstr' placeholder='Strasse'></td></tr>";
   echo "<tr><td><input type='text' name='arrplz' value='$row->arrplz' placeholder='PLZ'></td></tr>";
   echo "<tr><td><input type='text' name='arrland' value='$row->arrland' placeholder='Land'></td></tr>";
   echo "<tr><td><input type='text' name='arrdate' value='$row->arrdate' placeholder='Datum'></td></tr>";
   echo "<tr><td><p>ZUS&Auml;TZLICHE INFOS</p></td></tr>";
   echo "<tr><td><input type='textarea' name='info' value='$row->info' placeholder='info'></td></tr>";
   echo "<tr><td><input type='submit' name='submitButton' value='&Auml;ndern!'></td></tr>";
   echo "</table>";
   }

  echo "</div>";
   echo "</section>";
include('footer.php');
   ?>
</body>
</html>