<?php
include('connect.php');

$aid = $_POST['aid'];
$userkennungA = mysqli_real_escape_string($mysqli, $_POST['userkennungA']);
$gegenstand = mysqli_real_escape_string($mysqli, $_POST['gegenstand']);
$price = mysqli_real_escape_string($mysqli, $_POST['price']);
$hight = mysqli_real_escape_string($mysqli, $_POST['hight']);
$width = mysqli_real_escape_string($mysqli, $_POST['width']);
$depth = mysqli_real_escape_string($mysqli, $_POST['depth']);
$info= mysqli_real_escape_string($mysqli, $_POST['info']);
$city= mysqli_real_escape_string($mysqli, $_POST['city']);
$str= mysqli_real_escape_string($mysqli, $_POST['str']);
$plz= mysqli_real_escape_string($mysqli, $_POST['plz']);
$land= mysqli_real_escape_string($mysqli, $_POST['land']);
$date= mysqli_real_escape_string($mysqli, $_POST['date']);
$arrcity= mysqli_real_escape_string($mysqli, $_POST['arrcity']);
$arrstr= mysqli_real_escape_string($mysqli, $_POST['arrstr']);
$arrplz= mysqli_real_escape_string($mysqli, $_POST['arrplz']);
$arrland= mysqli_real_escape_string($mysqli, $_POST['arrland']);
$arrdate= mysqli_real_escape_string($mysqli, $_POST['arrdate']);


$userkennungT = mysqli_real_escape_string($mysqli, $_POST['userkennungT']);
$fahrzeug = mysqli_real_escape_string($mysqli, $_POST['fahrzeug']);
$licence = mysqli_real_escape_string($mysqli, $_POST['licence']);
$start = mysqli_real_escape_string($mysqli, $_POST['start']);
$ziel = mysqli_real_escape_string($mysqli, $_POST['ziel']);
$startdate = mysqli_real_escape_string($mysqli, $_POST['startdate']);
$tarrdate = mysqli_real_escape_string($mysqli, $_POST['tarrdate']);


if(isset($_POST['submit']))
{
$request = $mysqli->query("SELECT aid FROM temporary WHERE aid=$aid AND userkennungT ='".$userkennungT."'");
if ($row_cnt = $request->num_rows){
$setFailed = true;
}else{
$placed = gmdate("Y-m-d h:i:s");

$sql = "INSERT INTO temporary
(aid, userkennungA, userkennungT, gegenstand, price, hight, width, depth, info, city, str, plz, land, date, arrcity, arrstr, arrplz, arrland, arrdate, fahrzeug, licence, start, ziel, startdate, tarrdate, placed)
VALUES
('$aid', '$userkennungA', '$userkennungT', '$gegenstand', '$price', '$hight', '$width', '$depth', '$info', '$city', '$str', '$plz', '$land', '$date', '$arrcity', '$arrstr', '$arrplz', '$arrland', '$arrdate', '$fahrzeug', '$licence', '$start', '$ziel', '$startdate', '$tarrdate', '$placed')";
$set= true;


 if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
  }
}
}
?>