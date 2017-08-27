<?php
        function goodRef($ref)
        {
 		if (strlen($ref) > 0) {
		  if ($ref == "null")
		    return false;
	  	  return true;
		} else {
                	return false;
            	}
        }
  function goodKey($key) 
  {
    if (strlen($key) > 0) {
       if ($key == "null")
            return false;
       if (strstr($key, "edit.jsp"))
            return false;
       return true;
     } else {
           return false;
     }

  }
?>
