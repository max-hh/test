<?php
require 'config1.php';
include('connect.php');
include('sec.php');

session_start();
$_SESSIN['user'];
$user =$_SESSION['user'];


$result = $mysqli->query("SELECT MAX(id) FROM request WHERE userkennung='".$user."'");
while($row = mysqli_fetch_object($result))
      {
   $id ="$row->id";
   }
$id = encrypt($id, $key);

   $url ="auftrag_details.php?$id";

header ( "Location:" .$url );

   ?>