<?php

function goodRef($ref)
{
	if (strstr($_SERVER['HTTP_VIA'], "pubproxy")) {
		if (strlen($ref) > 0) {
			if ($ref == "null")
				return false;
			return true;
		} else {
			return false;
		}
	}
	return false;
}

function blocked($ref)
{
	global  $blocked;

	if (array_search("$ref", $blocked) === false) 
		return false;
	return true;
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
