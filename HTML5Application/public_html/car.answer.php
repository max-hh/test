<?php
require_once 'car.requiresLogin.php';
require 'car.config4.php';
require 'car.config5.php';
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
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
 <body>

  <section class="container">
    <div class="login">
    <h1>Sende eine Nachricht</h1>
    <?php
$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);
$_SESSION['id']=$id;

session_start();
$user = $_SESSION['car.user'];


  $unread_messages = $mysqli->query("SELECT id, fromUser, toUser, sentOn, messageText, readit FROM  message WHERE id=$id");
    while($row = mysqli_fetch_object($unread_messages))
                  {
    $fromUser = "$row->fromUser";
    $id = "$row->id";
   $_SESSION['id']= $id;


    $request = $mysqli->query("SELECT firstname FROM user WHERE username='".$fromUser."'");
     while($rows = mysqli_fetch_object($request))
      {
      $firstname = "$rows->firstname";
      }
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td>Von:</td>";
   echo "<td>$firstname</td></tr>";
   echo "<tr><td>Gesendet am:</td>";
   echo "<td>$row->sentOn</td></tr>";
   echo "<tr><td>Nachricht:</td></tr>";
   echo "<td colspan='2'>$row->messageText</td>";
   echo "</table></br>";


                   }
$unread_update = $mysqli->query("SELECT id, readit FROM  message WHERE id=$id");
     while($rows = mysqli_fetch_object($unread_update))
     {
     $id="$rows->id";
     $_SESSION['id']= $id;
$update = "UPDATE message SET readit = 1 WHERE id=$id";
 $mysqli->query($update) OR die('Error: ' . mysqli_error($mysqli));
}

   $unread_answer = $mysqli->query("SELECT mid, fromUser, toUser, sent, message FROM  answer WHERE mid=$id");
    while($row = mysqli_fetch_object($unread_answer))
                  {
   echo "<table cellspacing='2px' cellpadding='2px' style=' width:100%; border:1px solid; border-color: #c4c4c4 #d1d1d1 #d4d4d4; border-radius: 5px;'>";
   echo "<tr><td>Gesendet am:</td>";
   echo "<td>$row->sent</td></tr>";
   echo "<tr><td>Nachricht:</td></tr>";
   echo "<td colspan='2'>$row->message</td>";
   echo "</table></br>";
   $toUser = "$row->fromUser";
   $fromUser = "$row->toUser";
   session_start();
   $_SESSION['toUser']=$toUser;
   $_SESSION['fromUser']=$fromUser;
                   }
   $answer_update = $mysqli->query("SELECT id, readit FROM  answer WHERE mid=$id");
     while($row = mysqli_fetch_object($answer_update))
     {
$update = "UPDATE answer SET readit = 1 WHERE mid=$id";
 $mysqli->query($update) OR die('Error: ' . mysqli_error($mysqli));
}

   echo "<form name='sendMessageForm' action='' method='post'>";
   echo "<table>";
   echo "<tr><td colspan='2' ><textarea name='message'></textarea></td></tr>";
   echo "<tr><td align='center'><input type='submit' value='Antwoten' name='answer'/></td></tr>";

   echo "</table>";
   echo "</form>";

      echo "</div>";
    echo "</section>";
include('footer.php');
?>
</body>
</html>