<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'requiresLogin.php';
include('userheader.php');
require 'sec.php';
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

 <?php
  $user = $_SESSION['user'];


$request = $mysqli->query("SELECT aid, userkennungA, gegenstand, price, hight, width, depth, info, city, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate, userkennungT, fahrzeug, licence, start, startdate, ziel, tarrdate FROM temporary WHERE userkennungA='".$user."'");
if (!$row_cnt = $request->num_rows){
echo " </br> You have no open request right now!";
}else{
while($row = mysqli_fetch_object($request))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   $userkennungA = "$row->userkennungA";

   $result = $mysqli->query("SELECT firstname, image FROM user WHERE username='".$userkennungA."'");
   $rows = mysqli_fetch_object($result);
   {
   $firstnameA = "$rows->firstname";
   $image = "$rows->image";
   }
   if($image==''){
     $image = 'alt_profil.png';
     }
   echo "<tr><td></td><td>USER:</td>";
   echo "<td>$firstnameA</td>";
   echo "<td><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td>";

   $sql = "SELECT sum(value) as summe FROM userreview WHERE user='".$userkennungA."'";
   $res= $mysqli->query($sql);
    $s = $res->fetch_object();

   $req= $mysqli->query("SELECT value FROM userreview WHERE user='".$userkennungA."'");
   $num = $row_cnt = $req->num_rows;
    if($s->summe != 0) {
   $val= $s->summe/$num;
                 if ($val == 1) {
                        echo "<td><img src='rating/one_star.png'/></a></td>";
                } elseif($val <= 1.5) {
                           echo "<td><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 2) {
                        echo "<td><img src='rating/two_star.png'/></a></td>";
                } elseif ($val <= 2.5){
                        echo "<td><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 3) {
                        echo "<td><img src='rating/three_star.png'/></a></td>";
                } elseif ($val <= 3.5){
                        echo "<td><img src='rating/three_star.png'/></a></td>";
                }elseif ($val == 4){
                        echo "<td><img src='rating/four_star.png'/></a></td>";
                } elseif ($val <= 4.5){
                        echo "<td><img src='rating/four_star.png'/></a></td>";
                }elseif ($val <= 5){
                        echo  "<td><img src='rating/five_star.png'/></a></td>";
        }
        $p='5';
        $pro=$val/$p*100;

   echo "<td>$pro%</td></tr>";
   }else{
        echo "<td>Zurzeit existiert keine Bewertung</td></tr>";
        }
   echo "<tr><td></td><td>GEGENSTAND:</td>";
   echo "<td><b>$row->gegenstand</b></td></tr>";
   echo "<tr><td>MAX. PREIS:</td>";
   echo "<td><b>$row->price &euro;</b></td></tr>";
   echo "<tr><td>SIZE:</td>";
   echo "<td colspan='2'><b>$row->hight x $row->width x $row->depth</b></td></tr>";
   echo "<tr></tr>";
   echo "<tr><td colspan='2'><b>START-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT:</td>";
   echo "<td><b>$row->city</b></td>";
   echo "<td>STRASSE:</td>";
   $str = "$row->str";
   $str = utf8_encode($str);
   echo "<td colspan='2'><b>$str</b></td></tr>";
   echo "<td>PLZ:</td>";
   echo "<td><b>$row->plz</b></td>";
   echo "<td>LAND:</td>";
   echo "<td><b>$row->land</b></td>";
   echo "<td>DATUM:</td>";
   echo "<td><b>$row->date</b></td></tr>";
   echo "<tr><td colspan='2'><b>ZIEL-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT:</td>";
   echo "<td><b>$row->arrcity</b></td>";
   echo "<td>STRASSE:</td>";
   $arrstr = "$row->arrstr";
   $arrst = utf8_encode($arrstr);
   echo "<td colspan='2'><b>$arrstr</b></td></tr>";
   echo "<tr><td>PLZ:</td>";
   echo "<td>$row->arrplz</td>";
   echo "<td>LAND:</td>";
   echo "<td><b>$row->arrland</b></td>";
   echo "<td>DATUM:</td>";
   echo "<td><b>$row->arrdate</b></td></tr>";
   echo "<tr><td>INFOS:</td>";
   $info = "$row->info";
   $info = utf8_encode($info);
   echo "<td>$info</td></tr></br>";
   echo "<tr><td></br></td></tr>";
   $aid = "$row->aid";
   $userkennungT = "$row->userkennungT";

$res = $mysqli->query("SELECT firstname, image FROM carrier WHERE user='".$userkennungT."'");
while($rows = mysqli_fetch_object($res))
   {
   $firstnameT = "$rows->firstname";
   $image = "$rows->image";
   }
   if($image==''){
     $image = 'alt_profil.png';
     }
   echo "<tr><td></td><td>FAHRER:</td>";
   echo "<td><b>$firstnameT</b></td>";
   echo "<td><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td>";

   $sql = "SELECT sum(value) as summe FROM review WHERE user='".$userkennungT."'";
   $res= $mysqli->query($sql);
    $s = $res->fetch_object();

   $req= $mysqli->query("SELECT value FROM review WHERE user='".$userkennungT."'");
   $num = $row_cnt = $req->num_rows;
   if($s->summe != 0) {
   $val= $s->summe/$num;
   $userT = encrypt($userkennungT, $key);
                 if ($val == 1) {
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/one_star.png'/></a></td>";
                } elseif($val <= 1.5) {
                           echo "<td><a href='reviewover.php?$userT><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 2) {
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val <= 2.5){
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 3) {
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/three_star.png'/></a></td>";
                } elseif ($val <= 3.5){
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/three_star.png'/></a></td>";
                }elseif ($val == 4){
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/four_star.png'/></a></td>";
                } elseif ($val <= 4.5){
                        echo "<td><a href='reviewover.php?$userT'><img src='rating/four_star.png'/></a></td>";
                }elseif ($val <= 5){
                        echo  "<td><a href='reviewover.php?$userT'><img src='rating/five_star.png'/></a></td>";
        }
        $p='5';
        $pro=$val/$p*100;

   echo "<td>$pro%</td></tr>";
    }else {
         echo "<td>Zurzeit existiert keine Bewertung</td></tr>";
         }
   echo "<tr><td>FAHRZEUG:</td>";
   echo "<td><b>$row->fahrzeug</b></td>";
   echo "<td>KENNZEICHEN</td>";
   echo "<td><b>$row->licence</b></td></tr>";
   echo "<tr><td colspan='2'><b>START-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT:</td>";
   echo "<td><b>$row->start</b></td>";
   echo "<td>DATUM:</td>";
   echo "<td><b>$row->startdate</b></td></tr>";
   echo "<tr><td colspan='2'><b>ZIEL-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT:</td>";
   echo "<td><b>$row->ziel</b></td>";
   echo "<td>DATUM:</td>";
   echo "<td><b>$row->tarrdate</b></td></tr>";
   $userkennungT = "$row->userkennungT";
   $fahrzeug = "$row->fahrzeug";
   $licence = "$row->licence";
   $start = "$row->start";
   $startdate = "$row->startdate";
   $ziel = "$row->ziel";
   $tarrdate = "$row->tarrdate";

   echo "<form name='Formular' action='summary.php' method='post'>";
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
    echo "<input type='hidden' name='fahrzeug' value='$fahrzeug'>";
    echo "<input type='hidden' name='licence' value='$licence'>";
    echo "<input type='hidden' name='start' value='$start'>";
    echo "<input type='hidden' name='startdate' value='$startdate'>";
    echo "<input type='hidden' name='ziel' value='$ziel'>";
    echo "<input type='hidden' name='tarrdate' value='$tarrdate'>";
    echo "</table>";
    $aid = encrypt($aid, $key);
    $toUser= encrypt ($userkennungT, $key);
     echo "<table style='width:100%'>";
    echo "<tr><td><p><a href='message.php?$toUser'>KONTAKT</a></td><td></td><td><a href='decline.php?$aid'>ABLEHNEN</a></td><td></td><td align='right'><input type='submit' name='submit' value='AKZEPTIREREN'></td></tr>";
    echo "</table>";
           }
           }
         $_SESSION['userkennungA'] = $userkennungA ;
         $_SESSION['userkennungT'] = $userkennungT;


   echo "</div>";
   echo "</section>";
include('footer.php');
?>

</body>
</html>