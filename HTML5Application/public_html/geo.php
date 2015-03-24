<?php
include('connect.php');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 else
 {
   $result = $mysqli->query("SELECT * from request WHERE lat ='0'");
    while($row = mysqli_fetch_array( $result ))
    {
          $name = $row['str'];
          $city = $row['city'];
          $id = $row['id'];

          $loc_name = rawurlencode($row['str']); //to replace spaces by '+' signs
          $location = $loc_name."+".$city;


      $url = "http://maps.google.com/maps/api/geocode/json?address=".$location."&sensor=false";

            $output=file_get_contents($url);
            $out= json_decode($output);
            $lat = $out->results[0]->geometry->location->lat;
            $long = $out->results[0]->geometry->location->lng;

      $update = "UPDATE request SET lat = '".$lat."', `long` = '".$long."' WHERE id =".$id."";
      $mysqli->query($update) OR die('Error: ' . mysqli_error($mysqli));
    
    }
}

mysqli_close($mysqli);
?>