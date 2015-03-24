<?php
include('connect.php');


$id= $_SESSION['id'];




$request = $mysqli->query("SELECT fromUser, toUser FROM message WHERE id=$id");
while($row = mysqli_fetch_object($request))
   {
                 $toUser ="$row->fromUser";
                 $fromUser ="$row->toUser";
                  }


if(isset($_POST['answer']) && str_replace(" ", "", $_POST['message']) != "")
              {
                //Eintrag in die Datenbank
                //Variablen
                $fromUser= $fromUser;
                $toUser = $toUser;
                $mid=$id;
                $message =         mysqli_real_escape_string($mysqli, $_POST['message']);
                $sent = gmdate("Y-m-d h:i:s");;

$sql = "INSERT INTO `answer`
(`mid`, `fromUser`, `toUser`, `message`, `sent`)
VALUES
('$mid', '$fromUser', '$toUser', '$message', '$sent');";

if (!mysqli_query($mysqli,$sql)) {
  die('Error: ' . mysqli_error($mysqli));
}
}

?>