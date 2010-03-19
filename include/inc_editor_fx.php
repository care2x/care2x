<?php
/**
*  These functions do several routines for editing
*/

/**
* deactivateHotHtml disables the <script> <input> <form> <print> tags by inserting the </> characters
*/
function deactivateHotHtml(&$str)
{
    $str=eregi_replace('script','scri</>pt',$str);    
	$str=eregi_replace('form','for</>m',$str);	
	$str=eregi_replace('input','inp</>ut',$str);
	$str=eregi_replace('echo','ec</>ho',$str);
	$str=eregi_replace('print','pr</>int',$str);
	
	return $str;
}

function hilite(&$str)
{
	$sbuf=str_replace('**','</span>',$str);
	return str_replace('*','<span style="background:yellow">',$sbuf);
}
?>
