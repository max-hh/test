<?php
include('connect.php');
session_start();
$id = $_SESSION['id'];

if(isset($_POST['submitButton']))
  {
   $sql = "UPDATE transport SET fahrzeug ='$fahrzeug', licence ='$licence', start ='$start',ziel = '$ziel', startdate ='$startdate', tarrdate ='$tarrdate' WHERE id=$id";

    $mysqli->query($sql) OR die('Error: ' . mysqli_error($mysqli));

        $update= true;
  }

  ?>