<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_newstitle_clean.php',$_SERVER['SCRIPT_NAME'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if(isset($newstitle)&&!empty($newstitle))
{
    $titlebuf=str_replace(' ','',strtolower($newstitle));
    $titlebuf=strtr($titlebuf,"/%&!?.*'#[]{}`��()_-;:+��@|<>^�ߵ,=�������������������������濹","~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~aouaeiouaeioueouiacaolaszczs");
    $titlebuf=str_replace('~','',$titlebuf);
    $titlebuf=str_replace("\"","",$titlebuf);
    $titlebuf=str_replace('\\','',$titlebuf);
    $titlebuf=str_replace('\$','',$titlebuf);
}
?>
