<?php
require 'requiresLogin.php';
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
<table>


<p>Wenn du wirklich deinen Auftrag wiedereinstellen möchtest, dann drücke den untenstehenden Button!</p>

 <?php
 $id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

$request = $mysqli->query("SELECT aid, userkennungA, userkennungT, gegenstand, price, hight, width, depth, info, city, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate, price FROM finale WHERE id=$id");
while($row = mysqli_fetch_object($request))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td rowspan='12'align='right'>";
   echo "<tr><td></td><td><b>Gegenatnd: </b></td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td></td><td><b>Max. Preis: </b></td>";
   echo "<td>$row->price $</td></tr>";
   echo "<tr><td>Ca. Maße:</td>";
   echo "<td>$row->hight x $row->width x $row->depth</td></tr>";
   echo "<tr><td colspan='2'><b>Start-Adresse</b></td></tr>";
   echo "<tr><td>Stadt</td>";
   echo "<td>$row->city</td>";
   echo "<td>Strasse</td>";
   echo "<td>$row->str</td></tr>";
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->plz</td>";
   echo "<td>Land:</td>";
   echo "<td>$row->land</td></tr>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td></td></tr>";
   echo "<tr><td colspan='2'><b>Ziel-Adresse</b></td></tr>";
   echo "<tr><td>Stadt</td>";
   echo "<td>$row->arrcity</td>";
   echo "<td>Strasse</td>";
   echo "<td>$row->arrstr</td></tr>";
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->arrplz</td>";
   echo "<td>Land:</td>";
   echo "<td>$row->arrland</td></tr>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->arrdate</td></tr>";
   echo "<tr><td>Zusätzliche Info:</td>";
   echo "<td>$row->info</td></tr></br>";
   $id = "$row->aid";
   $userkennung = "$row->userkennungA";
   $userkennungT = "$row->userkennungT";
   echo "</table>";

   echo "<form name='Formular' action='requests.php' method='post'>";
   echo "<input type='hidden' name='id' value='$id'>";
    echo "<input type='hidden' name='userkennung' value='$userkennung'>";
    echo "<input type='hidden' name='userkennungT' value='$userkennungT'>";
    echo "<input type='hidden' name='gegenstand' value='$row->gegenstand'>";
    echo "<input type='hidden' name='price' value='$row->price'>";
    echo "<input type='hidden' name='hight' value='$row->hight'>";
    echo "<input type='hidden' name='width' value='$row->width'>";
    echo "<input type='hidden' name='depth' value='$row->depth'>";
    echo "<input type='hidden' name='info' value='$row->info'>";
    echo "<input type='hidden' name='str' value='$row->str'>";
    echo "<input type='hidden' name='city' value='$row->city'>";
    echo "<input type='hidden' name='plz' value='$row->plz'>";
    echo "<input type='hidden' name='land' value='$row->land'>";
    echo "<input type='hidden' name='date' value='$row->date'>";
    echo "<input type='hidden' name='arrcity' value='$row->arrcity'>";
    echo "<input type='hidden' name='arrstr' value='$row->arrstr'>";
    echo "<input type='hidden' name='arrplz' value='$row->arrplz'>";
    echo "<input type='hidden' name='arrland' value='$row->arrland'>";
    echo "<input type='hidden' name='arrdate' value='$row->arrdate'>";
     echo "<table>";
    echo "<tr><td><input type='submit' name='submit' value='Wiedereinstellen'></td></tr>";
    echo "</table>";
           }

           echo "</section>";

       include('footer.php');
           ?>
</body>
</html>