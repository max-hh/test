<?php
header ( 'Location: home.php' );
include('connect.php');

$aid = $_GET['aid'];

$sql = "DELETE FROM temporary WHERE aid=$aid";

if (mysqli_query($mysqli, $sql)) {
}
else {
    echo "Error deleting: " . mysqli_error($mysqli);
}

?>