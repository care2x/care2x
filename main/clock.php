<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/core/inc_environment_global.php');
/**
 * CARE 2002 Integrated Hospital Information System beta 1.0.04 - 2003-03-31
 * GNU General Public License
 * Copyright 2002 Elpidio Latorilla
 * elpidio@latorilla.com
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define ( 'LANG_FILE', 'specials.php' );
define ( 'NO_2LEVEL_CHK', 1 );
require_once ($root_path . 'include/core/inc_front_chain_lang.php');
require_once ($root_path . 'include/core/inc_config_color.php');

$breakfile = "spediens.php?sid=" . $sid . "&lang=" . $lang;

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
<?php
echo setCharSet ();
?>
<script language="JavaScript" src="../js/clock.js">
</script>

<?php
require ($root_path . 'include/core/inc_js_gethelp.php');
require ($root_path . 'include/core/inc_css_a_hilitebu.php');
?><script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php
	echo $lang?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>


</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
	bgcolor="silver" alink="navy" vlink="navy" onLoad=show5()>


<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
	<tr valign=top>
		<td bgcolor="<?php
		echo $cfg ['top_bgcolor'];
		?>" height="10"><FONT
			COLOR="<?php
			echo $cfg ['top_txtcolor'];
			?>" SIZE=+3 FACE="Arial"><STRONG> &nbsp;<?php
			echo $LDClock?></STRONG></FONT></td>
		<td bgcolor="<?php
		echo $cfg ['top_bgcolor'];
		?>" height="10"
			align=right>
<?php
if ($cfg ['dhtml'])
	echo '<a href="javascript:window.history.back()"><img ' . createLDImgSrc ( $root_path, 'back2.gif', '0' ) . '  class="fadeOut" >';
?></a>
		<a href="javascript:gethelp('')">
		<img
			<?php
			echo createLDImgSrc ( $root_path, 'hilfe-r.gif', '0' )?>
			<?php
			if ($cfg ['dhtml'])
				echo 'class="fadeOut">';
			?> /></a><a
			href="<?php
			echo $breakfile;
			?>" />
			<img
			<?php
			echo createLDImgSrc ( $root_path, 'close2.gif', '0' )?>
			alt="<?php
			echo $LDClose?>"
			<?php
			if ($cfg ['dhtml'])
				echo 'class="fadeOut" >';
			?> /></a></td>
	</tr>
	<tr>
		<td bgcolor=<?php
		echo $cfg ['body_bgcolor'];
		?> valign=top colspan=2>
		<p><br>
		
		
		<p>
		
		
		<CENTER><font face="verdana,arial" size=3>
<?php
echo "$LDPresent $LDTime"?>
</FONT> <span id="liveclock"
			style="position: relative; left: 0; top: 0; font-size: 146"> </span>
		</CENTER>
		<font face="Verdana, Arial, Helvetica" size=2>

		<p></td>
	</tr>

	<tr>
		<td bgcolor=<?php
		echo $cfg ['bot_bgcolor'];
		?> height=70 colspan=2>
<?php
require ($root_path.'include/core/inc_load_copyrite.php');
?>
</td>
	</tr>
</table>
&nbsp;




</FONT>


</BODY>
</HTML>
