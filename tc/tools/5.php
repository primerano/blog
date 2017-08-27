<?php
$code = $_GET["CODE"];
if (isset($_GET["CODE"])) {
	header("HTTP/1.0 500 Internal Server Error");
} else {
echo "Enter ?CODE=&lt;http status code &gt";
}

?>
