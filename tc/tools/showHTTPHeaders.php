<?php
   foreach($_SERVER as $h=>$v)
          if(ereg('HTTP_(.+)',$h,$hp))
	              echo "<li>" . htmlspecialchars("$h = $v") . " </li>\n";
		      header('Content-type: text/html');
			?>
