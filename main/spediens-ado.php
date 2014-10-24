<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
 * CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
 * GNU General Public License
 * Copyright 2002,2003,2004 Elpidio Latorilla
 * elpidio@care2x.org, elpidio@care2x.net
 *
 * See the file "copy_notice.txt" for the licence notice
 */
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/core/inc_config_color.php');

$thisfile="spediens-ado.php";
$breakfile="spediens.php?sid=".$sid."&lang=".$lang;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
// -->
</script>

<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
	<tr valign=top>
		<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="35"><FONT
			COLOR="<?php echo $cfg['top_txtcolor']; ?>" SIZE=+2 FACE="Arial"> <STRONG>
		&nbsp;<?php echo $LDDutyPlanOrg ?></STRONG></FONT></td>
		<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right><a
			href="javascript:history.back();"><img
			<?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?>
			style="filter: alpha(opacity = 70)" class="fadeOut" /></a><a href="javascript:gethelp()"><img
			<?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?>
			style="filter: alpha(opacity = 70)" class="fadeOut" /></a><a href="<?php echo $breakfile ?>"><img
			<?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?>
			style="filter: alpha(opacity = 70)" class="fadeOut" /></a></td>
	</tr>
	<tr valign=top>
		<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
		<ul>
			<FONT face="Verdana,Helvetica,Arial" size=2>
			<p><br>
			<a href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang" ?>"><img
			<?php echo createComIcon($root_path,'icon_clock.gif','0') ?>> <?php echo $LDBundyMachine ?></a><br>
			<a
				href="spediens-ado-dutyplanner.php?sid=<?php echo "$sid&lang=$lang" ?>"><img
				<?php echo createComIcon($root_path,'icon_pencil.gif','0') ?>> <?php echo $LDDutyPlanner ?></a><br>
			<a href="ucons.php?sid=<?php echo "$sid&lang=$lang" ?>"><img
			<?php echo createComIcon($root_path,'achtung.gif','0') ?>> <?php echo $LDStatistics ?></a><br>
			<p><br>
			<a href="<?php echo $breakfile ?>"><img
			<?php echo createLDImgSrc($root_path,'close2.gif','0') ?>
				alt="<?php echo $LDClose ?>" align="middle"></a> <?php if ($from=="multiple")
				echo '
<form name=backbut onSubmit="return false">
<input type="button" value="'.$LDBack.'" onClick="history.back()">
</form>
';
				?>
		
		</ul>

		</FONT>
		<p>
		
		</td>
	</tr>

	<tr>
		<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2><?php
		require("../language/$lang/".$lang."_copyrite.php");

 ?></td>
	</tr>
</table>
&nbsp;




</FONT>


</BODY>
</HTML>
