<?php
include('connect.php');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 else
 {
   $result = $mysqli->query("SELECT * from transport WHERE lat ='0'");
    while($row = mysqli_fetch_array( $result ))
    {
          $city = $row['start'];
          $id = $row['id'];

          $location = $city;
          echo $location."<br>";

      $url = "http://maps.google.com/maps/api/geocode/json?address=".$location."&sensor=false";
      echo $url;
            $output=file_get_contents($url);
            $out= json_decode($output);
            $lat = $out->results[0]->geometry->location->lat;
            $long = $out->results[0]->geometry->location->lng;
                        echo '<br>Lat is '. $lat;
            echo '<br>Long is '. $long;

      $update = "UPDATE transport SET lat = '".$lat."', `long` = '".$long."' WHERE id =".$id."";
      $mysqli->query($update) OR die('Error: ' . mysqli_error($mysqli));
      echo "Successfully inserted.";
    }
}

mysqli_close($mysqli);
?>