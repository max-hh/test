<?php
include('connect.php');

$id = $_POST['id']; 
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

?>