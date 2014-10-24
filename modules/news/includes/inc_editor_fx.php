<?php
/**
*  These functions do several routines for editing
*/

/**
* deactivateHotHtml disables the <script> <input> <form> <print> tags by inserting the </> characters
*/
function deactivateHotHtml(&$str)
{
    $str=str_ireplace('script','scri</>pt',$str);    
	$str=str_ireplace('form','for</>m',$str);	
	$str=str_ireplace('input','inp</>ut',$str);
	$str=str_ireplace('echo','ec</>ho',$str);
	$str=str_ireplace('print','pr</>int',$str);
	
	return $str;
}

function hilite(&$str)
{
	$sbuf=str_replace('**','</span>',$str);
	return str_replace('*','<span style="background:yellow">',$sbuf);
}
?>
