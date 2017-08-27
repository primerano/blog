<?php
require_once("Cache.php");
require_once("blocked.php");
require_once("helpers.php");

// prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");


// keep cache on disk for now.   easy way to track usage.
DataCache::setStore("files/");

if (!isset($_GET["KEY"]) || !isset($_GET["VAL"])) {
echo "KEY and VAL are required parameters";
return;
}
$key = $_GET["KEY"];
$val = urldecode($_GET["VAL"]);
$num = 5;
if (isset($_GET["COUNT"]))
 $num = $_GET["COUNT"];

if (!goodKey($key))  {
  echo "<ul></ul>";
  return;
}
$goodVal = goodRef($val); // Is the reference any good?
if ($goodVal)
  $goodVal = !blocked($val);  // don't put in cache if on block list


if (!$result = DataCache::Get("references", "$key")) {
  // Not in cache so build new result
  if ($goodVal) $result = array();
}

if ($goodVal) {
$akey = array_search("$val", $result);
$asize = count($result);
  if ($akey === false) {
    if ($asize >=15 ) {
      array_shift($result);
    }
    $result[] = $val;
    DataCache::Put("references", "$key", 864000, $result);
  } else {
   // if (($asize - $akey) > 5) {  //  make sure user shows in top 5
   if (($asize - $akey) != 1) {  //update only if not at the head 
      array_splice($result, $akey, 1);
      $result[] = $val;
      DataCache::Put("references", "$key", 864000, $result);
   }
  }
}  

$start = 0;    
$idx_row  = count($result) - 1 ;
if ($num < ($idx_row)+1)
  $start = $idx_row - $num + 1;


echo "<ul>";
for ($i = $start ; $i<= $idx_row ; $i++)
{    
echo "<li><a href=\"/$result[$i]/\">$result[$i]</a> <img src=\"http://api.oscar.aol.com/SOA/key=BETA/presence/$result[$i]\"  /> </li>";
}
echo "</ul>";
?> 
