<?php
require_once 'car.config.php';
if(isLoggedin())
{
        header("Location: car.home.php");
        exit;


}

$loginFailed = false;
if(isset($_POST['user']))
{
        if(tryLogin($_POST['user'], $_POST['password']))
        {
                $loggedIn = true;
        }else{
                $loginFailed = true;
        }
}

if(!isset($loggedIn)):
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
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script type="text/javascript">
function chkFormular () {
    if (document.log.user.value == "") {
    alert("Bitte gib deine E-Mail-Adresse ein!");
    document.log.user.focus();
    return false;
  }
   if (document.log.password.value == "") {
    alert("Bitte gib dein Passwort ein!");
    document.log.password.focus();
    return false;
  }

}
</script>

  </head>
        <body>
        <div class="dec">

    <div class="login">
      <table cellpadding="5">
                <tr><td align="center"><h1>LOG IN</h1></td></tr>
                <tr><td><hr></td></tr>
                <tr><td><?php if($loginFailed): ?><p>Der Login war nicht erfolgreich! Bitte &uuml;berpr&uuml;fe deine E-Mail und dein Passwort!</p><?php endif; ?></td></tr>
                 <form name="log" method="post" action="car.home.php" onsubmit="return chkFormular()"</form>
                <tr><td><input type="text" name="user" value="" placeholder="E-Mail"></td></tr>
                <tr><td><input type="password" name="password" value="" placeholder="Passwort"></td></tr>
                 <tr><td align="center"><input type="submit" value="LOG IN"></p></td></tr>
                 <tr><td><div class="login-help">
                 <a href="pwforgot.php">Passwort vergessen?</a></div></td></tr>
        </table>
                </form>
                 </div>
                 </div>


        </body>
</html>
<?php endif; ?>