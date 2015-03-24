<?php
require_once 'car.requiresLogin.php';
require 'accept.php';
require 'temp.delete.php';
require 'del.php';
require 'rev.php';
include('header.php');
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
   echo "<h1>Summary</h1>";
   echo "<p>The Summery shows all of your Contracts</p>";
   echo "</div>";

$user = $_SESSION['car.user'];


$result = $mysqli->query("SELECT id, userkennungA, userkennungT, gegenstand, price, hight, width, depth, info, city, str, date, arrcity, arrstr, arrdate, licence, start, ziel, startdate, tarrdate FROM finale WHERE userkennungT='".$user."'");
if (!$row_cnt = $result->num_rows){
echo '</br>You have no contracts right now';
}else{
while($row = mysqli_fetch_object($result))
      {
   $userkennungT ="$row->userkennungT";
   $userkennungA ="$row->userkennungA";

   $result = $mysqli->query("SELECT firstname, image FROM user WHERE username='".$userkennungA."'");
   $rows = mysqli_fetch_object($result);
   {
   $firstnameA = "$rows->firstname";
   $image = "$rows->image";
   }
   if($image==''){
     $image = 'alt_profil.png';
     }


   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td></td><td colspan='2'><b>Item</b></td></tr>";
   echo "<tr><td></td><td>User:</td>";
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

   $userA = encrypt($userkennungA, $key);
                 if ($val == 1) {
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/one_star.png'/></a></td>";
                } elseif($val <= 1.5) {
                           echo "<td><a href='userreviewover.php?$userA><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 2) {
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val <= 2.5){
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 3) {
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/three_star.png'/></a></td>";
                } elseif ($val <= 3.5){
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/three_star.png'/></a></td>";
                }elseif ($val == 4){
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/four_star.png'/></a></td>";
                } elseif ($val <= 4.5){
                        echo "<td><a href='userreviewover.php?$userA'><img src='rating/four_star.png'/></a></td>";
                }elseif ($val <= 5){
                        echo  "<td><a href='userreviewover.php?$userA'><img src='rating/five_star.png'/></a></td>";
        }
                 $p='5';
        $pro=$val/$p*100;
        $pro=round($pro , 2);

   echo "<td>$pro%</td></tr>";
   }else{
        echo "<td>Zurzit existiert keine Bewertung</td></tr>";
        }
   echo "<tr><td></td><td>GEGENSTAND: </td>";
   echo "<td>$row->gegenstand</td>";
   echo "<td>PREIS: </td>";
   echo "<td><b>$row->price &euro</b></td></tr>";
   echo "<tr><td>SIZE:</td>";
   echo "<td>$row->hight x $row->width x $row->depth</td></tr>";
   echo "<tr><td>START:</td>";
   echo "<td><b>$row->city</b></td>";
   echo "<td>STRASSE</td>";
   $str = "$row->str";
   $str = utf8_encode($str);
   echo "<td><b>$str</b></td>";
   echo "<td>START-DATUM</td>";
   echo "<td><b>$row->date</b></td></tr>";
   echo "<tr><td>ZIEL:</td>";
   echo "<td><b>$row->arrcity</b></td>";
   echo "<td>STRASSE:</td>";
   $arrstr = "$row->arrstr";
   $arrstr = utf8_encode($arrstr);
   echo "<td><b>$arrstr</b></td>";
   echo "<td>ANKUNFT-DATUM</td>";
   echo "<td><b>$row->arrdate</b></td></tr>";
   echo "<td>INFO</td>";
   $info = "$row->info";
   $info = utf8_encode($info);
   echo "<td colspan='2'>$info</td></tr>";

     $res = $mysqli->query("SELECT firstname, image FROM carrier WHERE user='".$user."'");
while($rows = mysqli_fetch_object($res))
   {
   $firstnameT = "$rows->firstname";
  $image = "$rows->image";
   }
   if($image==''){
     $image = 'alt_profil.png';
     }

   echo "<tr><td></td><td><b>Fahrer</b></td>";
   echo "<td>$firstnameT</td>";
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
        $pro=round($pro , 2);

   echo "<td>$pro%</td></tr>";
        }else{
        echo "<td>currently no review exist</td></tr>";
        }
   echo "<td>KENNZEICHEN:</td>";
   echo "<td><b>$row->licence</b></td></tr>";
   echo "<td>START:</td>";
   echo "<td><b>$row->start</b></td>";
   echo "<td>START-DATUM:</td>";
   echo "<td><b>$row->startdate</b></td></tr>";
   echo "<tr><td>ZIEL:</td>";
   echo "<td><b>$row->ziel</b></td>";
   echo "<td>ANKUNFT DATUM:</td>";
   echo "<td><b>$row->tarrdate</b></td></tr>";
    $aid = "$row->id";

    $id = encrypt($aid, $key);
    $toUser = encrypt($userkennungA, $key);

   echo "<tr><td><a href ='userreview.php?$id'>Bewerten</a></td><td><a href='car.message.php?$toUser'>Kontakt</a></td></tr>";
   echo "</table></br>";

   $_SESSION['userkennungT'] = $userkennungT;
   $_SESSION['userkennungA'] = $userkennungA;

                    }
 }




    echo "</section>";
include('footer.php');

?>
</body>
</html>