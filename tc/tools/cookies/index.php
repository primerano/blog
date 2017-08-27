<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta charset="utf-8">
  <title>Cookies!!! </title>
</head>
<body>


<h2> Current Cookies </h2>

<?php



foreach ($_COOKIE as $key=>$val)
  {
    echo $key.' is '.$val."<br>\n";
  }


?>

<h2> update cookie </h2>
<form action="set.php" method="post">

Cookie Name: <input type="text" name="name"><br>
Cookie Value: <input type="text" name="value"><br>
Cookie Path: <input type="text" name="path"><br>
Cookie Domain: <input type="text" name="domain"><br>
Cookie Seconds (empty for session): <input type="text" name="seconds"><br>
<input type="submit">
</form>
</body>
</html>
