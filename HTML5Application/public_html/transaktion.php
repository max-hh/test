<?php
require_once 'car.requiresLogin.php';
require 'config9.php';
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
  <title>Auftr&auml;ge</title>
  <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
 <body>

  <section class="container">
  <div class="main">
   <h1>Transactions</h1>
      </div>

<a href="car.profil.php">Back</a>
<form action="#" method="post">
<select name="placed">
<option value="">Wähle ein Jahr</option>
<option value="2015">2015</option>
<option value="2016-02-27">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
</select>
<input type="submit" name="submit" value="Order" />
</form>
<a href="print.php" target="_blank">Druck es</a></br>

<?php
$user = $_SESSION['car.user'];
if(isset($_POST['submit'])){
$suchwort = $_POST['placed'];
echo "You have selected :" .$suchwort;
$abfrage = "";
                                        {
                                                $abfrage .= "`placed` LIKE '%$suchwort%'";

                                        }


$result = $mysqli->query("SELECT id, userkennungA, gegenstand, city, date, arrcity, arrdate, price, placed FROM finale WHERE userkennungT ='".$user."' AND" .$abfrage);
if (!$row_cnt = $result->num_rows){
echo "</br>You have no transactions in your selected year </br><a href='transaktion.php'>See all</a>";
}else{
while($row = mysqli_fetch_object($result))
      {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid black'>";
   echo "<tr><td rowspan='12'align='right'>";
   echo "<tr><td></td><td>User:</td>";
   echo "<td>$row->userkennungA</td></tr>";
   echo "<tr><td></td><td>Gegenstand: </td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td>Start-Stadt:</td>";
   echo "<td>$row->city</td>";
   echo "<td>Start-Datum:</td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td>Ziel :</td>";
   echo "<td>$row->arrcity</td>";
   echo "<td>Ankunfts-Datum:</td>";
   echo "<td>$row->arrdate</td></tr>";
   echo "<tr><td>Verdienst:</td>";
   echo "<td>$row->price $</td>";
   echo "<td>Akzeptiert:</td>";
   echo "<td>$row->placed</td></tr>";
   echo "</table></br>";

 }
 }
}

if(!isset($_POST["submit"])) {
$result = $mysqli->query("SELECT id, userkennungA, gegenstand, city, date, arrcity, arrdate, price, placed FROM finale WHERE userkennungT='".$user."'");
if (!$row_cnt = $result->num_rows){
echo '</br>You have no transactions right now';
}else{
while($row = mysqli_fetch_object($result))
      {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid black'>";
   echo "<tr><td rowspan='12'align='right'>";
   echo "<tr><td></td><td>User:</td>";
   echo "<td>$row->userkennungA</td></tr>";
   echo "<tr><td></td><td>Gegenstand: </td>";
   echo "<td>$row->gegenstand</td></tr>";
   echo "<tr><td>Start-Stadt:</td>";
   echo "<td>$row->city</td>";
   echo "<td>Start-Datum:</td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td>Ziel :</td>";
   echo "<td>$row->arrcity</td>";
   echo "<td>Ankunfts-Datum:</td>";
   echo "<td>$row->arrdate</td></tr>";
   echo "<tr><td>Verdienst:</td>";
   echo "<td>$row->price $</td>";
   echo "<td>Akzeptiert:</td>";
   echo "<td>$row->placed</td></tr>";
   echo "</table></br>";

 }
 }
  }


 ?>
          </section>
  <div class="footer">
       <p><a href="impressum.hmtl">Imprint</a> <a href="agb.html" >AGB's</a> <a href="about.html">About Us</a></p>
       </div>
       </body>
       </html>