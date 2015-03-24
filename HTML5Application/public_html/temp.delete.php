<?php

include('connect.php');

$aid = $_POST['aid'];

if(isset($_POST['submit']))
{

$sql = "DELETE FROM temp WHERE aid=$aid";

if (mysqli_query($mysqli, $sql)) {
}
else {
    echo "Error deleting: " . mysqli_error($mysqli);
}
}

?>