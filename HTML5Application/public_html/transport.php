<?php
require_once 'car.requiresLogin.php';
require 'config2.php';
$user = $_SESSION['car.user'];
include('header.php');
?>

<!DOCTYPE html>
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
<script type="text/javascript">
function chkFormular () {
  if (document.Formular.fahrzeug.value == "") {
    alert("Bitte gib dein Fahrzeug an!");
    document.Formular.fahrzeug.focus();
    return false;
  }
    if (document.Formular.licence.value == "") {
    alert("Bitte gib dein Kennzeichen an!");
    document.Formular.licence.focus();
    return false;
  }
  if (document.Formular.start.value == "") {
    alert("Bitte gib deine Start-Adresse an!");
    document.Formular.start.focus();
    return false;
  }
if (document.Formular.ziel.value == "") {
    alert("Bitte gebe deine Ziel-Adresse an!");
    document.Formular.ziel.focus();
    return false;

}
if (document.Formular.startdate.value == "") {
    alert("Bitte gib dein Start-Datum an!");
    document.Formular.startdate.focus();
    return false;

}
if (document.Formular.tarrdate.value == "") {
    alert("Bitte gib deine Ankunfts-Datum an!");
    document.Formular.tarrdate.focus();
    return false;

}
}

</script>
 </head>
        <body>
        <section class='container'>
         <div class="login">


                <h1>Transportangaben</h1>
                <table cellpadding="5">
                <form name='Formular' action='car.request.php' method='post' onsubmit='return chkFormular()'>
                <?php echo "<p><input type='hidden' name='userkennung' value='$user'</p>"; ?>

                <tr><td><p><input type="text" name="fahrzeug" value="" placeholder="Fahrzeugbezeichnung"></p></td></tr>
                <tr><td><p><input type="text" name="licence" value="" placeholder="Kennzeichen"></p></td></tr>
                <tr><td><p><input type="text" name="start" value="" placeholder="Start-Adresse"></p></td></tr>
                <tr><td><p><input type="text" name="ziel" value="" placeholder="Ziel-Adresse"></p></td></tr>
                <tr><td><p><input type="text" name="startdate" value="" placeholder="Start-Datum"></p></td></tr>
                <tr><td><p><input type="text" name="tarrdate" value="" placeholder="Ankunfts-Datum"></p></td></tr>
                <tr><td><p><input type='submit' name='submit' value='Erstellen'></p></td></tr>

                </form>
                </table>
                 </div>
                 </section>

<?php

include('footer.php');
?>
        </body>
</html>