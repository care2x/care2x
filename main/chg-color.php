<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

//create unique id
$r=uniqid("");
$breakfile='javascript:window.close()';

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDColorMap ?></TITLE>

<script  language="javascript">


function set(c)
{
<?php if($mode=="ex") echo "url='excolorchg.php?sid=$sid&lang=$lang&item=$item&mode=change&uid=$r&color='+c;"; 
			else echo "url='colorchg.php?sid=$sid&lang=$lang&item=$item&mode=change&uid=$r&color='+c;"; 
?>
	
	window.opener.location.replace(url);
	window.close();
}
</script>

</HEAD>

<BODY bgcolor=<?php echo $btb; ?> onLoad="if (window.focus) window.focus();" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>


<table width=100% border=0 cellspacing="0">

<tr>
<td bgcolor="<?php echo $tb; ?>">
<FONT  COLOR="<?php echo $tt; ?>"  SIZE=+3  FACE="Arial"><STRONG> &nbsp;<?php echo $LDColorMap ?></STRONG></FONT>
</td>
<td bgcolor="<?php echo $tb; ?>" height="10" align=right>
<a href="<?php echo $breakfile;?>">
<img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"  <?php if($cfg['dhtml'])echo'class="fadeOut"  class="fadeOut">';?> /></a></td>
</tr>
<tr>
<td colspan=2  bgcolor=<?php echo $bb; ?>>
<br>
<ul><font face="verdana,arial" size=2>
<?php echo $LDPlsClkColor ?><br></font>
<TABLE border=1 cellPadding=2 cellSpacing=0 ><!-- Arrangement by Bob Stein, www.visibone.com -->
  <TBODY>
  <TR>
    <TD 
    bgcolor=#ffffff><a  href="#" onClick=set('ffffff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cccccc><a  href="#" onClick="set('cccccc')"><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#999999><a  href="#" onClick=set('999999')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#666666><a  href="#" onClick=set('666666')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#333333><a  href="#" onClick=set('333333')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#000000><a  href="#" onClick=set('000000')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffcc00><a  href="#" onClick=set('ffcc00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff9900><a  href="#" onClick=set('ff9900')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff6600><a  href="#" onClick=set('ff6600')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff3300><a  href="#" onClick=set('ff3300')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=6></TD></TR>
  <TR>
    <TD 
    bgcolor=#99cc00><a  href="#" onClick=set('99cc00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <!-- <TD colSpan=4></TD> -->
    <TD 
    bgcolor=#eeeeee><a  href="#" onClick=set('eeeeee')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#dddddd><a  href="#" onClick=set('dddddd')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#bbbbbb><a  href="#" onClick=set('bbbbbb')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#aaaaaa><a  href="#" onClick=set('aaaaaa')><img src="p.gif" border=0 width=20 height=20></a></TD>

