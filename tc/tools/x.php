<?php 
$url=parse_url($_SERVER['SCRIPT_URI']);
$name = end(split('/',end($url))));
?>
