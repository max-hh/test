<?php
require 'car.requiresLogin.php';
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

  <section class="container">
    <div class="main">
 <?php

 session_start();

$user = $_SESSION['car.user'];
$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);


 $request = $mysqli->query("SELECT id, userkennung, gegenstand, price, hight, width, depth, info, city, plz, land, date, arrcity, arrplz, arrland, arrdate FROM request WHERE id=$id");
while($row = mysqli_fetch_object($request))
   {
       $user= "$row->userkennung";

   $result = $mysqli->query("SELECT firstname, image FROM user WHERE username='".$user."'");
   $rows = mysqli_fetch_object($result);
   {
   $firstname = "$rows->firstname";
   $image = "$rows->image";
   }
   if($image==''){
     $image = 'alt_profil.png';
     }
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td>User:</td>";
   echo "<td>$firstname</td>";
   echo "<td><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td>";


   $sql = "SELECT sum(value) as summe FROM userreview WHERE user='".$user."'";
   $res= $mysqli->query($sql);
    $s = $res->fetch_object();

   $req= $mysqli->query("SELECT value FROM userreview WHERE user='".$user."'");
   $num = $row_cnt = $req->num_rows;
    if($s->summe != 0) {
   $val= $s->summe/$num;

   $user = encrypt($user, $key);
                 if ($val == 1) {
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/one_star.png'/></a></td>";
                } elseif($val <= 1.5) {
                           echo "<td><a href='userreviewover.php?$user'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 2) {
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val <= 2.5){
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 3) {
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/three_star.png'/></a></td>";
                } elseif ($val <= 3.5){
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/three_star.png'/></a></td>";
                }elseif ($val == 4){
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/four_star.png'/></a></td>";
                } elseif ($val <= 4.5){
                        echo "<td><a href='userreviewover.php?$user'><img src='rating/four_star.png'/></a></td>";
                }elseif ($val <= 5){
                        echo  "<td><a href='userreviewover.php?$user'><img src='rating/five_star.png'/></a></td>";
        }
        $p='5';
        $pro=$val/$p*100;
        $pro=round($pro , 2);

   echo "<td>$pro%</td></tr>";
   }else{
        echo "<td>Zurzeit existiert keine Bewertung</td></tr>";
        }
   echo "<tr><td></td><td><b>GEGENSTAND: </b></td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td></td><td><b>Max. TRANSPORT-PREIS </b></td>";
   echo "<td>$row->price &euro;</td></tr>";
   echo "<tr><td>SIZE:</td>";
   echo "<td>$row->hight x $row->width x $row->depth</td></tr>";
   echo "<tr><td colspan='2'><b>START-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT</td>";
   echo "<td>$row->city</td>";
   echo "<td>PLZ:</td>";
   echo "<td>$row->plz</td></tr>";
   echo "<tr><td>LAND:</td>";
   echo "<td>$row->land</td>";
   echo "<td>DATUM:</td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td colspan='2'><b>ZIEL-ADRESSE</b></td></tr>";
   echo "<tr><td>STADT</td>";
   echo "<td>$row->arrcity</td>";
   echo "<td>PLZ:</td>";
   echo "<td>$row->arrplz</td></tr>";
   echo "<tr><td>LAND:</td>";
   echo "<td>$row->arrland</td>";
   echo "<td>DATUM:</td>";
   echo "<td>$row->arrdate</td></tr></br>";
   echo "<td>INFO</td>";
   $info = "$row->info";
   $info = utf8_encode($info);
   echo "<td colspan='2'>$info</td></tr>";
   $userkennung= "$row->userkennung";
   $_SESSION['userkennung'] = $userkennung;

   $id= "$row->id";
   $_SESSION['id']= $id;
   }
   echo "<tr><td><a href='market.php'>Zur&uuml;ck</a></td><td><a href='car.message.php'>Kontakt</a></td><td><a href='car.thisone.php'>Take it!</a></td></tr>";
   echo "</table>";


      echo "</div>";
    echo "</section>";
include('footer.php');

?>
</body>
</html>