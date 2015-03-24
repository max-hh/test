<?php
header ( 'Location: car.request.php' );
include('connect.php');

$id = $_GET['id'];


$sql = "DELETE FROM transport WHERE id=$id";

if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}

?>