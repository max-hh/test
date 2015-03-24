<?php
include('connect.php');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 else
 {
   $result = $mysqli->query("SELECT * from finale WHERE lat1 ='0'");
    while($row = mysqli_fetch_array( $result ))
    {
          $name = $row['arrstr'];
          $city = $row['arrcity'];
          $id = $row['id'];

          $loc_name = rawurlencode($row['arrstr']); //to replace spaces by '+' signs
          $location = $loc_name."+".$city;


      $url = "http://maps.google.com/maps/api/geocode/json?address=".$location."&sensor=false";
            $output=file_get_contents($url);
            $out= json_decode($output);
            $lat = $out->results[0]->geometry->location->lat;
            $long = $out->results[0]->geometry->location->lng;


      $update = "UPDATE finale SET lat1 = '".$lat."', `lng1` = '".$long."' WHERE id =".$id."";
      $mysqli->query($update) OR die('Error: ' . mysqli_error($mysqli));

    }
}

mysqli_close($mysqli);
?>