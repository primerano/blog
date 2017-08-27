<?php
require_once("Cache.php");
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

if (!goodKey($key)) 
return null;
  
  $goodVal = goodRef($val); // Is the reference any good?

  if (!$result = DataCache::Get("references", "$key")) {
  echo "not found";
    // Not in cache so nothing to remove
      return;
      }


      if ($goodVal) {
      	$location = array_search("$val", $result);
		if (!($location === false)) {
		    	array_splice($result, $location, 1);
				    DataCache::Put("references", "$key", 864000, $result);
				    	}
					}  

					    
					    $idx_row  = count($result) - 1 ;
					    echo "<ul>";

					    for ($i = 0 ; $i<= $idx_row ; $i++)
					    {    
					    echo "<li><a href=\"/$result[$i]/\">$result[$i]</a> <img src=\"http://api.oscar.aol.com/SOA/key=BETA/presence/$result[$i]\"  /> </li>";
					    }
					    echo "</ul>";
					    ?> 

