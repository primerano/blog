<?php
include("Cache.php");
include("helpers.php");
//DataCache::setStore("users");

$fileName = "http://members.aol.com/primeranot/sn.txt";

if (!$result = DataCache::Get("web-ringR", "test")) {
	$result = array();
	$lines = file($fileName);
	$current = "";
	
	foreach ($lines as $line_num => $line) {
			$result[] =  rtrim($line);
	}
	
	DataCache::Put("web-ringR", "test", 10000, $result);
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

header("Location:".$host."/".$sn);

?> 
