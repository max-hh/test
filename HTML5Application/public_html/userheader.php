<?php
include('connect.php');

$user = $_SESSION['username'];

 $request = $mysqli->query("SELECT firstname, image FROM user WHERE username='".$user."'");
     while($row = mysqli_fetch_object($request))
      {
      $firstname = "$row->firstname";
      $image = "$row->image";
      }

     if($image==''){
     $image = 'alt_profil.png';
     }

$_SESSION['firstname'] = $firstname;


   echo "<div id='header'>";
     echo "<table>";
         echo "<tr><td width='150px' align=center><a href='home.php'><h1> Dn'deliver </h1></a></td><td width='150px' align=center><a href='profil.php'><img src=../pic/".$image." width='30px' height='auto' style='border: 2px solid #0B0B61; -webkit-border-radius: 75px;
        -khtml-border-radius: 75px;
        -moz-border-radius: 75px; border-radius: 75px;'> $firstname</a></td></tr>";
         echo "</table>";
         echo "</div>";
   echo "</div>";

   ?>