<?php
require_once 'config.php';

if(isLoggedin())
{
        header("Location: http://dndeliver.com/home.php");
        exit;
}

$loginFailed = false;
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']))
{
        if(register($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password']))
        {
                header("Location: home.php");
                exit;
        }else {
                $registerFailed = true;
        }
}
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
function chkForm () {
    if (document.Form.firstname.value == "") {
    alert("Bitte gib deinen Vornamen an!");
    document.Form.firstname.focus();
    return false;
  }
  if (document.Form.lastname.value == "") {
    alert("Bitte gib deinen Nachnamen an!");
    document.Form.lastname.focus();
    return false;
  }
  if (document.Form.username.value.indexOf("@") == -1) {
    alert("Deine E-Mail ist nicht korrekt!");
    document.Form.email.focus();
    return false;
  }
  if (document.Form.username.value == "") {
    alert("Bitte gib deine E-Mail Adresse an!");
    document.Form.username.focus();
    return false;
  }
  if (document.Form.password.value == "") {
    alert("Bitte gib ein Passwort an!");
    document.Form.password.focus();
    return false;
  }

}
</script>
</head>
        <body>
    <div id="header">
           </div>
  <section class="container">
    <div class="login">
                <table>
                <tr><td><h1>REGISTRIERE DICH ZUM VERSCHICKEN</h1></td></tr>
                <tr><td><p>Erstelle dein Konto und verschicke Gegenst&auml;nde in Minuten.</p></td></tr>
                </table>
                <table cellpadding="5">
                <form name="Form" method="post" action="" onsubmit="return chkForm()">
                <?php if($registerFailed): ?><p>Die E-Mail existier bereits! Bitte nutze eine andere</p><?php endif; ?>
                <tr><td></td><h1>Profil</h1></td><td align="right">*n&ouml;tig</td></tr>
                <tr><td><input type="text" name="firstname" value="" placeholder="Vorame*"></td></tr>
                <tr><td><input type="text" name="lastname" value="" placeholder="Nachname*"></td></tr>
                <tr><td><h1>Konto</h1></td></tr>
                <tr><td><input type="text" name="username" value="" placeholder="E-Mail*"></td></tr>
                <tr><td><input type="password" name="password" value="" placeholder="Passwort*"></td></tr>
                <tr><td align="center"><input type="submit" value="Registrieren"></p></td></tr>
                <tr><td><p>Wenn du den "Registrieren" Button dr&uuml;ckst, dann akzeptierst du unsere <a href="terms.html">Nutzungsbedingungen</a> und unsere <a href="privacy.html">Datenschutzrichtlinie</a></p></td></tr>
                </form>
                </table>
                 </div>
          </section>

 <?php
 include('footer.php');
 ?>
        </body>
</html>