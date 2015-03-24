<?php

include('connect.php');


$id = $_POST['id'];
$user = $_POST['userkennungT'];
$price = $_POST['price'];
$pri = $price/10;

if(isset($_POST['submit']))
{

$sql = "DELETE FROM finale WHERE aid=$id";

if (mysqli_query($mysqli, $sql)) {
}
else {
    echo "Error deleting: " . mysqli_error($mysqli);
}
}

$request = $mysqli->query("SELECT bill FROM carrier WHERE user ='".$user."'");
while($row = mysqli_fetch_object($request))
   {
     $current ="$row->bill";
   }
   $new = $current-$pri;

if(isset($_POST['submit']))
{
$sql = "UPDATE carrier SET bill = '$new' WHERE user ='".$user."'";
if (mysqli_query($mysqli, $sql)) {
}
else {
    echo "Error updating: " . mysqli_error($mysqli);
}
}


?>
