<?php
require 'requiresLogin.php';
require 'connect.php';
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
    <div class="login">


 <?php
$user=$_SESSION['user'];
$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

 $request = $mysqli->query("SELECT id, userkennung, fahrzeug, licence, start, startdate, ziel, tarrdate FROM transport WHERE id=$id");
while($row = mysqli_fetch_object($request))
   {
      $userkennung = "$row->userkennung";

echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";

   $result = $mysqli->query("SELECT firstname, image FROM carrier WHERE user='".$userkennung."'");
while($rows = mysqli_fetch_object($result))
   {
   $firstname = "$rows->firstname";
   $image = "$rows->image";
   }
    if($image==''){
     $image = 'alt_profil.png';
     }

   echo "<tr><td><b>User:</b></td>";
   echo "<td>$firstname</td>";
    echo "<td><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td>";

   $sql = "SELECT sum(value) as summe FROM review WHERE user='".$userkennung."'";
   $res= $mysqli->query($sql);
    $s = $res->fetch_object();

   $req= $mysqli->query("SELECT value FROM review WHERE user='".$userkennung."'");
   $num = $row_cnt = $req->num_rows;
if($s->summe != 0) {
   $val= $s->summe/$num;

   $user = encrypt($userkennung, $key);
                 if ($val == 1) {
                        echo "<td><a href='reviewover.php?$user'><img src='rating/one_star.png'/></a></td>";
                } elseif($val <= 1.5) {
                           echo "<td><a href='reviewover.php?$user><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 2) {
                        echo "<td><a href='reviewover.php?$user'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val <= 2.5){
                        echo "<td><a href='reviewover.php?$user'><img src='rating/two_star.png'/></a></td>";
                } elseif ($val == 3) {
                        echo "<td><a href='reviewover.php?$user'><img src='rating/three_star.png'/></a></td>";
                } elseif ($val <= 3.5){
                        echo "<td><a href='reviewover.php?$user'><img src='rating/three_star.png'/></a></td>";
                }elseif ($val == 4){
                        echo "<td><a href='reviewover.php?$userkennung'><img src='rating/four_star.png'/></a></td>";
                } elseif ($val <= 4.5){
                        echo "<td><a href='reviewover.php?$user'><img src='rating/four_star.png'/></a></td>";
                }elseif ($val <= 5){
                        echo  "<td><a href='reviewover.php?$user'><img src='rating/five_star.png'/></a></td>";
        }
        $p='5';
        $pro=$val/$p*100;

   echo "<td>$pro%</td></tr>";
    }else {
         echo "<td>zurzeit existiert keine Bewertung</td></tr>";
         }
   echo "<tr><td><b>Fahrzeug: </b></td>";
   echo "<td>$row->fahrzeug</td></tr>";
   echo "<tr><td colspan='2'><b>Start-Adresse</b></td></tr>";
   echo "<tr><td>Stadt:</td>";
   echo "<td>$row->start</td></tr>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->startdate</td></tr>";
   echo "<tr><td></td></tr>";
   echo "<tr><td colspan='2'><b>Ziel-Adresse</b></td></tr>";
   echo "<tr><td>Stadt:</td>";
   echo "<td>$row->ziel</td></tr>";
   echo "<tr><td>Datum:</td>";
   echo "<td>$row->tarrdate</td></tr>";
   $userkennung= "$row->userkennung";
   $_SESSION['userkennungT'] = $userkennung;
    $id= "$row->id";
   $_SESSION['id'] = $id;
    $user = encrypt($userkennung, $key);
   }
   echo "<tr><td><a href='tmarket.php'>Zur&uuml;ck</a></td><td><a href='message.php?$user'>Kontakt!</a></td><td></td><td align='left'><a href='userhandling.php'>Anfrage senden</a></td></tr>";
   echo "</table>";



?>
  </div>
          </section>
<?php
    include('footer.php');
    ?>
</body>
</html>