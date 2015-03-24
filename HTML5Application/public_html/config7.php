<?php

include('connect.php');

$id = $_POST['id'];

if(isset($_POST['delete']))
{

$sql = "DELETE FROM request WHERE id=$id";

if (mysqli_query($mysqli, $sql)) {
}
else {
    echo "Error deleting: " . mysqli_error($mysqli);
}
}

?>