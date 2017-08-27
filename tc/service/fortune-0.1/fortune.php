<?php
include("Cache.php");
// DataCache::setStore(".");

$fileName = "unix.txt";

$category = "";
if (isset($_GET["category"])) 
	$category = $_GET["category"];
switch ($category) {
case "unix":
   $fileName = "unix.txt";
   break;
case "funny":
   $fileName = "funny.txt";
   break;
case "default":
   $fileName = "unix.txt";
   break;
}

if (!$result = DataCache::Get("fortunes", $fileName)) {
	$result = array();
	$lines = file($fileName);
	$current = "";
	
	foreach ($lines as $line_num => $line) {
		if (strcmp(substr($line,0,1),'%') ==0) {
			$result[] = $current;
			$current = "";
		} else {
			// escape &
			$tmp = str_replace("&", " &amp;", substr($line,0, strlen($line)));
			// Preserve spaces 
			$tmp = str_replace("  ", " &nbsp;", substr($tmp,0, strlen($tmp)));
			// escape < 
			$tmp = str_replace("<", " &lt;", substr($tmp,0, strlen($tmp)));
			// escape > and replace line feed with br tag
			$tmp = str_replace(">", " &gt;", substr($tmp,0, strlen($tmp)-1)). "<br />";
			// add to current fortune
			$current .= $tmp;
		}
	}
	if (strlen($current) > 0 )
		$result[] = $current;
	
	DataCache::Put("fortunes", $fileName, 6000, $result);
}
    
// Do something useful with $result
srand ((double) microtime() * 1000000);
$randomquote = rand(0,count($result)-1);

$format = "";
if (isset($_GET["format"])) 
   $format = $_GET["format"];
 
 // prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");

   switch ($format) {
	   case "js":
 	     header("Content-type: text/plain");
         echo "function fortune() {";
	     echo "document.write(\"<p>\");";
   	     echo "document.write(unescape(\"" . rawurlencode($result[$randomquote]) . "\"));";
	     echo "document.write(\"</p>\");";
	     echo "}";
	   break;
	   case "jsVar":
 	     header("Content-type: text/plain");
         echo "var fortune=\"" . rawurlencode($result[$randomquote]) . "\";";
	   break;

	   case "xml":
		   header("Content-type: application/xml; charset=utf-8");
		   echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
		   echo "<fortune>";
   		   echo "<![CDATA[" . $result[$randomquote] ."]]>";
		   echo "</fortune>";	

       break;
       default:
		   header("Content-type: text/html");
		   echo   $result[$randomquote] ;

}
?> 
