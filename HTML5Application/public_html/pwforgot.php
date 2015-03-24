<?php
include('connect.php');
include('sec.php');

$email = mysqli_real_escape_string($mysqli, $_POST['email']);

$user = $email;
$user = encrypt($user, $key);

if(isset($_POST['submit']))
{
$email;
$subject = "Du möchtest dein Passwort zurücksetzen";
$from = "From: <absender@domain.de>";
$text = "Nachfolgend erhälst du einen Link um dein Passwort zurück zusetzen.<a href='http://s569318136.online.de/de/pwreset.php?$user'>Passwort zurücksetzen</a> </br>Solltest du diesen Link nicht angefordert haben, dann ignoriere ihn bitte und log dich wie gewohnt ein.";

mail($email, $subject, $text, $from);
$send = true;
 }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
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
</head>
        <body>
        <div class="dec">
         <div class="login">
    <table cellpadding="5">
                <tr><td align="center"><h2>Passwort zur&uuml;cksetzen</h2></td></tr>
                <?php if($send){echo "wir haben dir eine Mail zum zurücksetzen des Passworts geschickt";}?>
                <tr><td><hr></td></tr>
                <tr><td>Gib die E-Mail-Adresse an, die mit Deinem Account verbunden ist, dann schicken wir Dir einen Link, mit dem Du Dein Passwort zur&uuml;cksetzen kannst.</td></tr>
                <form name="Formular" method="post" action=""</form>
                <tr><td><input type="text" name="email" value="" placeholder="E-Mail"></td></tr>
                 <tr><td align="center"><input type="submit" value="Zur&uuml;cksetzen"></td></tr>
                </form>
          </div>
         </body>
</html>
