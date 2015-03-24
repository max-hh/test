<?php
include('sec.php');
require('connect.php');

$_SESSION['car.user'];
$_SESSION['id'];
$toUser = $_SERVER['QUERY_STRING'];
$toUser = decrypt($toUser, $key);

if(isset($_POST['send']) && str_replace(" ", "", $_POST['messageText']) != "")
        {

                $fromUser=$_SESSION['car.user'];
                $messageText = mysqli_real_escape_string($mysqli, $_POST['messageText']);
                $toUser = $toUser;
                $sentOn = gmdate("Y-m-d h:i:s");
                $mid = $_SESSION['id'];

$sql = "INSERT INTO message
(mid, fromUser, toUser, messageText, sentOn)
VALUES
('$mid', '$fromUser', '$toUser', '$messageText', '$sentOn')";


if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}
}

?>