<TD 
    bgcolor=#cc9900><a  href="#" onClick=set('cc9900')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffcc33><a  href="#" onClick=set('ffcc33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffcc66><a  href="#" onClick=set('ffcc66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff9966><a  href="#" onClick=set('ff9966')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff6633><a  href="#" onClick=set('ff6633')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc3300><a  href="#" onClick=set('cc3300')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=4></TD>
    <TD 
    bgcolor=#cc0033><a  href="#" onClick=set('cc0033')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#ccff00><a  href="#" onClick=set('ccff00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ccff33><a  href="#" onClick=set('ccff33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#333300><a  href="#" onClick=set('333300')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#666600><a  href="#" onClick=set('666600')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#999900><a  href="#" onClick=set('999900')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cccc00><a  href="#" onClick=set('cccc00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffff00><a  href="#" onClick=set('ffff00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc9933><a  href="#" onClick=set('cc9933')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc6633><a  href="#" onClick=set('cc6633')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#330000><a  href="#" onClick=set('330000')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#660000><a  href="#" onClick=set('660000')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#990000><a  href="#" onClick=set('990000')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc0000><a  href="#" onClick=set('cc0000')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff0000><a  href="#" onClick=set('ff0000')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff3366><a  href="#" onClick=set('ff3366')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff0033><a  href="#" onClick=set('ff0033')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#99ff00><a  href="#" onClick=set('99ff00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ccff66><a  href="#" onClick=set('ccff66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99cc33><a  href="#" onClick=set('99cc33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#666633><a  href="#" onClick=set('666633')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#999933><a  href="#" onClick=set('999933')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cccc33><a  href="#" onClick=set('cccc33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffff33><a  href="#" onClick=set('ffff33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#996600><a  href="#" onClick=set('996600')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#993300><a  href="#" onClick=set('993300')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#663333><a  href="#" onClick=set('663333')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#993333><a  href="#" onClick=set('993333')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc3333><a  href="#" onClick=set('cc3333')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff3333><a  href="#" onClick=set('ff3333')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc3366><a  href="#" onClick=set('cc3366')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff6699><a  href="#" onClick=set('ff6699')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff0066><a  href="#" onClick=set('ff0066')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#66ff00><a  href="#" onClick=set('66ff00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99ff66><a  href="#" onClick=set('99ff66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66cc33><a  href="#" onClick=set('66cc33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#669900><a  href="#" onClick=set('669900')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#999966><a  href="#" onClick=set('999966')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cccc66><a  href="#" onClick=set('cccc66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffff66><a  href="#" onClick=set('ffff66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#996633><a  href="#" onClick=set('996633')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#663300><a  href="#" onClick=set('663300')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#996666><a  href="#" onClick=set('996666')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc6666><a  href="#" onClick=set('cc6666')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff6666><a  href="#" onClick=set('ff6666')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#990033><a  href="#" onClick=set('990033')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc3399><a  href="#" onClick=set('cc3399')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff66cc><a  href="#" onClick=set('ff66cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff0099><a  href="#" onClick=set('ff0099')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#33ff00><a  href="#" onClick=set('33ff00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66ff33><a  href="#" onClick=set('66ff33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#339900><a  href="#" onClick=set('339900')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66cc00><a  href="#" onClick=set('66cc00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99ff33><a  href="#" onClick=set('99ff33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cccc99><a  href="#" onClick=set('cccc99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffff99><a  href="#" onClick=set('ffff99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc9966><a  href="#" onClick=set('cc9966')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc6600><a  href="#" onClick=set('cc6600')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc9999><a  href="#" onClick=set('cc9999')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff9999><a  href="#" onClick=set('ff9999')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff3399><a  href="#" onClick=set('ff3399')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc0066><a  href="#" onClick=set('cc0066')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#990066><a  href="#" onClick=set('990066')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff33cc><a  href="#" onClick=set('ff33cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff00cc><a  href="#" onClick=set('ff00cc')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#00cc00><a  href="#" onClick=set('00cc00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33cc00><a  href="#" onClick=set('33cc00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#336600><a  href="#" onClick=set('336600')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#669933><a  href="#" onClick=set('669933')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99cc66><a  href="#" onClick=set('99cc66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ccff99><a  href="#" onClick=set('ccff99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffffcc><a  href="#" onClick=set('ffffcc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffcc99><a  href="#" onClick=set('ffcc99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff9933><a  href="#" onClick=set('ff9933')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ffcccc><a  href="#" onClick=set('ffcccc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff99cc><a  href="#" onClick=set('ff99cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc6699><a  href="#" onClick=set('cc6699')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#993366><a  href="#" onClick=set('993366')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#660033><a  href="#" onClick=set('660033')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc0099><a  href="#" onClick=set('cc0099')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#330033><a  href="#" onClick=set('330033')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#33cc33><a  href="#" onClick=set('33cc33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66cc66><a  href="#" onClick=set('66cc66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#00ff00><a  href="#" onClick=set('00ff00')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33ff33><a  href="#" onClick=set('33ff33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66ff66><a  href="#" onClick=set('66ff66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99ff99><a  href="#" onClick=set('99ff99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ccffcc><a  href="#" onClick=set('ccffcc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=3></TD>
    <TD 
    bgcolor=#cc99cc><a  href="#" onClick=set('cc99cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#996699><a  href="#" onClick=set('996699')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#993399><a  href="#" onClick=set('993399')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#990099><a  href="#" onClick=set('990099')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#663366><a  href="#" onClick=set('663366')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#660066><a  href="#" onClick=set('660066')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#006600><a  href="#" onClick=set('006600')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#336633><a  href="#" onClick=set('336633')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#009900><a  href="#" onClick=set('009900')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#339933><a  href="#" onClick=set('339933')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#669966><a  href="#" onClick=set('669966')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99cc99><a  href="#" onClick=set('99cc99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=3></TD>
    <TD 
    bgcolor=#ffccff><a  href="#" onClick=set('ffccff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff99ff><a  href="#" onClick=set('ff99ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff66ff><a  href="#" onClick=set('ff66ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff33ff><a  href="#" onClick=set('ff33ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ff00ff><a  href="#" onClick=set('ff00ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc66cc><a  href="#" onClick=set('cc66cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc33cc><a  href="#" onClick=set('cc33cc')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#003300><a  href="#" onClick=set('003300')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#00cc33><a  href="#" onClick=set('00cc33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#006633><a  href="#" onClick=set('006633')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#339966><a  href="#" onClick=set('339966')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66cc99><a  href="#" onClick=set('66cc99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99ffcc><a  href="#" onClick=set('99ffcc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ccffff><a  href="#" onClick=set('ccffff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3399ff><a  href="#" onClick=set('3399ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99ccff><a  href="#" onClick=set('99ccff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#ccccff><a  href="#" onClick=set('ccccff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc99ff><a  href="#" onClick=set('cc99ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9966cc><a  href="#" onClick=set('9966cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#663399><a  href="#" onClick=set('663399')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#330066><a  href="#" onClick=set('330066')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9900cc><a  href="#" onClick=set('9900cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc00cc><a  href="#" onClick=set('cc00cc')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#00ff33><a  href="#" onClick=set('00ff33')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33ff66><a  href="#" onClick=set('33ff66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#009933><a  href="#" onClick=set('009933')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#00cc66><a  href="#" onClick=set('00cc66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33ff99><a  href="#" onClick=set('33ff99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99ffff><a  href="#" onClick=set('99ffff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#99cccc><a  href="#" onClick=set('99cccc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0066cc><a  href="#" onClick=set('0066cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6699cc><a  href="#" onClick=set('6699cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9999ff><a  href="#" onClick=set('9999ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9999cc><a  href="#" onClick=set('9999cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9933ff><a  href="#" onClick=set('9933ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6600cc><a  href="#" onClick=set('6600cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#660099><a  href="#" onClick=set('660099')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc33ff><a  href="#" onClick=set('cc33ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc00ff><a  href="#" onClick=set('cc00ff')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#00ff66><a  href="#" onClick=set('00ff66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66ff99><a  href="#" onClick=set('66ff99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33cc66><a  href="#" onClick=set('33cc66')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#009966><a  href="#" onClick=set('009966')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66ffff><a  href="#" onClick=set('66ffff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66cccc><a  href="#" onClick=set('66cccc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#669999><a  href="#" onClick=set('669999')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#003366><a  href="#" onClick=set('003366')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#336699><a  href="#" onClick=set('336699')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6666ff><a  href="#" onClick=set('6666ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6666cc><a  href="#" onClick=set('6666cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#666699><a  href="#" onClick=set('666699')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#330099><a  href="#" onClick=set('330099')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9933cc><a  href="#" onClick=set('9933cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#cc66ff><a  href="#" onClick=set('cc66ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9900ff><a  href="#" onClick=set('9900ff')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#00ff99><a  href="#" onClick=set('00ff99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66ffcc><a  href="#" onClick=set('66ffcc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33cc99><a  href="#" onClick=set('33cc99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33ffff><a  href="#" onClick=set('33ffff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33cccc><a  href="#" onClick=set('33cccc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#339999><a  href="#" onClick=set('339999')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#336666><a  href="#" onClick=set('336666')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#006699><a  href="#" onClick=set('006699')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#003399><a  href="#" onClick=set('003399')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3333ff><a  href="#" onClick=set('3333ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3333cc><a  href="#" onClick=set('3333cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#333399><a  href="#" onClick=set('333399')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#333366><a  href="#" onClick=set('333366')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6633cc><a  href="#" onClick=set('6633cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#9966ff><a  href="#" onClick=set('9966ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6600ff><a  href="#" onClick=set('6600ff')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#00ffcc><a  href="#" onClick=set('00ffcc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33ffcc><a  href="#" onClick=set('33ffcc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#00ffff><a  href="#" onClick=set('00ffff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#00cccc><a  href="#" onClick=set('00cccc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#009999><a  href="#" onClick=set('009999')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#006666><a  href="#" onClick=set('006666')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#003333><a  href="#" onClick=set('003333')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3399cc><a  href="#" onClick=set('3399cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3366cc><a  href="#" onClick=set('3366cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0000ff><a  href="#" onClick=set('0000ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0000cc><a  href="#" onClick=set('0000cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#000099><a  href="#" onClick=set('000099')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#000066><a  href="#" onClick=set('000066')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#000033><a  href="#" onClick=set('000033')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6633ff><a  href="#" onClick=set('6633ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3300ff><a  href="#" onClick=set('')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD 
    bgcolor=#00cc99><a  href="#" onClick=set('00cc99')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=4></TD>
    <TD 
    bgcolor=#0099cc><a  href="#" onClick=set('0099cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#33ccff><a  href="#" onClick=set('33ccff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#66ccff><a  href="#" onClick=set('66ccff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#6699ff><a  href="#" onClick=set('6699ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#3366ff><a  href="#" onClick=set('3366ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0033cc><a  href="#" onClick=set('0033cc')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=4></TD>
    <TD 
    bgcolor=#3300cc><a  href="#" onClick=set('300cc')><img src="p.gif" border=0 width=20 height=20></a></TD></TR>
  <TR>
    <TD colSpan=6></TD>
    <TD 
    bgcolor=#00ccff><a  href="#" onClick=set('00ccff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0099ff><a  href="#" onClick=set('0099ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0066ff><a  href="#" onClick=set('0066ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD 
    bgcolor=#0033ff><a  href="#" onClick=set('0033ff')><img src="p.gif" border=0 width=20 height=20></a></TD>
    <TD colSpan=6></TD></TR></TBODY></TABLE>
</ul>

</FONT>
</td>
</tr>
</table>        

<ul>
<a href="#" <?php if ($d) echo 'onClick="opener.focus();window.close()"'; else echo 'onClick="window.close()"'; ?>><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>"></a>
</ul>

<hr>
<?php
if(file_exists($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php'))
include('../language/'.$lang.'/'.$lang.'_copyrite.php');
  else include('../language/en/en_copyrite.php');
  ?>
</FONT>


</BODY>
</HTML>
