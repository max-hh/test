<?php
error_reporting(E_ALL^E_NOTICE);
require 'car.requiresLogin.php';
require 'geo.php';
include ('sec.php');
include('connect.php');

 $user = $_SESSION["user"];

     $request = $mysqli->query("SELECT firstname FROM carrier WHERE user='".$user."'");
     while($row = mysqli_fetch_object($request))
      {
      $firstname = "$row->firstname";
      }

$_SESSION['firstname'] = $firstname;
include('header.php');
?>

<!DOCTYPE html>
<html>
        <head> <!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dn'deliverr</title>
  <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <script src="http://maps.google.com/maps/api/js?sensor=true"
            type="text/javascript"></script>
  <script type="text/javascript">
    //<![CDATA[
// Some Custom Icons borrowed from the 'other function' that may come in handy

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };

// End Custom Icons

     var map;

      function initialize() {
        var myOptions = {
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map'),
            myOptions);

        // Try HTML5 geolocation
        if(navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
                                             position.coords.longitude);

            var marker = new google.maps.Marker({
              map: map,
              position: pos,
             icon:'images/markers/you.png'
            });

      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("gmaps.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var id = markers[i].getAttribute("id");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</a></b> <br/>" + address +"<br /><a href='details.php?" + id +"'>Details</a><br /><b></b>" ;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });


            map.setCenter(pos);
          }, function() {
            handleNoGeolocation(true);
          });
        } else {
          // Browser doesn't support Geolocation
          handleNoGeolocation(false);
        }
      }


      function handleNoGeolocation(errorFlag) {
        if (errorFlag) {
          var content = 'Error: The Geolocation service failed.';
        } else {
          var content = 'Error: Your browser doesn\'t support geolocation.';
        }

        var options = {
          map: map,
          position: new google.maps.LatLng(60, 105),
          content: content
        };

        var infowindow = new google.maps.InfoWindow(options);
        map.setCenter(options.position);
      }

// Additional functions related to the 'other' DB Listing function

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}


      google.maps.event.addDomListener(window, 'load', initialize);

    //]]>
  </script>
        </head>

        <body onload="load()">
   <?php

  $user = $_SESSION["user"];

   echo "<div id='top'>";
    echo "<div id='navi'>";
    echo "<table cellpadding='15'>";
    echo "<tr><td><a href='transport.php'>Erstelle deinen Auftrag</a></td><td><a href='car.request.php'>Deine Auftr&auml;ge</a></td></tr>";
    echo "</table>";
     echo "</div>";
     echo "</div>";

    echo"<div id='subnavi'>";
    echo "<a href='market.php'>Zeige alle</a>";
    echo"</div>";


    echo "<section class='container'>";
    echo "</br><div id='map' style='width: 700px; height: 500px'>";
    echo "</div>";
    echo "</section>";

  $open_request = $mysqli->query("SELECT id FROM  temp WHERE userkennungT='".$user."'");
     $open =mysqli_num_rows($open_request);
     $openrequest = "Offene Anfragen " .$open ."";

 $select_unread_messages = $mysqli->query("SELECT id FROM  message WHERE readit = 0 AND toUser='".$user."'");
     $messages =mysqli_num_rows($select_unread_messages);

 $select_unread_answer = $mysqli->query("SELECT id FROM  answer WHERE readit = 0 AND toUser='".$user."'");
         $answer =mysqli_num_rows($select_unread_answer);
         $num = $messages + $answer;


    $nachrichten = "Nachrichten " .$num ."";

    echo "<div id='carsidebar'>";
    echo "<table cellpadding='15'>";
    echo "<tr><td><a href='car.summary.php'>&Uuml;berblick</a></td></tr>";
    echo "<tr><td><a href='car.open.request.php'>$openrequest</a></td></tr>";
    echo "<tr><td><a href='car.messageover.php'>$nachrichten</a></td></tr>";
    echo "<tr><td><a href='logout.php'>Logout</a></td></tr>";
    echo "</table>";
    echo "</div>";

     $_SESSION['car.user']=$user;


include('footer.php');
?>
        </body>
</html>