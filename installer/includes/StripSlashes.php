<?php
//gjergji : fix for magic quotes on on windows
function strip_magic_quotes($arr)	{
	foreach ($arr as $k => $v)		{
		if (is_array($v))
			{ $arr[$k] = strip_magic_quotes($v); }
		else
			{ $arr[$k] = stripslashes($v); }
	}
	return $arr;
}
?>