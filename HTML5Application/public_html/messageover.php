<?php
error_reporting(E_ALL ^ E_NOTICE);
require 'requiresLogin.php';
require_once 'config4.php';
include('userheader.php');
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
    <div class="login">
<?php
$user = $_SESSION['username'];


 echo "<table>";
 echo "<tr><td><a href='.php'>Versandte Nachrichten</a></td></tr>";
 echo "</table>";

  $unread_messages = $mysqli->query("SELECT id, fromUser, sentOn, messageText FROM  message WHERE toUser='".$user."' ORDER BY sentOn DESC");
  if (!$row_cnt = $unread_messages->num_rows){
$no = 1;
}else{
while($row = mysqli_fetch_object($unread_messages))
   {
    $fromUser = "$row->fromUser";

   $request = $mysqli->query("SELECT firstname FROM carrier WHERE user='".$fromUser."'");
     while($rows = mysqli_fetch_object($request))
      {
      $firstname = "$rows->firstname";
      }
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td>Von:</td>";
   echo "<td>$firstname</td></tr>";
   echo "<tr><td>Geschickt am:</td>";
   echo "<td>$row->sentOn</td></tr>";
   echo "<tr><td>Nachricht:</td></tr>";
   echo "<td colspan='2'>$row->messageText</td></tr>";
   $id ="$row->id";
   $id = encrypt($id, $key);
   echo "<tr><td></td><td></td><td><a href='answer.php?$id'>Answer</a></td></tr>";
   echo "</table></br>";
                         }
                         }
  $_SESSION['fromUser']= $fromUser;

  $unread_answer = $mysqli->query("SELECT mid, sent, message FROM answer WHERE toUser='".$user."' ORDER BY sent ASC LIMIT 1");
   if (!$row_cnt = $unread_answer->num_rows){
$non= 1;
}else{
while($row = mysqli_fetch_object($unread_answer))
   {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td>Geschickt am:</td>";
   echo "<td>$row->sent</td></tr>";
   echo "<tr><td>Nachricht:</td></tr>";
   echo "<td colspan='2'>$row->message</td>";
   $mid ="$row->mid";
   $id = encrypt($mid, $key);
   echo "<tr><td></td><td></td><td><a href='answer.php?$id'>Answer</a></td></tr>";
   echo "</table></br>";
                   }
                   }

  if($no== 1 AND $non==1){
  echo "You have no Messages right now.";
  }

    echo "</div>";
    echo "</section>";
include('footer.php');
          ?>
</body>
</html>