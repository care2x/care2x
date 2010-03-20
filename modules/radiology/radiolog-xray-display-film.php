<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/*** CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define("LANG_FILE","radio.php");
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require($root_path.'global_conf/inc_remoteservers_conf.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
</HEAD>
<BODY bgcolor=black onLoad="if (window.focus) window.focus()" marginwidth=0 leftmargin=0 topmargin=0 marginheight=0>
<center >
<?php if(isset($mode)&&($mode=="preview")) 
{
 ?>
<img src="<?php if($disc_pix_mode) echo $xray_film_localpath; else echo $xray_film_server_http; ?>thorax.jpg" width=150>
<?php
}
else
{
 ?>
<script language="javascript">
<!-- Script Begin
document.write('<img src="<?php if($disc_pix_mode) echo $xray_film_localpath; else echo $xray_film_server_http; ?>thorax.jpg" width="'+(screen.availWidth*0.83)+'">');
//  Script End -->
</script>
<?php 
}
 ?>
<br>

<p>
<form>
<?php if(!isset($mode)||($mode!="preview")) 
{
 ?>
<input type="button" value="<?php echo $LDClose ?>" onClick="window.top.location.replace('radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>')">
<?php 
}
 ?>
</form>
</center>
<p>






</BODY>
</HTML>
