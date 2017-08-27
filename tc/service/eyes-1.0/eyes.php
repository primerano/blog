<?php
require_once("Cache.php");
require_once("helpers.php");

// prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");


// keep cache on disk for now.   easy way to track usage.
DataCache::setStore("files/");

if (!isset($_GET["URL"]) || !isset($_GET["REF"])) {
echo "URL and REF are required parameters";
return;
}

$url = $_GET["URL"];
$ref = urldecode($_GET["REF"]);

if (!goodKey($url))  {
	echo "<ul></ul>";
  return;
}

$goodRef = goodRef($ref); // Is the reference any good?

if (!$result = DataCache::Get("references", "$url")) {
  // Not in cache so build new result
  if ($goodRef) $result = array();
}

if ($goodRef) {
  if (array_search("$ref", $result) === false) {
    if (count($result) >=5 ) {
      array_shift($result);
    }
    $result[] = $ref;
    DataCache::Put("references", "$url", 864000, $result);
  }  
}  

    
$idx_row  = count($result) - 1 ;
echo "<ul>";

for ($i = 0 ; $i<= $idx_row ; $i++)
{    
echo "<li><a href=\"$result[$i]\">$result[$i]</a></li>";
}
echo "</ul>";
?> 
