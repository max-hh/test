<?php
require 'connect.php';

$price = mysqli_real_escape_string($mysqli, $_POST['price']);
$userkennungT = mysqli_real_escape_string($mysqli, $_POST['userkennungT']);

$request = $mysqli->query("SELECT bill FROM carrier WHERE user='".$userkennungT."'");
while($row = mysqli_fetch_object($request))
   {
    $current = $row->bill;
   }


$bill= $current + $price/10;


if(isset($_POST['submit']))
{

$sql = "UPDATE carrier SET  bill='$bill' WHERE user='".$userkennungT."'";

 $mysqli->query($sql) OR die('Error: ' . mysqli_error($mysqli));
 }
?>