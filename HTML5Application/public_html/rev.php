<?php
include('connect.php');

$user = $_POST['user'];
$value = $_POST['star'];
$transaktion =$_POST['transaktion'];
$title = mysqli_real_escape_string($mysqli, $_POST['title']);
$reviewtext = mysqli_real_escape_string($mysqli, $_POST['reviewtext']);




if(isset($_POST['review']))
  {

$sql = "INSERT INTO userreview
(user, value, transaktion, title, reviewtext)
VALUES
('$user', '$value', '$transaktion','$title', '$reviewtext')";

if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}
   }

?>