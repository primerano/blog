<?php
header ("location: http://start.aimpages.com/snslandingpage.adp");
// prevent caching
header("Cache-Control: no-store");
header("Pragma: no-cache");
header("Expires: Thursday, 05-May-05 05:05:05 GMT");

echo "<ul>";

foreach ($_GET as $key => $value) {
  echo "<li>" .  $key ." =" . $value . "</li>";
}


echo "</ul>";
?> 
