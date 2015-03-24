 <?php
 require 'config3.php';
 include('connect.php');

session_start();
$id = $_SESSION['id'];

if(isset($_POST['submitButton']))
  {

$sql = "UPDATE request SET gegenstand = '$gegenstand', price = '$price', hight = '$hight', width = '$width', depth = '$depth', info = '$info', city = '$city', str = '$str', plz = '$plz', land = '$land', date = '$date', arrcity = '$arrcity', arrstr ='$arrstr', arrplz = '$arrplz', arrland ='$arrland', arrdate ='$arrdate'  WHERE id=$id";

    $mysqli->query($sql) OR die('Error: ' . mysqli_error($mysqli));

    $update= true; 
  }

  ?>