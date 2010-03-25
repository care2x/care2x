<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_newstitle_clean.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(isset($newstitle)&&!empty($newstitle))
{
    $titlebuf=str_replace(' ','',strtolower($newstitle));
    $titlebuf=strtr($titlebuf,"/%&!?.*'#[]{}`´§()_-;:+²³@|<>^°ßµ,=äöüáéíóúàèìòùêôûîâçãõ³±¶¼æ¿¹","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeioueouiacaolaszczs");
    $titlebuf=str_replace('~','',$titlebuf);
    $titlebuf=str_replace("\"","",$titlebuf);
    $titlebuf=str_replace('\\','',$titlebuf);
    $titlebuf=str_replace('\$','',$titlebuf);
}
?>
