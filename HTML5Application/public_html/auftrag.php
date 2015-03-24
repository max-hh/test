<?php
require 'requiresLogin.php';
include('userheader.php');
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
  if (document.Formular.gegenstand.value == "") {
    alert("Bitte gib einen Gegenstand an!");
    document.Formular.gegenstand.focus();
    return false;
  }
    if (document.Formular.price.value == "") {
    alert("Bitte gib den maximalen Preis ein, den du bereit bis für den Transport zu zahlen!");
    document.Formular.price.focus();
    return false;
  }
  if (document.Formular.hight.value == "") {
    alert("Bitte gib die Höhe deines Gegenstandes an!");
    document.Formular.hight.focus();
    return false;
  }
    if (document.Formular.widht.value == "") {
    alert("Bitte gib die Breite deines Gegenstandes an!");
    document.Formular.widht.focus();
    return false;
  }
    if (document.Formular.depth.value == "") {
    alert("Bitte gib die Tiefe deines Gegenstandes an!");
    document.Formular.depth.focus();
    return false;
  }
  if (document.Formular.city.value == "") {
    alert("Bitte gib die Start-Stadt an.");
    document.Formular.city.focus();
    return false;

}if (document.Formular.str.value == "") {
    alert("Bitte gib die Start-Strasse an!");
    document.Formular.str.focus();
    return false;

}if (document.Formular.plz.value == "") {
    alert("Bitte gib die Start-PLZ an!");
    document.Formular.plz.focus();
    return false;

}if (document.Formular.land.value == "") {
    alert("Bitte gib das Start-Land an!");
    document.Formular.land.focus();
    return false;

}if (document.Formular.date.value == "") {
    alert("Bitte gib das Abholdatum an!");
    document.Formular.date.focus();
    return false;

} if (document.Formular.arrcity.value == "") {
    alert("Bitte gib die Ziel-Stadt an!");
    document.Formular.arrcity.focus();
    return false;

}if (document.Formular.arrstr.value == "") {
    alert("Bitte gib die Ziel-Strasse an!");
    document.Formular.arrstr.focus();
    return false;

}if (document.Formular.arrplz.value == "") {
    alert("Bitte gib die Ziel-PLZ an!");
    document.Formular.arrplz.focus();
    return false;

}if (document.Formular.arrland.value == "") {
    alert("Bitte gib das Ziel-Land an!");
    document.Formular.arrland.focus();
    return false;

}
if (document.Formular.arrdate.value == "") {
    alert("Bitte gib das späteste Ankunftsdatum an!");
    document.Formular.arrdate.focus();
    return false;

}
}

</script>

        <body>

  <section class="container">
    <div class="login">
                <h1>Erstelle einen Auftrag</h1>
                <?php $_SESSION['user']; echo "<form name='Formular' action='over.php' method='post' onsubmit='return chkFormular()'>";
                $userkennung =$_SESSION['user']; echo "<p><input type='hidden' name='userkennung' value='$userkennung'</p>";?>
                <p><input type="text" name="gegenstand" value="" placeholder="Gegenstand"></p>
                <p><input type="text" name="price" value="" placeholder="Max. Transport-Preis"></p>
                <table cellspacing="15">
                <tr><td><p>CIRCA SIZE</p></td><td><img src='../image/HxBxT.png' width='80' height='auto'></td></tr>
                </table>
                <table cellpadding="5">
                <tr><td><select name="hight"><option value="">H&ouml;he in cm.</option><option value="<50">< 50</option><option value="50-100">50-100</option>
                <option value="100-150">100-150</option><option value="150-200">150-200</option><option value="200-250">200-250</option>
                <option value="250-300">250-300</option><option value="300-350">300-350</option><option value="350-400">350-400</option>
                <option value=">400"> > 400</option></select></td>
                <td><select name="width"><option value="">Breite in cm.</option><option value="<50">< 50</option><option value="50-100">50-100</option>
                <option value="100-150">100-150</option><option value="150-200">150-200</option><option value="200-250">200-250</option>
                <option value="250-300">250-300</option><option value="300-350">300-350</option><option value="350-400">350-400</option>
                <option value=">400"> > 400</option></select></td>
                <td><select name="depth"><option value="">Tiefe in cm.<option value="<50">< 50</option><option value="50-100">50-100</option>
                <option value="100-150">100-150</option><option value="150-200">150-200</option><option value="200-250">200-250</option>
                <option value="250-300">250-300</option><option value="300-350">300-350</option><option value="350-400">350-400</option>
                <option value=">400"> > 400</option></select></td></tr></table>
                <P>START-ADRESSE</P>
                <p><input type="text" name="city" value="" placeholder="Stadt"></p>
                <p><input type="text" name="str" value="" placeholder="Strasse und Nr."></p>
                <p><input type="text" name="plz" value="" placeholder="PLZ"></p>
                <p><input type="text" name="land" value="" placeholder="Land"></p>
                <p><input type="text" name="date" value="" placeholder="Datum"></p>
                <P>ZIEL-ADRESSE</P>
                <p><input type="text" name="arrcity" value="" placeholder="Stadt"></p>
                <p><input type="text" name="arrstr" value="" placeholder="Strasse und Nr."></p>
                <p><input type="text" name="arrplz" value="" placeholder="PLZ"></p>
                <p><input type="text" name="arrland" value="" placeholder="Land"></p>
                <p><input type="text" name="arrdate" value="" placeholder="Ankunftsdatum"></p>
                <P>ZUS&Auml;TZLICHE INFO (optional)</P>
                <p><textarea name="info" value=""></textarea></p>
                <table>
                  <tr><td><input type="submit"  name="submit" value="Erstellen!"></td></tr>
                 </table>
                </form>
                 </div>
          </section>

<?php
include('footer.php');
?>
          </body>
</html>