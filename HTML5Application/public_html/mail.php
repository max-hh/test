<?php
include('connect.php');


$userkennungT = mysqli_real_escape_string($mysqli, $_POST['userkennungT']);

$request = $mysqli->query("SELECT user FROM carrier WHERE user='".$userkennungT."'");
while($row = mysqli_fetch_object($request))
   {
     $email = "$row->user";
   }


if(isset($_POST['submit']))
{

$email;
$subject = "You have a new Order";
$from = "From: <absender@domain.de>";
$text = "You got a new order, check it out";

mail($email, $subject, $text, $from);
 }
?>