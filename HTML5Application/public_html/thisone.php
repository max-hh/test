<?php
require 'car.requiresLogin.php';
require('userheader.php');
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
 <?php
  echo "<section class='container'>";
  echo "<div class='main'>";


$user = $_SESSION['user'];
$id = $_SESSION['id'];

$request = $mysqli->query("SELECT id, userkennung, fahrzeug, licence, start, startdate, ziel, tarrdate FROM transport WHERE id=$id");
while($row = mysqli_fetch_object($request))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   $userkennung = "$row->userkennung";

   $res = $mysqli->query("SELECT firstname, image FROM carrier WHERE user='".$userkennung."'");
   $rows = mysqli_fetch_object($res);
   {
   $firstname = "$rows->firstname";
      $image = "$rows->image";
   }
   if($image==''){
     $image = 'alt_profil.png';
     }
   echo "<tr><td>Transporteur</td>";
   echo "<td>$firstname</td>";
    echo "<td><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td>";
   $sql = "SELECT sum(value) as summe FROM review WHERE user='".$userkennung."'";
   $res= $mysqli->query($sql);
    $s = $res->fetch_object();

   $req= $mysqli->query("SELECT value FROM review WHERE user='".$userkennung."'");

    $userkennung = encrypt($userkennung, $key);

   $num = $row_cnt = $req->num_rows;
    if($s->summe != 0) {
   $val= $s->summe/$num;
                 if ($val == 1) {
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/one_star.png'/></a></td></tr>";
                } elseif($val <= 1.5) {
                           echo "<td><a href='reviewover.php?$userkennung><img src='rating/two_star.png'/></a></td></tr>";
                } elseif ($val == 2) {
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/two_star.png'/></a></td></tr>";
                } elseif ($val <= 2.5){
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/two_star.png'/></a></td></tr>";
                } elseif ($val == 3) {
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/three_star.png'/></a></td></tr>";
                } elseif ($val <= 3.5){
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/three_star.png'/></a></td></tr>";
                }elseif ($val == 4){
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/four_star.png'/></a></td></tr>";
                } elseif ($val <= 4.5){
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/four_star.png'/></a></td></tr>";
                }elseif ($val <= 5){
                        echo  "<td><a href='reviewover.php?$userkennung'><img src='rating/five_star.png'/></a></td></tr>";
        }
        }else{
        echo "<td>zurzeit existiert keine Bewertung</td></tr>";
        }
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
   echo "</table>";
   $userkennungT = "$row->userkennung";
   $fahrzeug = "$row->fahrzeug";
   $licence = "$row->licence";
   $start = "$row->start";
   $startdate = "$row->startdate";
   $ziel = "$row->ziel";
   $tarrdate = "$row->tarrdate";
           }

$aid = $_SERVER['QUERY_STRING'];
$aid = decrypt($aid, $key);

$result = $mysqli->query("SELECT id, userkennung, gegenstand, price, hight, width, depth, info, city, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate FROM request WHERE id=$aid");
while($row = mysqli_fetch_object($result))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td></td><td><b>Gegenstand: </b></td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td></td><td><b>Max. Preis: </b></td>";
   echo "<td>$row->price $</td></tr>";
   echo "<tr><td>Size:</td>";
   echo "<td>$row->hight x $row->width x $row->depth</td></tr>";
   echo "<tr><td colspan='2'><b>Start-Adresse</b></td></tr>";
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
   echo "<td>$row->info</td></tr></br>";
   $aid = "$row->id";
   $userkennungA = "$row->userkennung";
   echo "</table>";

 echo "<form name='Formular' action='tmarket.php' method='post'>";
   echo "<input type='hidden' name='aid' value='$aid'>";
    echo "<input type='hidden' name='userkennungA' value='$userkennungA'>";
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
    echo "<input type='hidden' name='info' value='$row->info'>";
    echo "<input type='hidden' name='fahrzeug' value='$fahrzeug'>";
    echo "<input type='hidden' name='licence' value='$licence'>";
    echo "<input type='hidden' name='start' value='$start'>";
    echo "<input type='hidden' name='startdate' value='$startdate'>";
    echo "<input type='hidden' name='ziel' value='$ziel'>";
    echo "<input type='hidden' name='tarrdate' value='$tarrdate'>";
    echo "<table>";
    echo "<tr><td align='right'><input type='submit' name='submit' value='Anfrage senden'></td></tr>";
    echo "</table>";
           }

 ?>