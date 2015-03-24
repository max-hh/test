<?php
include('sec.php');

$username="dbo569329942";
$password="max1804";
$database="db569329942";
$localhost="db569329942.db.1and1.com";

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&apos;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a mySQL server
$connection=mysql_connect ($localhost, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active mySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM transport WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node

echo '<markers>';

// Iterate through the rows, printing XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($row['licence']) . '" ';
  echo 'address="' . parseToXML($row['start']) . '" ';
  $id = $row['id'];
  $id = encrypt($id, $key);
  echo 'id="' . parseToXML($id) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['long'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';


?>