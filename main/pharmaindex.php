<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','legal.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }
	A:visited {text-decoration: none;}

}

</style>

</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="#ffffff" alink="navy" vlink="navy"  >
<br>&nbsp;<p>
<center>
<font face="Verdana, Arial" size=3>
<?php
echo $LDPharmaPrompt;
?>
</font>
</center
<br>&nbsp;<p>

<table width=100%>
<tr>
<td >
<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td>
</tr>
</table>        


</BODY>
</HTML>
