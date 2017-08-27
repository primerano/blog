<?php
require_once("Cache.php");
require_once("helpers.php");

// prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");

// keep cache on disk for now.   easy way to track usage.
DataCache::setStore("files");

if (!isset($_GET["PAGE"])) {
	echo "<p></p>";
return;
}
$page = strtolower($_GET["PAGE"]);
if (!isset($_GET["TAG"])) {
        echo "<p></p>";
	return;
}
$tag = strtolower($_GET["TAG"]);

if (!goodReferer($page))  {
echo "<p> </p>";
  return;
}
  
if (!goodPage($page)) {
echo "<p> </p>";
  return;
}

if (fixedList($tag))
{
	$fileName = $tag . ".txt";
	if (!$result = DataCache::Get("rings", $fileName)) {
		$result = array();
		$lines = file($fileName);
		$current = "";
		foreach ($lines as $line_num => $line) {
			$result[] =  rtrim($line);
		}
		DataCache::Put("rings", $fileName, 10000000, $result);
	}
} else {
	if (!$result = DataCache::Get("rings1", $tag)) {
		// Not in cache so build new result
		$result = array();
	}

	// If source page is not in list add it.
	if (array_search("$page", $result) === false) {
		$result[] = $page;
		DataCache::Put("rings1", $tag, 60, $result);
	}  
} 
$randomuser = getRandom($result,$page);
$tmp2 = split('/',$randomuser);

$sn = $tmp2[1];


echo "<p><a href=\"$randomuser\">  <img src=\"http://api.oscar.aol.com/SOA/key=BETA/presence/$sn\"  />$sn <br /> ";
echo "<img src=\"/$sn/.aim/aimface.75.jpg\" /></a></p>";
?> 
