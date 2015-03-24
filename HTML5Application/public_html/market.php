<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'car.requiresLogin.php';
require 'config6.php';
include('header.php');
include('sec.php');

$user = $_SESSION['car.user'];

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
echo "<div class='login'>";
echo "<form action='' method='post'>";
echo "<table>";
echo "<tr><td><input type='text' name='search' placeholder='Suche nach der Stadt, PLZ oder Datum'></td>";
echo "<td><input type='submit' value='Search' /></td></tr>";
echo "</table>";

   echo "<a href='car.home.php'>Auf der Karte zeigen</a>";
    echo  "</br>";
    if($setFailed){
     echo "</br>";
    echo "Du hast breist einen Anfrage an den User geschickt!";
     echo "</br>";
    }
     if($set){
     echo "</br>";
    echo "Danke, dass du eine Anfrage an diesen User geschickt hast!";
     echo "</br>";
    }

    session_start();
$_SESSION['userkennung'];


  if(isset($_POST["search"])) {
  $suchwort = $_POST["search"];
  $suchwort = explode(" ", $suchwort);
  $abfrage = "";
  $abfrage2 = "";
  $abfrage3 = "";
  for($i = 0; $i < sizeof($suchwort); $i++)
                                        {
                                                $abfrage .= "`plz` LIKE '$suchwort[$i]'";
                                                $abfrage2 .= "`city` LIKE '$suchwort[$i]'";
                                                $abfrage3 .= "`date` LIKE '$suchwort[$i]'";

                                        }
$id=$_GET['id'];

echo "<a href='market.php'>Alle zeigen</a>";
$request = $mysqli->query("SELECT id, gegenstand, city, plz, date FROM request WHERE" .$abfrage. "OR" .$abfrage2. "OR" .$abfrage3);
    while($row = mysqli_fetch_object($request))
        {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td rowspan='8'align='right'>";
   echo "<tr><td></td><td><b>Gegenstand:</b></td>";
   echo "<td colspan='2'>$row->gegenstand</td></tr>";
   echo "<tr><td colspan='2'><b>START-ASRESSE</b></td></tr>";
   echo "<tr><td>Stadt</td>";
   echo "<td>$row->city</td>";
   echo "<td>PLZ:</td>";
   echo "<td>$row->plz</td></tr>";
   echo "<tr><td>Datum:</td></td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td></td></tr>";
   $id = "$row->id";
   $id = encrypt($id, $key);
   echo "<tr><td></td><td><td></td></td><td></td><td align='right'><a href='details.php?$id'>Details</a></td></tr>";
   echo "</br></table>";
            }
            }


 if(!isset($_POST["search"])) {
$request = $mysqli->query("SELECT id, gegenstand, city, plz, date FROM request");
if (!$row_cnt = $request->num_rows){
echo '</br>Wir entschuldigen uns bei dir, aber momentan sind keine offenen Aufträge vorhanden';
}else{
while($row = mysqli_fetch_object($request))
{
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td rowspan='8'align='right'>";
   echo "<tr><td></td><td><b>Gegenstand: </b></td>";
   echo "<td colspan='2'>$row->gegenstand</td></tr>";
   echo "<tr><td colspan='2'><b>ZIEL-ADRESSE</b></td></tr>";
   echo "<tr><td>Stadt</td>";
   echo "<td>$row->city</td>";
   echo "<td>PLZ:</td>";
   echo "<td>$row->plz</td></tr>";
   echo "<tr><td>Datum:</td></td>";
   echo "<td>$row->date</td></tr>";
   echo "<tr><td></td></tr>";
   $id= "$row->id";
   $id = encrypt($id, $key);
   echo "<tr><td></td><td><td></td></td><td></td><td align='right'><a href='details.php?$id'>Details</a></td></tr>";
   echo "</br></table>";
   }
   }
   }
      echo "</div>";
    echo "</section>";
include('footer.php');
?>

</body>
</html>