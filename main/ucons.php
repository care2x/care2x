<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE 2002 Integrated Hospital Information System beta 2.0.1 - 30.11.2003
* GNU General Public License
* Copyright 2002 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*
* 19.oct.2003 Daniel Hinostroza: Spanish switch lang added
*/
if(!isset($lang))
  if(isset($_GET['lang'])) $lang=$_GET['lang'];
    elseif (isset($_POST['lang'])) $lang=$_POST['lang'];
	  elseif(isset($_COOKIE['ck_lang'])) $lang=$_COOKIE['ck_lang'];
	    else $lang="en";
		
require_once($root_path.'include/core/inc_charset_fx.php');	
require_once($root_path.'include/core/inc_img_fx.php');	
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>
<BODY bgcolor="#ffffff">
<P><br>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','left') ?>>
<font face=verdana,arial size=5 color=maroon>
<?php 
switch($lang)
{
	case "de": echo '... wird noch weiter ausgebaut.'; break;
	case "it": echo 'Ancora un po\' di pazienza, ci siamo lavorando.'; break;
	case "id": echo 'Kami sedan mengerjakan bagian ini. Harap bersabar'; break;
	case "es": echo 'Estamos trabajando en este módulo.  Por favor, sea paciente'; break;
	default: echo 'Moduli do te aktivizohet se shpejti.';
}
?>
<form>
<input type="button" value=" OK " onClick="javascript:window.history.back()">
</form>
<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
