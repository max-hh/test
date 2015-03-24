<?php
include('connect.php');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 else
 {
   echo "Connected.";
   $result = $conn->query("SELECT * from auftrag");
    while($row = mysqli_fetch_array( $result ))
    {
          $name = $row['str'];
          $city = $row['city'];
          $id = $row['ID'];

          $loc_name = urlencode(mb_convert_encoding($row['str'], 'UTF-8')); //to replace spaces by '+' signs
          $location = $loc_name."+".$city;
          echo $location."<br>";

      $url = "http://maps.google.com/maps/api/geocode/json?address=".$location."&sensor=false";
      echo $url;
            $output=file_get_contents($url);
            $out= json_decode($output);
            $lat = $out->results[0]->geometry->location->lat;
            $long = $out->results[0]->geometry->location->lng;
                        echo '<br>Lat is '. $lat;
            echo '<br>Long is '. $long;

      $update = "UPDATE auftrag SET lat = '".$lat."', `long` = '".$long."' WHERE ID =".$id."";
      $mysqli->query($update) OR die('Error: ' . mysqli_error($mysqli));
      echo "Successfully inserted.";
    }
}

mysqli_close($conn);
?>