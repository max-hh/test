<?php

//DO NOT CHANGE
//connect to mysql server
$mysqli = mysqli_connect("localhost","root","","resource");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  ?>