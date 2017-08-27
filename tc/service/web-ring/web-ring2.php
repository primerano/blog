<?php
include("Cache.php");
include("helpers.php");
//DataCache::setStore("users");

$fileName = "sn.txt";

if (!$result = DataCache::Get("web-ring2", $fileName)) {
	$result = array();
	$lines = file($fileName);
	$current = "";
	
	foreach ($lines as $line_num => $line) {
			$result[] =  rtrim($line);
	}
	
	DataCache::Put("web-ring2", $fileName, 10000000, $result);
}

$reqSN = "";
if (isset($_GET["FROM"]))
 $reqSN = $_GET["FROM"];

$host = "http://www.aimpages.com";
//$host ="";
$sn = getRandom($result, $reqSN);
// prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");
header("Content-type: text/html");


echo "<p><a href=\"$host/$sn/\">";
  echo " <img src=\"$host/$sn/.aim/aimface.140.jpg\" />";
  echo " $sn</a> <img src=\"http://api.oscar.aol.com/SOA/key=BETA/presence/$sn\"  /> ";
  echo "</p>";

?> 
