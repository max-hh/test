<?php
include('connect.php');

$userkennung = mysqli_real_escape_string($mysqli, $_POST['userkennung']);
$fahrzeug = mysqli_real_escape_string($mysqli, $_POST['fahrzeug']);
$licence = mysqli_real_escape_string($mysqli, $_POST['licence']);
$start = mysqli_real_escape_string($mysqli, $_POST['start']);
$ziel = mysqli_real_escape_string($mysqli, $_POST['ziel']);
$startdate = mysqli_real_escape_string($mysqli, $_POST['startdate']);
$tarrdate = mysqli_real_escape_string($mysqli, $_POST['tarrdate']);


if(isset($_POST['submit']))
{

$placed = gmdate("Y-m-d h:i:s");

$sql = "INSERT INTO transport
( userkennung, fahrzeug, licence, start, ziel, startdate, tarrdate, placed)
VALUES
('$userkennung', '$fahrzeug', '$licence', '$start','$ziel', '$startdate', '$tarrdate', '$placed')";

if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}
}

?>