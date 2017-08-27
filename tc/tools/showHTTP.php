
<?php 
setcookie("test", "123", time()+3600);
?>
<?php
   foreach($_SERVER as $h=>$v)
          if(ereg('HTTP_(.+)',$h,$hp))
	              echo "<li>$h = $v</li>\n";

		      header('Content-type: text/html');
?>
<h2> parameters </h2>
<?php
echo "<ul>";

foreach ($_GET as $key => $value) {
  echo "<li>" .  $key ." =" . $value . "</li>";
  }


  echo "</ul>";
?>
<?php 
echo "<ul>";

foreach ($_POST as $key => $value) {

  echo "<li>" .  $key ." =" . $value . "</li>";
    } 
        
	    
	      echo "</ul>";
	      ?>

<?php
   foreach($_SERVER as $h=>$v)
	                           echo "<li>$h = $v</li>\n";
				   
				                         header('Content-type: text/html');
							 ?>
							 
<?php
echo $HTTP_GET_VARS;
echo "t";

		       while(list($key, $value) = each($HTTP_GET_VARS))
		       {
		       echo "$key = $value(br)";
		       } 

			?>
