<?php
header('Location:' . $_SERVER["HTTP_REFERER"]);
$seconds = $_POST["seconds"];
if (empty($seconds)) {
  $expire = 0;
} else {
  $expire = time() + intval($seconds);
}
$domain = $_POST["domain"];
if (empty($domain)) {
  $domain = "";
}
$path = $_POST["path"];
if (empty($path)) {
  $path = "";
}

setcookie($_POST["name"], $_POST["value"], $expire, $path, $domain );


?>

