<?php
error_reporting(E_ALL^E_NOTICE);
require 'requiresLogin.php';
?>

<!DOCTYPE html>
<html>
        <head> <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
 <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<meta name="Keywords" content="#">
<meta name="Description" content="#">
<meta http-equiv="Content-Language" content="en">
<meta name="robots" content="index,follow">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dn'deliverr</title>
  <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        </head>

        <body>
   <?php

$user = $_SESSION["username"];

   $request = $mysqli->query("SELECT firstname FROM  user WHERE username='".$user."'");
     while($row = mysqli_fetch_object($request))
      {
      $firstname = "$row->firstname";
      }
$_SESSION['firstname'] = $firstname;



     $open_request = $mysqli->query("SELECT id FROM  temporary WHERE userkennungA='".$user."'");
     $open =mysqli_num_rows($open_request);
     $openrequest = "Offene Anfragen " .$open ."";
    echo "<div id='top'>";
    echo "<div id='navi'>";
    echo "<table cellpadding='15'>";
    echo "<tr><td><a href='requests.php'>Deine Auftr&auml;ge</a></td><td><a href='tmarket.php'>Marktplatz</a></td><td><a href='auftrag.php'>Erstelle einen Auftrag</a></td></tr>";
    echo "</table>";
     echo "</div>";
     echo "</div>";


       $select_unread_messages = $mysqli->query("SELECT id FROM  message WHERE readit = 0 AND toUser='".$user."'");
     $messages =mysqli_num_rows($select_unread_messages);
 $select_unread_answer = $mysqli->query("SELECT id FROM  answer WHERE readit = 0 AND toUser='".$user."'");
         $answere =mysqli_num_rows($select_unread_answer);
         $num = $messages + $answer;


    $nachrichten = "Nachrichten " .$num ."";

     echo "<div class='main'>";
    echo "<iframe src='sum.php' width='50%' height='420' frameborder='0' scrolling='auto' name='fenster'>";
    echo "</iframe>";
    echo "</div>";


    echo "<div id='sidebar'>";
    echo "<table cellpadding='15'>";
    echo "<tr><td><a href='summary.php'>&Uuml;bersicht</a></td></tr>";
    echo "<tr><td><a href='open.request.php'>$openrequest</a></td></tr>";
    echo "<tr><td><a href='messageover.php'>$nachrichten</a></td></tr>";
    echo "<tr><td><a href='logout.php'>Logout</a></td></tr>";
    echo "</table>";
    echo "</div>";



     $_SESSION['user']=$user;

?>
        </body>
</html>