<?php
require_once("Cache.php");
require_once("h.php");

// prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");


// keep cache on disk for now.   easy way to track usage.
//DataCache::setStore("files/");

if (!isset($_GET["FROM"])) {
	echo "<p></p>";
return;
}
$from = strtolower($_GET["FROM"]);
$page = $_GET["PAGE"];

if (!goodReferer($from))  {
//  foreach($_SERVER as $h=>$v)
//            if(ereg('HTTP_(.+)',$h,$hp))
//	                          echo "<li>$h - $v</li>";

echo "<p> </p>";
  return;
}
  
if (!goodPage($page)) {
echo "<p> </p>";
  return;
  }

if (!$result = DataCache::Get("exposures1", "list11")) {
  // Not in cache so build new result
  $result = array();
}

// If source page is not in list add it.
if (array_search("$from", $result) === false) {
    $result[] = $from;
    DataCache::Put("exposures1", "list11", 60, $result);
}  
 
$randomuser = getRandom($result,$from);

echo "<p><a href=\"/$randomuser/\">  <img src=\"http://api.oscar.aol.com/SOA/key=BETA/presence/$randomuser\"  />$randomuser <br /> ";
echo "<img src=\"/$randomuser/.aim/aimface.75.jpg\" /></a></p>";
?> 
