<?php
require_once 'requiresLogin.php';
require 'geocode.php';
require 'geocode2.php';
require 'sec.php';
include('connect.php');
include('userheader.php');


$id = $_SERVER['QUERY_STRING'];
$id = decrypt($id, $key);

$result= $mysqli->query ("SELECT * FROM finale WHERE id=$id");
while ($row = mysqli_fetch_assoc($result)){
        $title = $row['gegenstand'];
        $start = $row['city'];
        $startstr = $row['str'];
        $ziel = $row['arrcity'];
        $zielstr = $row['arrstr'];
        $lat = $row['lat'];
        $lng = $row['long'];
        $lat1 = $row['lat1'];
        $lng1 = $row['lng1'];

}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Dn'deliver</title>
    <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <script src="http://maps.googleapis.com/maps/api/js?v=3&sensor=false&ext=.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">

var map = null;
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();

    //The list of points to be connected
var markers = [
    {

 "title": '<?php echo $title; ?>',
 "lat": '<?php echo $lat; ?>',
 "lng": '<?php echo $lng; ?>',
  "description": '1'
},
    {
        "title": '<?php echo $title; ?>',
        "lat": '<?php echo $lat1; ?>',
        "lng": '<?php echo $lng1; ?>',
        "description": '2'
    }

];


//    var map;
function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(
            parseFloat(markers[0].lat),
            parseFloat(markers[0].lng)),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var path = new google.maps.MVCArray();
    var service = new google.maps.DirectionsService();

    var infoWindow = new google.maps.InfoWindow();
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var poly = new google.maps.Polyline({
        map: map,
        strokeColor: '#F3443C'
    });
    var lat_lng = new Array();

    /* path.push(new google.maps.LatLng(parseFloat(markers[0].lat),
                                     parseFloat(markers[0].lng)));
    */
    var marker = new google.maps.Marker({
                   position:map.getCenter(),
                   map:map,

                 });
    bounds.extend(marker.getPosition());
    google.maps.event.addListener(marker, "click", function(evt) {
        infowindow.setContent("coord:"+marker.getPosition().toUrlValue(6));
        infowindow.open(map,marker);
    });
    for (var i = 0; i < markers.length; i++) {
        if ((i + 1) < markers.length) {
            var src = new google.maps.LatLng(parseFloat(markers[i].lat),
                                             parseFloat(markers[i].lng));
            var smarker = new google.maps.Marker({position:src, map:map});
            bounds.extend(smarker.getPosition());
    google.maps.event.addListener(smarker, "click", function(evt) {
        infowindow.setContent("<?php echo '<b>Start</b>' ?><br /><?php echo $startstr; ?><br /><?php echo $start; ?>");
        infowindow.open(map,smarker);
    });
            var des = new google.maps.LatLng(parseFloat(markers[i+1].lat),
                                             parseFloat(markers[i+1].lng));
            var dmarker = new google.maps.Marker({position:des, map:map});
            bounds.extend(dmarker.getPosition());
    google.maps.event.addListener(dmarker, "click", function(evt) {
        infowindow.setContent("<?php echo '<b>Ziel</b>' ?><br /><?php echo $zielstr; ?><br /><?php echo $ziel; ?>");
        infowindow.open(map,dmarker);
    });
            //  poly.setPath(path);
            service.route({
                origin: src,
                destination: des,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            }, function (result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
                        path.push(result.routes[0].overview_path[i]);
                    }
                    poly.setPath(path);
                    map.fitBounds(bounds);
                }
            });
        }
    }
}
google.maps.event.addDomListener(window,'load',initialize);


  </script>
  </head>

  <body onload="load()">
  <section class="container">
    <div id="map" style="width: 700px; height: 500px"></div>

    </section>
<?php
include('footer.php');
?>

  </body>
</html>