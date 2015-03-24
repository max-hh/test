<?php
require_once 'car.config.php';
if(isLoggedin())
{
        header("Location: http://dndeliver.com/de/car.home.php");
        exit;
}

$loginFailed = false;
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['kkarte']) && isset($_POST['cvv']) && isset($_POST['monthdate']) && isset($_POST['yeardate']) && isset($_POST['user']) && isset($_POST['password']))
{
        if(register($_POST['firstname'], $_POST['lastname'], $_POST['kkarte'], $_POST['cvv'], $_POST['monthdate'], $_POST['yeardate'], $_POST['user'], $_POST['password']))
        {
                header("Location: car.home.php");
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

function chkFormular () {
  if (document.Formular.firstname.value == "") {
    alert("Bitte gib deinen Vornamen an!");
    document.Formular.firstname.focus();
    return false;
  }
  if (document.Formular.lastname.value == "") {
    alert("Bitte gib deinen Nachnamen an!");
    document.Formular.lastname.focus();
    return false;
  }
  if (document.Formular.kkarte.value == "") {
    alert("Bitte gib deine Kreditkartennummer an!");
    document.Formular.kkarte.focus();
    return false;
    }
  if (document.Formular.cvv.value == "") {
    alert("Bitte gib deine CVV Nummer an!");
    document.Formular.cvv.focus();
    return false;
    }
  if (document.Formular.monthdate.value == "") {
    alert("Bitte gib das einen Monat an!");
    document.Formular.monthdate.focus();
    return false;
    }
  if (document.Formular.yeardate.value == "") {
    alert("Bitte gib ein Jahr an!");
    document.Formular.yeardate.focus();
    return false;
    }
  if (document.Formular.user.value == "") {
    alert("Bitte gib deine E-Mail-Adresse an!");
    document.Formular.user.focus();
    return false;
  }
   if (document.Formular.user.value.indexOf("@") == -1) {
    alert("Deine E-Mail-Adresse ist nicht korrekt!");
    document.Formular.user.focus();
    return false;
  }
  if (document.Formular.password.value == "") {
    alert("Bitte gib ein Passwort an!");
    document.Formular.password.focus();
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
                <tr><td><h1>REGISTRIERE DICH UND TRANSPORTIERE</h1></td></tr>
                <tr><td><p>Erstelle dein Konto und verdiene Geld in Minuten.</p></td></tr>
                 </table>
                <form name="Formular" method="post" action="" onsubmit="return chkFormular()">
                <?php if($registerFailed): ?><p>Deine E-Mail-Adresse existiert bereits! Bitte w&auml;hle eine Andere</p><?php endif; ?>
                <table cellpadding="5">
                <tr><td><h1>Profil</h1></td><td align="right">*n&ouml;tig</td></tr>
                <tr><td><input type="text" name="firstname" value="" placeholder="Vorname*"></td>
                <td><input type="text" name="lastname" value="" placeholder="Nachname*"></td></tr>
                <tr><td><h1>Payment</h1></td></tr>
                <tr><td><input type="text" name="kkarte" value="" placeholder="Kreditkartennummer*"></td>
                <td><input type="number" name="cvv" value="" placeholder="CVV*"></td></tr>
                <tr><td><p>ABLAUFDATUM</p></td></tr>
                <table cellpadding="5">
                <tr><td><select name="monthdate"><option value="">Monat*</option><option value="01">01</option><option value="02">02</option>
                <option value="03">03</option><option value="04">04</option><option value="05">05</option>
                <option value="06">06</option><option value="07">07</option><option value="08">08</option>
                <option value="09">09</option><option value="10">10</option><option value="11">11</option>
                <option value="12">12</option></select></td>
                <td><select name="yeardate"><option value="">Jahr*</option><option value="2015">2015</option><option value="2016">2016</option>
                <option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option>
                <option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option>
                <option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option>
                <option value="2026">2026</option><option value="2027">2027</option><option value="2028">2028</option>
                <option value="2029">2029</option><option value="2030">2030</option></select></td></tr></table>
                <table cellpadding="5"><tr><td><h1>Konto</h1></td></tr>
                <tr><td><input type="text" name="user" value="" placeholder="E-Mail*"></td></tr>
                <tr><td><input type="password" name="password" value="" placeholder="Passwort*"></td></tr>
                <tr><td align="center"><input type="submit" value="Register"></td></tr>
                <tr><td><p>Wenn du den "Registrieren" Button dr&uuml;ckst, dann akzeptierst du unsere <a href="terms.html">Nutzungsbedingungen</a> und unsere <a href="privacy.html">Datenschutzrichtlinie</a></p></td></tr>
                 </table>
                </form>
                 </div>
          </section>
<?php
include('footer.php');
?>
        </body>
</html>