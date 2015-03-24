<?php
require_once 'requiresLogin.php';
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
   <section class="container">
  <div class="main">
<?php
 $id=$_GET['id'];

$result = $mysqli->query("SELECT id, userkennungA, userkennungT, gegenstand, price, arrcity, arrstr, arrdate FROM finale WHERE id=$id");
while($row = mysqli_fetch_object($result))
      {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td></td><td><b>Payment Infos</b></td></tr>";
   echo "<tr><td>Item:</td>";
   echo "<td>$row->gegenstand</td></tr>";
   $item = "$row->gegenstand";
   echo "<tr><td>Price:</td>";
   echo "<td>$row->price $</td></tr>";
   $price = "$row->price";
   echo "<tr><td>Carrier:</td>";
   echo "<td>$row->userkennungT</td></tr>";
   $userkennung = "$row->userkennungT";
   echo "<tr><td>Shipt to:</td>";
   echo "<td>$row->arrstr</td><td>$row->arrcity</td></tr>";
   echo "</table></br>";
   }
$request = $mysqli->query("SELECT email FROM carrier WHERE user='".$userkennung."'");
while($row = mysqli_fetch_object($request))
      {
      $mail = "$row->email";

      }


echo "<form name='paypalForm' action='paypal.php' method='post'>";
echo "<input type='hidden' name='id' value='$id'>";
echo "<input type='hidden' name='CatDescription' value='$item'>";
echo "<input type='hidden' name='payment' value='$price'>";
echo "<input type='hidden' name='key' value='md5(date('Y-m-d:').rand())'>";
echo "<input type='hidden' name='recipient' value=$mail'>";
echo "<input type='submit' name='paypal'  value='Pay via Paypal' >";
echo "</form>";

  echo "</div>";
  echo "</section>";
include('footer.php');
 ?>
</body>
</html>
