<?php
require_once 'car.requiresLogin.php';
require 'rev.php';
require 'sec.php';
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
  <link href='rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

<section class="container">
  <div class="main">
   <h1>Bewertungs&uuml;berblick</h1>
   </div>
 <?php
$user = $_SERVER['QUERY_STRING'];
$user = decrypt($user, $key);

   $res = $mysqli->query("SELECT firstname, image FROM user WHERE username='".$user."'");
   $rows = mysqli_fetch_object($res);
   {
   $firstname = "$rows->firstname";
   $image = "$rows->image";
   }

echo "<table>";
echo "<tr><td><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td></tr>";
echo "<tr><td><b>$firstname :</b></td>";



$res = $mysqli->query("SELECT sum(value) FROM userreview WHERE user='".$user."'");
$s=current(mysqli_fetch_assoc($res));


$req= $mysqli->query("SELECT * FROM userreview WHERE user='".$user."'");
$num = mysqli_num_rows($req);
 $val= $s/$num;

                 if($val == 1) {
                        echo " <td><img src='rating/one_star.png'/></td>";
                } elseif($val <= 1.5) {
                           echo " <img src='rating/two_star.png'/></td>";
                } elseif ($val == 2){
                        echo " <td><img src='rating/two_star.png'/></td>";
                } elseif ($val <= 2.5){
                        echo "<td><img src='rating/two_star.png'/></td>";
                } elseif ($val == 3) {
                        echo "<td><img src='rating/three_star.png'/></td>";
                } elseif ($val <= 3.5){
                        echo "<td><img src='rating/three_star.png'/></td>";
                }elseif ($val == 4){
                        echo "<td><img src='rating/four_star.png'/></td>";
                } elseif ($val <= 4.5){
                        echo "<td><img src='rating/four_star.png'/></td>";
                }elseif ($val <= 5){
                        echo "<td><img src='rating/five_star.png'/></td>";
        }
        $p='5';
        $pro=$val/$p*100;

   echo "<td>$pro%</td></tr>";
  echo "</table></br>";

 while($row = mysqli_fetch_object($req))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td></td><td colspan='2'><b></b></td></tr>";
   echo "<tr><td></td><td> Stars: </td>";
   $value = "$row->value";
   if($value == 1) {
   echo "<td><img src='rating/one_star.png'/></td></tr>";
   } elseif ($value == 2){
   echo "<td><img src='rating/two_star.png'/></td></tr>";
   } elseif ($value == 3) {
   echo "<td><img src='rating/three_star.png'/></td></tr>";
   }elseif ($value == 4){
   echo "<td><img src='rating/four_star.png'/></td></tr>";
   }elseif ($value == 5){
   echo "<td><img src='rating/five_star.png'/></td></tr>";
        }
   echo "<tr><td></td><td> Title: </td>";
   echo "<td> $row->title </td><td></td></tr>";
   echo "<tr><td></td><td> Bewertungs-Text: </td>";
   echo "<td> $row->reviewtext </td><td></td></tr>";
   echo "</table></br>";
   }

   echo "</div>";
   echo "</section>";

include('footer.php');
 ?>




</body>
</html>