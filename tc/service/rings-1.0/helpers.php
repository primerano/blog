<?php

function getRandom($result, $dontUse)
{
	srand ((double) microtime() * 1000000);
	$count = count($result);
	$rnum = rand(0,$count-1);
	$randomuser = $result[$rnum];
	if (($count > 1) && ($randomuser === $dontUse))
		if (($rnum + 1) > $count/2)
			$randomuser = $result[rand(0,$rnum-1)];
		else
			$randomuser = $result[rand($rnum+1, $count-1)];
	return $randomuser;
}

        function goodReferer($ref)
        {
           if (strstr($_SERVER['HTTP_VIA'], "pubproxy"))
	   {
	     return true;
	   }
		   return false;

        }
function fixedList($tag) 
{
	if (strstr("test1", $tag))
		return true;

	return false;

}

  function goodPage($key)
  {
          if (strstr($key, "edit.jsp"))
              return false;
          if (strstr($key, "http://"))
              return false;

            return true;
  }
?>
