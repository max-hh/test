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

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Keywords" content="#">
<meta name="Description" content="#">
<meta http-equiv="Content-Language" content="en">
<meta name="robots" content="index,follow">

<script src='rating/jquery.js' type="text/javascript"></script>
<script src='rating/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
 <script src='rating/jquery.rating.js' type="text/javascript" language="javascript"></script>
 <link href='rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
 <!--// documentation resources //-->
 <!--<script src="http://code.jquery.com/jquery-migrate-1.1.1.js" type="text/javascript"></script>-->
 <link type="text/css" href="/@/js/jquery/ui/jquery.ui.css" rel="stylesheet" />
 <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js" type="text/javascript"></script>
</head>
<body>



  <section class="container">
   <div class="login">
   <?php


 session_start();
   $user= $_SESSION['userkennungT'];

$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

$request = $mysqli->query("SELECT COUNT(*) AS anzahl FROM userreview WHERE transaktion=$id");
$var = mysqli_fetch_object($request);
if ($var->anzahl == 1){

echo '</br>Du hast diesen User bereits bewertet';
}else{
$select = $mysqli->query("SELECT userkennungA, id FROM finale WHERE id=$id");
echo "<p>Pleas rate this transaction and the user</p>";
while($row = mysqli_fetch_object($select))
         {
          $userkennungA ="$row->userkennungA";

   $res = $mysqli->query("SELECT firstname, image FROM user WHERE username='".$userkennungA."'");
   $rows = mysqli_fetch_object($res);
   {
   $firstname = "$rows->firstname";
   $image = "$rows->image";
   }
    if($image==''){
     $image = 'alt_profil.png';
     }
        echo "<table>";
         echo "<td>User:</td>";
         echo "<td><img src=pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'></td>";
         echo "<td>$firstname</tb>";
         echo "</table>";
         }
      echo "<table>";
echo "<form name='Formular' action='car.summary.php' method='post'>";
 echo "<p><input type='hidden' name='user' value='$userkennungA'></p>";
echo "<p><input type='hidden' name='transaktion' value='$id'></p>";

       echo "<p><input name='star' type='radio' class='star' value='1'/></p>";
       echo "<p><input name='star' type='radio' class='star' value='2'/></p>";
       echo "<p><input name='star' type='radio' class='star' value='3'/></p>";
       echo "<p><input name='star' type='radio' class='star' value='4'/></p>";
       echo "<p><input name='star' type='radio' class='star' value='5'/></p></br>";
echo "<p><input type='text'name='title' value='' Placeholder='Title'></p>";
echo "<p><input type='text' name='reviewtext' value='' Placeholder='Bewertungstext' style='height:80px;'></p>";
echo "<tr><td><input type='submit' name='review' value='Bewerten'></p></td></tr>";
echo "</table>";


}

  echo "</div>";
   echo "</section>";
include('footer.php');
?>
</body>
</html>