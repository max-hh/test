<?php
include('connect.php');


$_SESSION['id'];
$_SESSION['user'];
$_SESSION['userkennung'];


if(isset($_POST['send']) && str_replace(" ", "", $_POST['messageText']) != "")
        {
                //Eintrag in die Datenbank
                //Variablen
                $fromUser=$_SESSION['user'];
                $messageText = mysqli_real_escape_string($mysqli, $_POST['messageText']);
                $toUser = $_SESSION['userkennung'];
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