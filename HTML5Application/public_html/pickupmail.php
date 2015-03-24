<?php
error_reporting(E_ALL^E_NOTICE);
include('connect.php');


$userkennungA = mysqli_real_escape_string($mysqli, $_POST['userkennungA']);

$request = $con->query("SELECT username FROM user WHERE username='".$userkennungA."'");
while($row = mysqli_fetch_object($request))
   {
     $email = "$row->username";
   }


if(isset($_POST['submit']))
{

$email;
$subject = "You have an open request";
$from = "From: <absender@domain.de>";
$text = "You have an open request, check it out";

mail($email, $subject, $text, $from);
 }
?>