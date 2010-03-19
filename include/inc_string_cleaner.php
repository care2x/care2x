<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_string_cleaner.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

function cleanString($dirty_str)
{

    if(!empty($dirty_str))
    {
        $clean_str=str_replace(' ','',strtolower($dirty_str));
        $clean_str=strtr($clean_str,"/%&!?.*'#[]{}`´§()_-;:+²³@|<>^°ßµ,=äöüáéíóúàèìòùêôûîâçãõ³±¶¼æ¿¹","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeioueouiacaolaszczs");
        $clean_str=str_replace('~','',$clean_str);
        $clean_str=str_replace("\"","",$clean_str);
        $clean_str=str_replace('\\','',$clean_str);
        $clean_str=str_replace('\$','',$clean_str);
	
	    return $clean_str;
    }
}
?>
