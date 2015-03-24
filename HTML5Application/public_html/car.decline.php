<?php

include('connect.php');

$aid = $_GET['aid'];

$sql = "DELETE FROM temp WHERE aid=$aid";

if (mysqli_query($mysqli, $sql)) {
}
else {
    echo "Error deleting: " . mysqli_error($mysqli);
}
header ( 'Location: car.home.php' );

?>